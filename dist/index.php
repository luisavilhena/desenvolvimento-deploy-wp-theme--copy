<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package desenvolvimento-deploy-wp-theme
 */

get_header(); ?>

<main class="below-header-container" style="background-color: darkorange">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    dd_component__page_section(array(
      'background-color' => 'magenta',
    ), function () {
      ?>
      <div class="dd-container" style="background-color: black">
        <div class="dd-header-page">
          <h1>
            <span>Hell</span>o, lorem!
          </h1>
          <h2 style="background-color: white">
            Ispum
          </h2>
        </div>
        <img  class="dd-image"src="<?php echo get_template_directory_uri(); ?>/resources/img/fish.jpg">
      </div>
      <?php
    })
    ?>
  <?php endwhile; ?>
</main>

<?php
get_footer();
