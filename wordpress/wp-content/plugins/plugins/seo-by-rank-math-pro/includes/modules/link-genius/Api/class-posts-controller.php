<?php
/**
 * Posts REST API controller.
 *
 * Handles posts-related endpoints: posts, posts-stats, stats, regenerate.
 *
 * @package    RankMathPro
 * @subpackage RankMathPro\Link_Genius\Api
 */

namespace RankMathPro\Link_Genius\Api;

use WP_REST_Server;
use WP_REST_Request;
use RankMathPro\Link_Genius\Data\Query_Builder;
use RankMathPro\Link_Genius\Background\Regenerate_Links;

defined( 'ABSPATH' ) || exit;

/**
 * Posts_Controller class.
 *
 * Provides REST endpoints for posts data and statistics.
 */
class Posts_Controller extends Base_Controller {

	/**
	 * Register REST API routes.
	 */
	public function register_routes() {
		// GET /posts - Get posts with link metrics.
		register_rest_route(
			$this->namespace,
			'/posts',
			[
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => [ $this, 'get_posts' ],
				'permission_callback' => [ $this, 'check_admin_permission' ],
				'args'                => $this->get_posts_args(),
			]
		);

		// GET /posts-stats - Get posts statistics.
		register_rest_route(
			$this->namespace,
			'/posts-stats',
			[
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => [ $this, 'get_posts_stats' ],
				'permission_callback' => [ $this, 'check_admin_permission' ],
			]
		);

		// GET /stats - Get overview statistics.
		register_rest_route(
			$this->namespace,
			'/stats',
			[
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => [ $this, 'get_stats' ],
				'permission_callback' => [ $this, 'check_admin_permission' ],
			]
		);

		// POST /regenerate - Regenerate all internal links.
		register_rest_route(
			$this->namespace,
			'/regenerate',
			[
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => [ $this, 'regenerate_links' ],
				'permission_callback' => [ $this, 'check_admin_permission' ],
			]
		);
	}

	/**
	 * Get posts with link metrics and SEO scores.
	 *
	 * @param WP_REST_Request $request Request.
	 * @return \WP_REST_Response Response.
	 */
	public function get_posts( $request ) {
		$page     = (int) $request->get_param( 'page' );
		$per_page = min( (int) $request->get_param( 'per_page' ), 100 );
		$offset   = ( $page - 1 ) * $per_page;

		$args = [
			'search'             => $request->get_param( 'search' ),
			'post_type'          => $request->get_param( 'post_type' ),
			'is_orphan'          => $request->get_param( 'is_orphan' ),
			'seo_score_range'    => $request->get_param( 'seo_score_range' ),
			'min_incoming_links' => (int) $request->get_param( 'min_incoming_links' ),
			'orderby'            => $request->get_param( 'orderby' ),
			'order'              => $request->get_param( 'order' ),
			'offset'             => $offset,
			'per_page'           => $per_page,
		];

		$results = Query_Builder::get_posts( $args );
		$total   = Query_Builder::get_posts_count( $args );

		// Add SEO score class.
		foreach ( $results as $row ) {
			$row->seo_score_class = $this->get_seo_score_class( $row->seo_score, $row->focus_keyword );
		}

		return rest_ensure_response(
			[
				'posts' => $results,
				'total' => (int) $total,
				'pages' => ceil( $total / $per_page ),
			]
		);
	}

	/**
	 * Get posts statistics.
	 *
	 * @param WP_REST_Request $request Request.
	 * @return \WP_REST_Response Response.
	 */
	public function get_posts_stats( $request ) {
		$cache_key = 'link_genius_posts_stats';
		$cached    = wp_cache_get( $cache_key, Query_Builder::CACHE_GROUP );

		if ( false !== $cached ) {
			return rest_ensure_response( $cached );
		}

		global $wpdb;

		$stats = $wpdb->get_row(
			"SELECT
				COUNT(DISTINCT m.object_id) as total_posts,
				SUM(CASE WHEN m.incoming_link_count IS NULL OR m.incoming_link_count = 0 THEN 1 ELSE 0 END) as orphan_posts,
				SUM(CASE WHEN m.internal_link_count > 0 THEN 1 ELSE 0 END) as posts_with_internal,
				SUM(CASE WHEN m.external_link_count > 0 THEN 1 ELSE 0 END) as posts_with_external
			 FROM {$wpdb->prefix}rank_math_internal_meta m
			 INNER JOIN {$wpdb->posts} p ON m.object_id = p.ID
			 WHERE p.post_status = 'publish'"
		);

		$response = [
			'total_posts'         => (int) $stats->total_posts,
			'orphan_posts'        => (int) $stats->orphan_posts,
			'posts_with_internal' => (int) $stats->posts_with_internal,
			'posts_with_external' => (int) $stats->posts_with_external,
		];

		wp_cache_set( $cache_key, $response, Query_Builder::CACHE_GROUP, 5 * MINUTE_IN_SECONDS );

		return rest_ensure_response( $response );
	}

