<?php
/**
 * Post List Integration for Link Genius.
 *
 * Makes link counts clickable in the WordPress admin Posts list,
 * linking to the Link Genius page with appropriate filters.
 *
 * @since      1.0.258
 * @package    RankMathPro
 * @subpackage RankMathPro\Link_Genius
 * @author     Rank Math <support@rankmath.com>
 */

namespace RankMathPro\Link_Genius\Admin;

use RankMath\Helper;
use RankMath\Traits\Hooker;

defined( 'ABSPATH' ) || exit;

/**
 * Post_List_Integration class.
 */
class Post_List_Integration {

	use Hooker;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->filter( 'rank_math/links/post_column_count_item', 'make_link_count_clickable', 10, 5 );
		$this->action( 'admin_footer', 'add_inline_styles' );
	}

	/**
	 * Make link count items clickable.
	 *
	 * @param string $html    The default HTML.
	 * @param string $type    Link type: 'internal', 'external', or 'incoming'.
	 * @param int    $count   The count value.
	 * @param int    $post_id Post ID.
	 *
	 * @return string Modified HTML with clickable link.
	 */
	public function make_link_count_clickable( $html, $type, $count, $post_id ) {
		// Don't make zero counts clickable.
		if ( empty( $count ) ) {
			return $html;
		}

		$url = $this->get_link_genius_url( $type, $post_id );

		// If we couldn't generate a URL, return the original HTML.
		if ( empty( $url ) ) {
			return $html;
		}

		$icons = [
			'internal' => 'dashicons-admin-links',
			'external' => 'dashicons-external',
			'incoming' => 'dashicons-external internal',
		];

		$titles = [
			'internal' => __( 'View internal links from this post', 'rank-math-pro' ),
			'external' => __( 'View external links from this post', 'rank-math-pro' ),
			'incoming' => __( 'View incoming links to this post', 'rank-math-pro' ),
		];

		return sprintf(
			'<a href="%1$s" class="rank-math-link-count-item rank-math-link-count-clickable" data-link-type="%2$s" title="%3$s"><span class="dashicons %4$s"></span><span>%5$s</span></a>',
			esc_url( $url ),
			esc_attr( $type ),
			esc_attr( $titles[ $type ] ),
			esc_attr( $icons[ $type ] ),
			esc_html( $count )
		);
	}

	/**
	 * Add inline styles for clickable link counts.
	 *
	 * Only loads on post list screens.
	 */
	public function add_inline_styles() {
		$screen = get_current_screen();

		// Only load on post list screens.
		if ( ! $screen || 'edit' !== $screen->base ) {
			return;
		}

		?>
		<style type="text/css">
			/* Clickable link count items */
			.rank-math-link-count-clickable {
				text-decoration: none;
				color: inherit;
				transition: all 0.2s ease;
				display: inline-flex;
				align-items: center;
				gap: 2px;
				padding: 2px 4px;
				border-radius: 3px;
			}

			.rank-math-link-count-clickable:hover {
				background-color: #2271b1;
				color: #fff;
				text-decoration: none;
			}

			.rank-math-link-count-clickable:hover .dashicons {
				color: #fff;
			}

			.rank-math-link-count-clickable:focus {
				outline: 2px solid #2271b1;
				outline-offset: 1px;
				box-shadow: none;
			}

			/* Make non-clickable items consistent */
			.rank-math-link-count-item:not(.rank-math-link-count-clickable) {
				display: inline-flex;
				align-items: center;
				gap: 2px;
				padding: 2px 4px;
				opacity: 0.6;
			}
		</style>
		<?php
	}

	/**
	 * Get Link Genius URL for a specific link type.
	 *
	 * @param string $type    Link type: 'internal', 'external', or 'incoming'.
	 * @param int    $post_id Post ID.
	 *
	 * @return string Link Genius URL with filters.
	 */
	private function get_link_genius_url( $type, $post_id ) {
		$base_url = Helper::get_admin_url( 'links-page' );

		$params = [];

		switch ( $type ) {
			case 'internal':
				$params['source_id'] = absint( $post_id );
				$params['link_type'] = 'internal';
				break;

			case 'external':
				$params['source_id'] = absint( $post_id );
				$params['link_type'] = 'external';
				break;

			case 'incoming':
				$params['target_post_id'] = absint( $post_id );
				$params['link_type']      = 'internal';
				break;
		}

		// Build the hash fragment with query params.
		$query_string = http_build_query( $params );
		$hash         = 'links?' . $query_string;

		return $base_url . '#' . $hash;
	}
}
