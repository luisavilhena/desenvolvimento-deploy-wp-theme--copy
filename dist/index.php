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

<main class="below-header-container bg-white">
    <?php
    dd_component__page_section(array(
      'background-color' => 'magenta',
    ), function () {
      ?>
      <div class="dd-container">
        <img  class="dd-image"src="<?php echo get_template_directory_uri(); ?>/resources/img/beetle.jpg">
      </div>
      <?php
    })
    ?>
  <button id="button">teste</button>
</main>

<?php
get_footer();
