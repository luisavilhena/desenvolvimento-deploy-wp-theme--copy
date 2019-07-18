<?php
/**
 * Template Name: Maintenance
 */

get_header(); ?>
<?php while (have_posts()) : the_post(); ?>

<main id="page-maintenance">
	<h1>Maintenance: <?php the_title(); ?></h1>
	<?php the_permalink(); ?>
<?php the_content(); ?>
</main>

<?php endwhile; ?>

<?php
get_footer();
