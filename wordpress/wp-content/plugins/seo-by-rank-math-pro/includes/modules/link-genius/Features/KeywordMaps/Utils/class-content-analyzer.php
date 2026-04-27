<?php
/**
 * Content Analyzer for Keyword Maps.
 *
 * Provides shared content analysis functionality used across Auto-Linker,
 * Preview, and Execution flows.
 *
 * @package    RankMathPro
 * @subpackage RankMathPro\Link_Genius\Keyword_Maps\Utils
 */

namespace RankMathPro\Link_Genius\Features\KeywordMaps\Utils;

defined( 'ABSPATH' ) || exit;

/**
 * Content_Analyzer class.
 *
 * Single responsibility: Analyze content to extract link information.
 */
class Content_Analyzer {

	/**
	 * Analyze content once to extract link information and unsafe ranges.
	 *
	 * @param string $content Post content.
	 * @param bool   $use_cache Whether to use transient cache (default true).
	 * @return array Analysis results with 'link_ranges', 'existing_hrefs', and 'unsafe_ranges'.
	 */
	public static function analyze( $content, $use_cache = true ) {
		// Check cache first if enabled.
		if ( $use_cache ) {
			$cache_key = 'rm_content_analysis_' . md5( $content );
			$cached    = get_transient( $cache_key );

			if ( false !== $cached && is_array( $cached ) ) {
				return $cached;
			}
		}

		$link_ranges    = [];
		$existing_hrefs = [];

		// Single regex scan to get all links with their positions and hrefs.
		if ( preg_match_all( '/<a[^>]+href=["\']([^"\']+)["\'][^>]*>.*?<\/a>/is', $content, $matches, PREG_OFFSET_CAPTURE ) ) {
			foreach ( $matches[0] as $index => $match ) {
				$link_ranges[]    = [
					'start' => $match[1],
					'end'   => $match[1] + strlen( $match[0] ),
				];
				$existing_hrefs[] = self::normalize_url( $matches[1][ $index ][0] );
			}
		}

		// Extract unsafe ranges (blocks, shortcodes, HTML comments, etc.).
		$unsafe_ranges = self::extract_unsafe_ranges( $content );

		$analysis = [
			'link_ranges'    => $link_ranges,
			'existing_hrefs' => array_unique( $existing_hrefs ),
			'unsafe_ranges'  => $unsafe_ranges,
		];

		// Cache the result if enabled.
		if ( $use_cache ) {
			set_transient( $cache_key, $analysis, HOUR_IN_SECONDS );
		}

		return $analysis;
	}

	/**
	 * Update analysis after a link has been inserted.
	 *
	 * This is much faster than re-analyzing the entire content because it only
	 * shifts positions of ranges that come after the insertion point.
	 *
	 * @param array  $content_analysis Previous analysis result.
	 * @param int    $insert_position  Position where link was inserted.
	 * @param int    $insert_length    Length of the inserted link HTML.
	 * @param string $target_url       URL of the inserted link (for tracking).
	 * @return array Updated analysis with shifted positions.
	 */
	public static function update_after_link_insertion( $content_analysis, $insert_position, $insert_length, $target_url ) {
		// Add new link to link_ranges.
		$content_analysis['link_ranges'][] = [
			'start' => $insert_position,
			'end'   => $insert_position + $insert_length,
		];

		// Add URL to existing_hrefs.
		$normalized_url = self::normalize_url( $target_url );
		if ( ! in_array( $normalized_url, $content_analysis['existing_hrefs'], true ) ) {
			$content_analysis['existing_hrefs'][] = $normalized_url;
		}

		// Shift all ranges that come after the insertion point.
		$shift_amount = $insert_length;

		// Shift link_ranges.
		foreach ( $content_analysis['link_ranges'] as &$range ) {
			if ( $range['start'] > $insert_position ) {
				$range['start'] += $shift_amount;
				$range['end']   += $shift_amount;
			}
		}

		// Shift unsafe_ranges.
		foreach ( $content_analysis['unsafe_ranges'] as &$range ) {
			if ( $range['start'] > $insert_position ) {
				$range['start'] += $shift_amount;
				$range['end']   += $shift_amount;
			}
		}

		return $content_analysis;
	}

