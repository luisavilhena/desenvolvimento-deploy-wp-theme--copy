<?php

function dd__enqueue_scripts_and_styles() {
	/**
	 * Register styles
	 */
	wp_register_style(
		'dd--main-style',
		get_stylesheet_uri(),
		array(),
		'1.0.0'
	);

	/**
	 * Register scripts
	 */
	wp_deregister_script('jquery');
	wp_register_script(
		'jquery',
		'https://code.jquery.com/jquery-3.3.1.min.js',
		array(),
		'3.3.1'
	);

	wp_register_script(
		'dd--header',
		get_template_directory_uri() . '/js/header/index.bundle.js',
		array('jquery'),
		'1.0.0'
	);

	/**
	 * Page specific scripts
	 */
	wp_register_script(
		'dd--page-template-home',
		get_template_directory_uri() . '/js/page-template-home/index.bundle.js',
		array('jquery'),
		'1.0.0'
	);

	/**
	 * Enqueue styles and scripts
	 */
	wp_enqueue_style('dd--main-style');

	wp_enqueue_script('dd--header');

	if (is_page_template('page-templates/home.php')) {
		wp_enqueue_script('dd--page-template-home');
	}
}
add_action('wp_enqueue_scripts', 'dd__enqueue_scripts_and_styles');
