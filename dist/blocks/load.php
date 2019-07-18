<?php

function dd_blocks__register_block($block_id, $script) {
  wp_register_script(
    $block_id,
    $script,
    array('wp-blocks', 'wp-element', 'wp-editor')
  );

  register_block_type($block_id, array(
    'editor_script' => $block_id,
  ));
}


add_filter('block_categories', function ($categories, $post) {
  return array_merge(
    $categories,
    array(
      array(
        'slug' => 'dd',
        'title' => 'dd Blocks',
      ),
    )
  );
}, 10, 2);

function dd_blocks__register() {
  /**
   * Client side blocks
   */
  $client_side_specs = array(
    array(
      'name' => 'row',
    ),
    array(
      'name' => 'column',
    ),
    array(
      'name' => 'page-section',
    ),
    array(
      'name' => 'button'
    )
  );

  foreach ($client_side_specs as $spec) {
    dd_blocks__register_block(
      'dd/' . $spec['name'],
      get_template_directory_uri() . '/blocks/client-side/' . $spec['name'] . '/index.bundle.js'
    );
  }

  /**
   * Server side blocks
   */
  require('server-side/example.php');
}
add_action('init', 'dd_blocks__register');

