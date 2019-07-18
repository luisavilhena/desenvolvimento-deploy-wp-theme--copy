<?php

function dd__helper_html_node($tag, $attributes = array(), $contents) {
  $attributes = array_map(
    function ($value, $key) {
      return $key . '="' . $value . '"';
    },
    $attributes,
    array_keys($attributes)
  );
  ?>
  <<?php echo $tag?> <?php echo join(' ', $attributes); ?>>
    <?php $contents(); ?>
  <<?php echo $tag?>>
  <?php
}

function dd__helper_classes(
  $default_classes,
  $conditional_classes) {
  $applied_classes = is_array($default_classes) ? $default_classes : array();

  foreach ($conditional_classes as $class_name => $value) {
    if ($value) {
      array_push($applied_classes, $class_name);
    }
  }

  return join(' ', $applied_classes);
}
