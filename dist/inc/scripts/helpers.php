<?php

function oo_import_readdir($dir) {
  return array_values(array_filter(scandir($dir), function ($content_name) {
    return $content_name !== '.' && $content_name !== '..';
  }));
}

function oo_import_run($step_name, $import_id, $function, $dry_function = false) {
  if ($import_id) {
    WP_CLI::log('EXEC ' . $step_name);
    $function();
  } else {
    WP_CLI::log('DRY_RUN ' . $step_name);
    if ($dry_function) {
      $dry_function();
    }
  }
}

function oo_import_log() {
  $args = func_get_args();
  $message = array_shift($args);

  WP_CLI::log($message . '(' . join(', ') . ')');
}

function oo_get_post_by_slug($slug) {
  $posts = get_posts(array(
    'name' => $slug,
    'post_type' => 'post',
    'posts_per_page' => 1,
    'post_status' => 'any',
  ));

  return count($posts) > 0 ? $posts[0] : null;
}

function oo_import_meta_input($import_id, $meta_input = array()) {
  $meta_input['_import_id'] = $import_id;
  $meta_input['_import_date'] = date('Y-m-d H:i:s');

  return $meta_input;
}

/**
 * https://codex.wordpress.org/Function_Reference/wp_insert_attachment
 */
function oo_import_upload($import_id, $absolute_path) {
  $upload = wp_upload_bits(
    basename($absolute_path),
    null,
    file_get_contents($absolute_path)
  );

  WP_CLI::log('Uploaded ' . $upload['file']);

  $upload_basename = basename($upload['file']);

  $attachment_id = wp_insert_attachment(
    array(
      'guid' => wp_upload_dir()['url'] . '/' . $upload_basename,
      'post_mime_type' => wp_check_filetype($upload_basename, null)['type'],
      'post_title' => sanitize_title($upload_basename),
      'post_content' => '',
      'post_status' => 'publish',
      'meta_input' => oo_import_meta_input($import_id),
    ),
    $upload['file']
  );

  return $attachment_id;
}

function oo_ensure_term($taxonomy, $term_name) {
  $term_slug = sanitize_title($term_name);

  $term = get_term_by('slug', $term_slug, $taxonomy);

  if (!$term) {
    $term_id = wp_insert_term(
      $term_name,
      $taxonomy,
      array(
        'slug' => $term_slug
      )
    )['term_id'];
  } else {
    $term_id = $term->term_id;
  }

  return $term_id;
}

function oo_import_post_resources($import_id, $post_id, $resources) {
  $post = get_post($post_id);

  if (!$post && $import_id) {
    WP_CLI::error('Could not find post by id: ' . $post_id);
    return;
  }

  // Post content may be manipulated by resource uploading
  $post_updated_content = $post->post_content;

  //
  // Upload resources
  //
  foreach ($post_resources as $resource) {
    if ($import_id) {
      $resource_attachment_id = oo_import_upload(
        $import_id,
        $resource['absolute_path']
      );
      $resource_attachment_url = wp_get_attachment_url($resource_attachment_id);
    } else {
      $resource_attachment_id = 'ID(' . $resource['absolute_path'] . ')';
      $resource_attachment_url = 'URL(' . $resource['absolute_path'] . ')';
    }
    oo_import_log(
      'DRY_RUN: oo_import_post_resources > oo_import_upload',
      $resource['absolute_path']
    );

    if ($resource['is_featured_image']) {
      //
      // Featured image
      //
      if ($import_id) {
        set_post_thumbnail($post_id, $resource_attachment_id);
      }
      oo_import_log(
        'DRY_RUN: oo_import_post_resources > set_post_thumbnail',
        $post_id,
        $resource_attachment_id
      );
    }

    if ($resource['url_in_content']) {
      //
      // Part of post content
      //
      $post_updated_content = str_replace(
        $resource['url_in_content'],
        $resource_attachment_url,
        $post_updated_content
      );
    }

    if ($resource['carbon_post_meta_field']) {
      //
      // Carbon meta field
      //
      //
      if ($import_id) {
        carbon_set_post_meta(
          $post_id,
          $resource['carbon_post_meta_field'],
          $resource_attachment_id
        );
      }
      oo_import_log(
        'DRY_RUN: oo_import_post_resources > carbon_set_post_meta',
        $post_id,
        $resource['carbon_post_meta_field'],
        $resource_attachment_id
      );
    }
  }

  if ($post_updated_content !== $post->post_content) {
    //
    // Post content was modified by the upload of resources
    // Update the content
    //
    if (!$import_id) {
      oo_import_log(
        'DRY_RUN: oo_import_post_resources > update post content',
        $post_id
      );
    } else {
      wp_insert_post(array(
        'ID' => $post_id,
        'post_content' => $post_updated_content
      ));
      oo_import_log('DONE: oo_import_post_resources > update post content');
    }
  }
}

function oo_import_post(
  $import_id,
  $post_data,
  $options = array()) {
  //
  // Add a meta key that identifies the post as a imported
  // content in order to allow for rollbacks
  //
  $post_data['meta_input'] = oo_import_meta_input($import_id, $post_data['meta_input']);

  //
  // Insert post into database
  //
  if ($import_id) {
    $post_id = wp_insert_post($post_data);
  } else {
    $post_id = sanitize_title($post_data['post_title']);
  }
  oo_import_log('DRY_RUN: oo_import_post', $post_data['post_title']);

  if ($options['resources']) {
    oo_import_post_resources($import_id, $post_id, $options['resources']);
  }
}

function oo_import_post_from_dir($import_id, $post_dir) {
  //
  // Load post.json as an associative array,
  // so that it is automatically compatible
  // with wp_insert_post
  //
  // https://www.php.net/manual/en/function.json-decode.php
  // https://developer.wordpress.org/reference/functions/wp_insert_post/
  //
  $post_data = json_decode(file_get_contents($post_dir . '/post.json'), true);
  $post_data['post_content'] = file_get_contents($post_dir . '/index.html');

  //
  // _resources field is a special one
  //
  $resources = array_map(function ($resource) {
    $resource['absolute_path'] = $post_dir . '/' . $resource['relative_path'];
    $resource['url_in_content'] = $resource['relative_path'];

    return $resource;
  }, $post_data['_resources']);

  $terms = array_map(function ($term) {
    // TODO
  }, $post_data['_terms']);

  oo_import_post($import_id, $post_data, array(
    'resources' => $resources,
  ));
}

function oo_import_multiple_posts_from_dir($import_id, $posts_dir) {
  $post_dirnames = oo_import_readdir($posts_dir);

  foreach ($post_dirnames as $post_dirname) {
    oo_import_post_from_dir(
      $import_id,
      $posts_dir . '/' . $post_dirname
    );
  }
}
