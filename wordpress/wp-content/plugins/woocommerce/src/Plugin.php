<?php

namespace PrintEngine;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin core class.
 *
 * Bootstraps the plugin and provides a central access point
 * for all plugin functionality.
 */
final class Plugin {

	/**
	 * Singleton instance.
	 *
	 * @var Plugin|null
	 */
	private static ?Plugin $instance = null;

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	public string $version;

	/**
	 * Private constructor — use Plugin::init() to bootstrap.
	 */
	private function __construct() {
		$this->version = PRINTENGINE_WC_ADDON_VERSION;
	}

	/**
	 * Initialise the plugin.
	 *
	 * Called once from the main plugin file after the WooCommerce
	 * dependency check has passed.
	 *
	 * @return Plugin
	 */
	public static function init(): Plugin {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->bootstrap();
		}

		return self::$instance;
	}

	/**
	 * Return the singleton instance.
	 *
	 * @return Plugin|null  null if init() has not been called yet.
	 */
	public static function instance(): ?Plugin {
		return self::$instance;
	}

	/**
	 * Bootstrap hooks and sub-systems.
	 *
	 * Add new feature modules here as the plugin grows.
	 */
	private function bootstrap(): void {
		// Future: load text domain, register hooks, instantiate sub-modules.
	}
}