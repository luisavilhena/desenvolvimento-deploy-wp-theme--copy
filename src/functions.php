<?php
/**
 * desenvolvimento-deploy-wp-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package desenvolvimento-deploy-wp-theme
 */

/**
 * Verify function dependencies and set stub functions
 * in case they are not present.
 */
function dd__function_dependencies() {

}

/**
 * Sets up carbon fields
 */
function dd__load_carbon_fields() {
	// see https://github.com/htmlburger/carbon-fields/issues/457
	define(
		'Carbon_Fields\URL',
		get_template_directory_uri() . '/vendor/htmlburger/carbon-fields'
	);

  require_once('vendor/autoload.php');
  \Carbon_Fields\Carbon_Fields::boot();

	add_action('carbon_fields_register_fields', 'dd__register_carbon_fields');
	function dd__register_carbon_fields() {
		require_once('inc/theme-options.php');
		require_once('blocks/load.php');
	}
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dd__setup() {

	/**
	 * Development functions START
	 *
	 * ATTENTION!
	 * Do not modify without updating gulp/distribute task definition
	 */
	require_once('inc/development/load.php');
	/**
	 * Development functions END
	 */

	/**
	 * Config
	 */
	require_once('inc/config.php');

	/**
	 * Ensure functions depended upon exist
	 */
	dd__function_dependencies();

	/**
	 * Helpers
	 */
	require_once('inc/helpers.php');

	/**
	 * Wordpress configuration files:
	 * - enqueue scripts and styles
	 * - image-sizes
	 * - nav-menus
	 */
	require_once('inc/enqueue-scripts-and-styles.php');
	require_once('inc/image-sizes.php');
	require_once('inc/nav-menus.php');

	/**
	 * Components
	 */
	require_once('components/load.php');

	/**
	 * Translation system
	 */
	require_once('inc/translation-system.php');

	/**
	 * Setup carbon fields
	 */
	dd__load_carbon_fields();

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Admin configuration
	 */
	require_once('inc/configure-admin.php');
}
add_action('after_setup_theme', 'dd__setup');