	/**
	 * Check if content contains a link to the target URL.
	 *
	 * @param array  $content_analysis Pre-computed analysis.
	 * @param string $target_url       Target URL to check.
	 * @return bool True if link exists.
	 */
	public static function has_target_link( $content_analysis, $target_url ) {
		$normalized = self::normalize_url( $target_url );
		return in_array( $normalized, $content_analysis['existing_hrefs'], true );
	}

	/**
	 * Filter matches that are inside existing links or unsafe contexts.
	 *
	 * @param array $matches          Matches from find_matches_in_content().
	 * @param array $content_analysis Pre-computed analysis.
	 * @return array Filtered matches (only those safe to link).
	 */
	public static function filter_linked_matches( $matches, $content_analysis ) {
		$filtered = [];

		foreach ( $matches as $match ) {
			$pos = $match['position'];
			$end = $pos + strlen( $match['text'] );

			// Check if inside existing link.
			$inside_link = false;
			foreach ( $content_analysis['link_ranges'] as $range ) {
				if ( $pos >= $range['start'] && $end <= $range['end'] ) {
					$inside_link = true;
					break;
				}
			}

			if ( $inside_link ) {
				continue;
			}

			// Check if inside unsafe range (blocks, shortcodes, HTML tags, etc.).
			$in_unsafe_range = false;
			if ( ! empty( $content_analysis['unsafe_ranges'] ) ) {
				foreach ( $content_analysis['unsafe_ranges'] as $range ) {
					// Check if the match overlaps with unsafe range.
					// A match is unsafe if any part of it is within an unsafe range.
					if ( $pos < $range['end'] && $end > $range['start'] ) {
						$in_unsafe_range = true;
						break;
					}
				}
			}

			if ( ! $in_unsafe_range ) {
				$filtered[] = $match;
			}
		}

		return $filtered;
	}

	/**
	 * Extract context around a match position.
	 *
	 * Returns surrounding text with the matched text for preview purposes.
	 * Supports both character-based and sentence-based extraction.
	 *
	 * @param string $content  Full content.
	 * @param int    $position Position of the match.
	 * @param string $text     Matched text.
	 * @param array  $options  {
	 *     Optional. Extraction options.
	 *
	 *     @type string $mode      'chars' or 'sentence'. Default 'chars'.
	 *     @type int    $chars     Number of characters before/after (for chars mode). Default 50.
	 *     @type int    $max_words Maximum words to include (for sentence mode). Default 50.
	 * }
	 * @return array Context with 'before', 'match', 'after', and 'preview' keys.
	 */
	public static function extract_context( $content, $position, $text, $options = [] ) {
		$defaults = [
			'mode'      => 'chars',
			'chars'     => 50,
			'max_words' => 50,
		];
		$options  = array_merge( $defaults, $options );

		if ( 'sentence' === $options['mode'] ) {
			return self::extract_sentence_context( $content, $position, $text, $options['max_words'] );
		}

		return self::extract_char_context( $content, $position, $text, $options['chars'] );
	}

	/**
	 * Normalize URL for comparison.
	 *
	 * @param string $url URL to normalize.
	 * @return string Normalized URL.
	 */
	public static function normalize_url( $url ) {
		// Remove protocol.
		$url = preg_replace( '#^https?://#i', '', $url );

		// Remove www.
		$url = preg_replace( '#^www\.#i', '', $url );

		// Remove trailing slash.
		$url = rtrim( $url, '/' );

		// Convert to lowercase.
		return strtolower( $url );
	}

