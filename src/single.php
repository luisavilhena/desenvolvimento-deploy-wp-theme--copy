<?php
get_header(); ?>
<main id="page-template-single">

<?php while (have_posts()) : the_post(); ?>
	<?php the_title(); ?>

  <div>
    <?php the_content(); ?>
  </div>
<?php endwhile; ?>

</main>

<?php
get_footer();
