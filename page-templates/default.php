<?php
/**
 * Default page template
 */

get_header(); ?>
<?php while (have_posts()) : the_post(); ?>

<main id="page-default" class="page-blocks-container">
  <!-- Page header -->
  <?php
  dd_component__page_header(array(
    'title' => get_the_title(),
  ));
  ?>

  <!-- Page blocks -->
  <?php the_content(); ?>
</main>

<?php endwhile; ?>

<?php
get_footer();