	/**
	 * Extract context using character-based extraction.
	 *
	 * @param string $content  Full content.
	 * @param int    $position Position of the match.
	 * @param string $text     Matched text.
	 * @param int    $chars    Number of characters to show before and after.
	 * @return array Context with 'before', 'match', 'after', and 'preview' keys.
	 */
	private static function extract_char_context( $content, $position, $text, $chars ) {
		$content_length = strlen( $content );
		$text_length    = strlen( $text );
		$match_end      = $position + $text_length;

		// Calculate start and end positions for context.
		$context_start = max( 0, $position - $chars );
		$context_end   = min( $content_length, $match_end + $chars );

		// Extract text segments.
		$before = substr( $content, $context_start, $position - $context_start );
		$after  = substr( $content, $match_end, $context_end - $match_end );

		// Clean up context (remove HTML tags, normalize whitespace).
		$before = self::clean_context( $before );
		$after  = self::clean_context( $after );

		// Trim to word boundaries for better readability.
		$before = self::trim_to_word_boundary( $before, false );
		$after  = self::trim_to_word_boundary( $after, true );

		// Ensure spacing around the match text.
		$before = rtrim( $before ) . ' ';
		$after  = ' ' . ltrim( $after );

		// Build preview with ellipsis if needed.
		$prefix  = $context_start > 0 ? '...' : '';
		$suffix  = $context_end < $content_length ? '...' : '';
		$preview = $prefix . $before . $text . $after . $suffix;

		return [
			'before'  => trim( $before ),
			'match'   => $text,
			'after'   => trim( $after ),
			'preview' => $preview,
		];
	}

	/**
	 * Extract unsafe ranges where links should not be added.
	 *
	 * Uses a two-path strategy:
	 * - Block Editor: Uses parse_blocks() to analyze structured block content
	 * - Classic Editor: Scans entire HTML content for unsafe patterns
	 *
	 * This includes:
	 * - WordPress blocks (entire block or just comment markers, depending on block type)
	 * - HTML comments (<!-- ... -->)
	 * - Shortcodes ([shortcode])
	 * - HTML tags and attributes (<tag attr="value">)
	 * - Script and style tags
	 *
	 * @param string $content Post content.
	 * @return array Array of unsafe ranges with 'start' and 'end' positions.
	 */
	private static function extract_unsafe_ranges( $content ) {
		$unsafe_ranges = [];

		/**
		 * Filter the list of block types where links can be added.
		 *
		 * By default, only paragraph and heading blocks allow link insertion.
		 * Use this filter to add more block types where links should be allowed.
		 */
		$safe_block_types = apply_filters(
			'rank_math/link_genius/keyword_maps/safe_block_types',
			[
				'core/paragraph',
				'core/heading',
			]
		);

		// Detect if content uses blocks (Block Editor) or plain HTML (Classic Editor).
		if ( has_blocks( $content ) ) {
			// PATH 1: Block Editor - use parse_blocks() for structured analysis.
			$unsafe_ranges = self::extract_unsafe_ranges_from_blocks( $content, $safe_block_types );
		} else {
			// PATH 2: Classic Editor / Page Builder - scan entire content.
			$unsafe_ranges = self::extract_unsafe_ranges_from_html( $content );
		}

		// Sort by start position for efficient filtering later.
		usort(
			$unsafe_ranges,
			function ( $a, $b ) {
				return $a['start'] - $b['start'];
			}
		);

		return $unsafe_ranges;
	}

