<?php
$dd__social_data_defaults = array(
  'dd__social_title' => get_bloginfo('name') . ' - ' . get_bloginfo('description'),
  'dd__social_share_image' => carbon_get_theme_option('dd__social_share_image'),
  'dd__social_description' => carbon_get_theme_option('dd__social_description'),
  'dd__social_keywords' => carbon_get_theme_option('dd__social_keywords'),
);
$dd__social_data = array(
  'dd__social_title' => null,
  'dd__social_share_image' => null,
  'dd__social_description' => null,
  'dd__social_keywords' => null
);

if (is_singular()) {
  $dd__queried_object = get_queried_object();

  $dd__social_data['dd__social_title'] = get_bloginfo('name') . ' - ' . $dd__queried_object->post_title;
  $dd__social_data['dd__social_share_image'] = get_the_post_thumbnail_url(
    $dd__queried_object->ID,
    'full'
  );
  $dd__social_data['dd__social_description'] = $dd__queried_object->post_excerpt;
}

foreach ($dd__social_data as $key => $value) {
  if (!$value) {
    $dd__social_data[$key] = $dd__social_data_defaults[$key];
  }
}
?>

<?php if ($dd__social_data['dd__social_title']) : ?>
<meta property="og:title" content="<?php echo $dd__social_data['dd__social_title']; ?>" />
<?php endif; ?>

<?php if ($dd__social_data['dd__social_description']) : ?>
<meta property="og:description" content="<?php echo $dd__social_data['dd__social_description']; ?>" />
<?php endif; ?>

<?php if ($dd__social_data['dd__social_share_image']) : ?>
<meta property="og:image" content="<?php echo $dd__social_data['dd__social_share_image']; ?>" />
<?php endif; ?>

<?php if ($dd__social_data['dd__social_keywords']) : ?>
<meta name="keywords" content="<?php echo $dd__social_data['dd__social_keywords']; ?>"/>
<?php endif; ?>

<?php if ($dd__social_data['dd__social_description']) : ?>
<meta name="description" content="<?php echo $dd__social_data['dd__social_description']; ?>"/>
<?php endif; ?>