	/**
	 * Get overview statistics.
	 *
	 * @param WP_REST_Request $request Request.
	 * @return \WP_REST_Response Response.
	 */
	public function get_stats( $request ) {
		$cache_key = 'link_genius_stats';
		$cached    = wp_cache_get( $cache_key, Query_Builder::CACHE_GROUP );

		if ( false !== $cached ) {
			return rest_ensure_response( $cached );
		}

		global $wpdb;
		$table = $wpdb->prefix . 'rank_math_internal_links';

		$stats = $wpdb->get_row(
			"SELECT
				COUNT(*) as total,
				SUM(CASE WHEN type = 'internal' THEN 1 ELSE 0 END) as internal,
				SUM(CASE WHEN type = 'external' THEN 1 ELSE 0 END) as external,
				SUM(CASE WHEN is_nofollow = 1 THEN 1 ELSE 0 END) as nofollow
			 FROM {$table}"
		);

		$response = [
			'total'    => (int) $stats->total,
			'internal' => (int) $stats->internal,
			'external' => (int) $stats->external,
			'nofollow' => (int) $stats->nofollow,
		];

		wp_cache_set( $cache_key, $response, Query_Builder::CACHE_GROUP, 5 * MINUTE_IN_SECONDS );

		return rest_ensure_response( $response );
	}

	/**
	 * Regenerate all internal links.
	 *
	 * @param WP_REST_Request $request Request.
	 * @return \WP_REST_Response|\WP_Error Response.
	 */
	public function regenerate_links( $request ) {
		$this->track_link_genius_event(
			'Button Clicked',
			[ 'button' => 'Regenerate Links' ]
		);

		$processor = Regenerate_Links::get();
		$started   = $processor->start();

		if ( ! $started ) {
			return $this->error(
				'no_posts_found',
				__( 'No posts found to process.', 'rank-math-pro' ),
				400
			);
		}

		return rest_ensure_response(
			[ 'success' => true ]
		);
	}

	/**
	 * Get arguments for posts endpoint.
	 *
	 * @return array
	 */
	private function get_posts_args() {
		return [
			'page'               => [
				'description' => esc_html__( 'Page number.', 'rank-math-pro' ),
				'type'        => 'integer',
				'default'     => 1,
			],
			'per_page'           => [
				'description' => esc_html__( 'Items per page.', 'rank-math-pro' ),
				'type'        => 'integer',
				'default'     => 50,
				'maximum'     => 100,
			],
			'search'             => [
				'description' => esc_html__( 'Search in post title.', 'rank-math-pro' ),
				'type'        => 'string',
				'default'     => '',
			],
			'post_type'          => [
				'description' => esc_html__( 'Filter by post type. Supports multiple values.', 'rank-math-pro' ),
				'type'        => 'array',
				'items'       => [ 'type' => 'string' ],
				'default'     => [],
			],
			'is_orphan'          => [
				'description' => esc_html__( 'Filter by orphan status.', 'rank-math-pro' ),
				'type'        => 'string',
				'default'     => '',
			],
			'seo_score_range'    => [
				'description' => esc_html__( 'Filter by SEO score range.', 'rank-math-pro' ),
				'type'        => 'string',
				'default'     => '',
			],
			'orderby'            => [
				'description' => esc_html__( 'Order by field.', 'rank-math-pro' ),
				'type'        => 'string',
				'default'     => 'post_title',
			],
			'order'              => [
				'description' => esc_html__( 'Order direction.', 'rank-math-pro' ),
				'type'        => 'string',
				'default'     => 'ASC',
			],
			'min_incoming_links' => [
				'description' => esc_html__( 'Minimum incoming links count filter.', 'rank-math-pro' ),
				'type'        => 'integer',
				'default'     => 0,
			],
		];
	}

	/**
	 * Get SEO score class based on score value.
	 *
	 * @param int    $score   SEO score.
	 * @param string $keyword Focus keyword.
	 * @return string CSS class.
	 */
	private function get_seo_score_class( $score, $keyword = '' ) {
		if ( $score === 0 ) {
			return 'no-score';
		}

		if ( $score > 80 ) {
			return 'great';
		}

		if ( $score > 50 && $score < 81 ) {
			return 'good';
		}

		return 'bad';
	}
}