	/**
	 * Extract context using sentence-based extraction.
	 *
	 * Finds the complete sentence(s) containing the match.
	 *
	 * @param string $content   Full content.
	 * @param int    $position  Position of the match.
	 * @param string $text      Matched text.
	 * @param int    $max_words Maximum words to include.
	 * @return array Context with 'before', 'match', 'after', and 'preview' keys.
	 */
	private static function extract_sentence_context( $content, $position, $text, $max_words ) {
		$text_length = strlen( $text );
		$match_end   = $position + $text_length;

		// Find sentence boundaries (period, exclamation, question mark followed by space or end).
		// Look backwards from match position.
		$before_text    = substr( $content, 0, $position );
		$sentence_start = max(
			strrpos( $before_text, '. ' ),
			strrpos( $before_text, '! ' ),
			strrpos( $before_text, '? ' ),
			0
		);

		if ( $sentence_start > 0 ) {
			$sentence_start += 2; // Skip the punctuation and space.
		}

		// Look forward from match end.
		$after_text   = substr( $content, $match_end );
		$sentence_end = strlen( $content );
		$pos_period   = strpos( $after_text, '. ' );
		$pos_exclaim  = strpos( $after_text, '! ' );
		$pos_question = strpos( $after_text, '? ' );
		$next_punct   = min(
			false !== $pos_period ? $pos_period : PHP_INT_MAX,
			false !== $pos_exclaim ? $pos_exclaim : PHP_INT_MAX,
			false !== $pos_question ? $pos_question : PHP_INT_MAX
		);

		if ( $next_punct < PHP_INT_MAX ) {
			$sentence_end = $match_end + $next_punct + 1; // Include the punctuation.
		}

		// Extract the full sentence.
		$full_sentence = substr( $content, $sentence_start, $sentence_end - $sentence_start );

		// Clean context.
		$cleaned = self::clean_context( $full_sentence );

		// Split into before/match/after based on the position within the sentence.
		$before_length = $position - $sentence_start;
		$before        = self::clean_context( substr( $full_sentence, 0, $before_length ) );
		$after         = self::clean_context( substr( $full_sentence, $before_length + $text_length ) );

		// Trim to max words if needed.
		$preview = wp_trim_words( $cleaned, $max_words, '...' );

		return [
			'before'  => trim( $before ),
			'match'   => $text,
			'after'   => trim( $after ),
			'preview' => $preview,
		];
	}

	/**
	 * Clean context text by removing HTML tags and normalizing whitespace.
	 *
	 * @param string $text Text to clean.
	 * @return string Cleaned text.
	 */
	private static function clean_context( $text ) {
		// Remove HTML comments first (<!-- ... -->).
		$text = preg_replace( '/<!--.*?-->/s', ' ', $text );

		// Strip HTML tags.
		$text = wp_strip_all_tags( $text );

		// Normalize whitespace (convert multiple spaces/newlines to single space).
		$text = preg_replace( '/\s+/', ' ', $text );

		return trim( $text );
	}

	/**
	 * Trim text to nearest word boundary.
	 *
	 * @param string $text       Text to trim.
	 * @param bool   $trim_start True to trim from start, false to trim from end.
	 * @return string Trimmed text.
	 */
	private static function trim_to_word_boundary( $text, $trim_start ) {
		if ( empty( $text ) ) {
			return $text;
		}

		if ( $trim_start ) {
			// Find first space and trim everything before it.
			$space_pos = strpos( $text, ' ' );
			if ( false !== $space_pos && $space_pos > 0 ) {
				$text = substr( $text, $space_pos + 1 );
			}
		} else {
			// Find last space and trim everything after it.
			$space_pos = strrpos( $text, ' ' );
			if ( false !== $space_pos && $space_pos < strlen( $text ) - 1 ) {
				$text = substr( $text, 0, $space_pos );
			}
		}

		return trim( $text );
	}

	/**
	 * Extract unsafe ranges for Block Editor content using parse_blocks().
	 *
	 * Uses WordPress native parse_blocks() to get structured block data,
	 * then recursively processes each block to determine safe/unsafe ranges.
	 *
	 * @param string $content          Post content with blocks.
	 * @param array  $safe_block_types Array of safe block type names.
	 * @return array Array of unsafe ranges.
	 */
	private static function extract_unsafe_ranges_from_blocks( $content, $safe_block_types ) {
		$unsafe_ranges = [];
		$blocks        = parse_blocks( $content );

		// Process each top-level block recursively.
		foreach ( $blocks as $block ) {
			$block_unsafe  = self::process_block_recursively(
				$block,
				$content,
				$safe_block_types,
				false  // parent_is_unsafe = false for top-level blocks.
			);
			$unsafe_ranges = array_merge( $unsafe_ranges, $block_unsafe );
		}

		return $unsafe_ranges;
	}

	/**
	 * Extract unsafe ranges for Classic Editor / page builder content.
	 *
	 * Scans entire content for unsafe patterns when blocks are not present.
	 *
	 * @param string $content Post content (HTML without blocks).
	 * @return array Array of unsafe ranges.
	 */
	private static function extract_unsafe_ranges_from_html( $content ) {
		// Scan entire content for unsafe patterns.
		return self::scan_for_unsafe_patterns( $content, 0 );
	}

