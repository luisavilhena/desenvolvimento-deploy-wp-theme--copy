<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package desenvolvimento-deploy-wp-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<?php echo carbon_get_theme_option('dd__google_analytics_script'); ?>
	<?php require('partials/social-meta-tags.php'); ?>
</head>

<body class="bg-grey" <?php body_class(); ?>>
	<!-- <div id="mobile-menu-overlay"></div> -->
	<header id="main-header">
    <div class="bg-grey">
  	  <div class="website-side-padding website-max-width">

  	    <button id="mobile-menu-trigger">
  	      <span></span>
  	      <span></span>
  	      <span></span>
  	    </button>

  	    <nav id="main-menu-container">
  	      <?php
  	        wp_nav_menu(array(
  	          'theme_location' => 'main-menu',
  	          'menu_id'        => 'main-menu',
  	        ));

  	        wp_nav_menu(array(
  	          'theme_location' => 'main-menu-cta',
  	          'menu_id'        => 'main-menu-cta',
  	        ));
  	      ?>
  	    </nav>
        <form
          action=""
          method="get">
          <input
            placeholder="Busque por palavra"
            name="s"
            value="<?php echo get_search_query(); ?>">
          <button
            type="submit">
            <?php require('resources/icon/magnifier.svg'); ?>
          </button>          
        </form>
  	  </div>
    </div>
	</header>
