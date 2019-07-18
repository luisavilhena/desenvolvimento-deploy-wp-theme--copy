<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package desenvolvimento-deploy-wp-theme
 */

global $wp;

$dd__redirects = carbon_get_theme_option('dd__redirects');

foreach ($dd__redirects as $redirect) {
	if ($redirect['source'] === $wp->request ||
			$redirect['source'] === home_url($wp->request)) {
		wp_redirect($redirect['destination'], 301);
	}
}

get_header(); ?>

<?php
get_footer();