	/**
	 * Get the start and end positions of a block in the original content.
	 *
	 * @param array  $block   Block data from parse_blocks().
	 * @param string $content Full post content.
	 * @return array|false Array with 'start' and 'end' keys, or false if not found.
	 */
	private static function get_block_range_in_content( $block, $content ) {
		// Blocks have comment markers in original content.
		// Note: parse_blocks() returns 'core/paragraph' but HTML has '<!-- wp:paragraph -->'
		// So we need to remove the 'core/' namespace prefix for core blocks.
		$block_name = $block['blockName'];

		// Strip 'core/' prefix for core blocks to match HTML format.
		if ( strpos( $block_name, 'core/' ) === 0 ) {
			$block_name = substr( $block_name, 5 ); // Remove 'core/' (5 characters).
		}

		$opening_pattern = '<!-- wp:' . $block_name;
		$closing_pattern = '<!-- /wp:' . $block_name . ' -->';

		// Find opening comment.
		$start = strpos( $content, $opening_pattern );
		if ( false === $start ) {
			return false;
		}

		// Find corresponding closing comment after the opening.
		$end_search_start = $start + strlen( $opening_pattern );
		$end              = strpos( $content, $closing_pattern, $end_search_start );
		if ( false === $end ) {
			return false;
		}

		return [
			'start' => $start,
			'end'   => $end + strlen( $closing_pattern ),
		];
	}

	/**
	 * Process a block and its children recursively.
	 *
	 * Handles nested blocks with inheritance: if a parent block is unsafe,
	 * all its children are automatically unsafe.
	 *
	 * @param array  $block             Block data from parse_blocks().
	 * @param string $content           Full post content.
	 * @param array  $safe_block_types  Array of safe block type names.
	 * @param bool   $parent_is_unsafe  Whether parent block was unsafe.
	 * @return array Unsafe ranges for this block and its children.
	 */
	private static function process_block_recursively( $block, $content, $safe_block_types, $parent_is_unsafe = false ) {
		$unsafe_ranges = [];

		// Skip empty blocks (parse_blocks can return empty array items).
		if ( empty( $block['blockName'] ) ) {
			return $unsafe_ranges;
		}

		// Get block position in content.
		$block_range = self::get_block_range_in_content( $block, $content );
		if ( false === $block_range ) {
			return $unsafe_ranges; // Could not find block in content.
		}

		// If parent was unsafe, mark entire block as unsafe and stop.
		// This implements inheritance: children of unsafe blocks are automatically unsafe.
		if ( $parent_is_unsafe ) {
			$unsafe_ranges[] = [
				'start' => $block_range['start'],
				'end'   => $block_range['end'],
				'type'  => 'wp_block_nested',
			];
			return $unsafe_ranges;
		}

		// Check if this block is safe.
		// Block name must match exactly what parse_blocks() returns (e.g., 'core/paragraph').
		$is_safe = in_array( $block['blockName'], $safe_block_types, true );

		if ( $is_safe ) {
			// Safe block: protect comment markers, scan innerHTML for nested unsafe patterns.

			// Protect opening comment (from block start to end of opening comment).
			$opening_comment_end = strpos( $content, '-->', $block_range['start'] );
			if ( false !== $opening_comment_end ) {
				$unsafe_ranges[] = [
					'start' => $block_range['start'],
					'end'   => $opening_comment_end + 3,
					'type'  => 'block_comment',
				];
			}

			// Protect closing comment (from start of closing comment to block end).
			// The closing comment starts with '<!-- /wp:' and we search backwards from block end.
			$closing_comment_start = strrpos( substr( $content, 0, $block_range['end'] ), '<!-- /wp:' );
			if ( false !== $closing_comment_start ) {
				$unsafe_ranges[] = [
					'start' => $closing_comment_start,
					'end'   => $block_range['end'],
					'type'  => 'block_comment',
				];
			}

			// Scan innerHTML for unsafe patterns (shortcodes, scripts, etc.).
			if ( ! empty( $block['innerHTML'] ) ) {
				$inner_html_start  = $opening_comment_end + 3;
				$inner_html_unsafe = self::scan_for_unsafe_patterns(
					$block['innerHTML'],
					$inner_html_start
				);
				$unsafe_ranges     = array_merge( $unsafe_ranges, $inner_html_unsafe );
			}

			// Process innerBlocks (children) with parent_is_unsafe = false.
			// Safe parent allows children to be processed based on their own type.
			if ( ! empty( $block['innerBlocks'] ) ) {
				foreach ( $block['innerBlocks'] as $inner_block ) {
					$inner_unsafe  = self::process_block_recursively(
						$inner_block,
						$content,
						$safe_block_types,
						false  // Parent is safe, children process normally.
					);
					$unsafe_ranges = array_merge( $unsafe_ranges, $inner_unsafe );
				}
			}
		} else {
			// Unsafe block: protect entire block INCLUDING all children.
			$unsafe_ranges[] = [
				'start' => $block_range['start'],
				'end'   => $block_range['end'],
				'type'  => 'wp_block',
			];

			// Important: Do NOT process innerBlocks when parent is unsafe.
			// The entire block range is already protected above.
			// Processing innerBlocks separately would be redundant and could cause issues
			// with nested safe blocks (e.g., paragraph inside columns).
		}

		return $unsafe_ranges;
	}

