<?php

namespace PrintEngine\Product;

use Automattic\WooCommerce\StoreApi\Schemas\V1\CartItemSchema;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Integrates PrintEngine custom data with the WooCommerce Block Cart
 * (Store API / Gutenberg block-based cart and checkout).
 */
class BlockCartIntegration {

	const EXTENSION_NAMESPACE = 'printengine';

	public static function register(): void {
		// Register with the Store API integration registry.
		add_action( 'woocommerce_blocks_loaded', [ self::class, 'register_integration' ] );
	}

	public static function register_integration(): void {
		if ( ! class_exists( '\Automattic\WooCommerce\StoreApi\StoreApi' ) ) {
			return;
		}

		\Automattic\WooCommerce\StoreApi\StoreApi::container()
			->get( \Automattic\WooCommerce\StoreApi\Schemas\ExtendSchema::class )
			->register_endpoint_data(
				[
					'endpoint'        => CartItemSchema::IDENTIFIER,
					'namespace'       => self::EXTENSION_NAMESPACE,
					'data_callback'   => [ self::class, 'cart_item_data' ],
					'schema_callback' => [ self::class, 'cart_item_schema' ],
					'schema_type'     => ARRAY_A,
				]
			);
	}

	/**
	 * Returns the PrintEngine data for a cart item to expose via Store API.
	 */
	public static function cart_item_data( array $cart_item ): array {
		$mode = $cart_item['printengine_print_mode'] ?? '';
		$data = [ 'mode' => $mode ];

		if ( $mode === 'text' ) {
			$data['print_text'] = $cart_item['printengine_print_text'] ?? '';
		} else {
			$data['image_url'] = $cart_item['printengine_image_url'] ?? '';
		}

		return $data;
	}

	/**
	 * JSON Schema for the PrintEngine cart item extension data.
	 */
	public static function cart_item_schema(): array {
		return [
			'mode'       => [
				'description' => 'Print mode: text or image.',
				'type'        => 'string',
				'context'     => [ 'view', 'edit' ],
				'readonly'    => true,
			],
			'print_text' => [
				'description' => 'Custom print text.',
				'type'        => 'string',
				'context'     => [ 'view', 'edit' ],
				'readonly'    => true,
			],
			'image_url'  => [
				'description' => 'URL of the selected print image.',
				'type'        => 'string',
				'context'     => [ 'view', 'edit' ],
				'readonly'    => true,
			],
		];
	}
}