	/**
	 * Scan content for unsafe patterns (shortcodes, scripts, styles, HTML tags, comments).
	 *
	 * This method is used by both Block Editor and Classic Editor paths.
	 *
	 * Performance optimized: Uses a single combined regex pattern instead of 5 separate scans.
	 *
	 * @param string $content Content to scan.
	 * @param int    $offset  Offset to add to positions (for nested content).
	 * @return array Array of unsafe ranges.
	 */
	private static function scan_for_unsafe_patterns( $content, $offset = 0 ) {
		$unsafe_ranges = [];

		// Combined pattern: Match scripts, styles, and shortcodes in one pass.
		// This is faster than running 3 separate regex scans.
		$combined_pattern = '/'
			. '(?<script><script[^>]*>.*?<\/script>)'  // Script tags.
			. '|(?<style><style[^>]*>.*?<\/style>)'    // Style tags.
			. '|(?<shortcode>\[[^\]]+\])'              // Shortcodes.
			. '/is';

		if ( preg_match_all( $combined_pattern, $content, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER ) ) {
			foreach ( $matches as $match ) {
				// Determine type based on which named group matched.
				if ( ! empty( $match['script'][0] ) ) {
					$type       = 'script';
					$full_match = $match['script'];
				} elseif ( ! empty( $match['style'][0] ) ) {
					$type       = 'style';
					$full_match = $match['style'];
				} else {
					$type       = 'shortcode';
					$full_match = $match['shortcode'];
				}

				$unsafe_ranges[] = [
					'start' => $offset + $full_match[1],
					'end'   => $offset + $full_match[1] + strlen( $full_match[0] ),
					'type'  => $type,
				];
			}
		}

		// HTML tags (<tag attr="value">) - protects tag markup and attributes.
		// Kept separate because it needs different flags and is very common.
		if ( preg_match_all( '/<[^>]+>/s', $content, $matches, PREG_OFFSET_CAPTURE ) ) {
			foreach ( $matches[0] as $match ) {
				$unsafe_ranges[] = [
					'start' => $offset + $match[1],
					'end'   => $offset + $match[1] + strlen( $match[0] ),
					'type'  => 'html_tag',
				];
			}
		}

		// HTML comments (<!-- comment -->) - excluding WordPress block comments.
		// Kept separate because of negative lookahead for wp: blocks.
		if ( preg_match_all( '/<!--(?! wp:).*?-->/s', $content, $matches, PREG_OFFSET_CAPTURE ) ) {
			foreach ( $matches[0] as $match ) {
				$unsafe_ranges[] = [
					'start' => $offset + $match[1],
					'end'   => $offset + $match[1] + strlen( $match[0] ),
					'type'  => 'html_comment',
				];
			}
		}

		return $unsafe_ranges;
	}
}
