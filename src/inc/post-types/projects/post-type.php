<?php

function dd_register_project_post_type() {
  $labels = array (
    'name' => _x('Projetos', 'Projetos', 'desenvolvimento-deploy-wp-theme--copy'),
    'singular_name' => _x('Projeto', 'Projeto', 'desenvolvimento-deploy-wp-theme--copy'),
    'menu_name' => __('Projetos', 'desenvolvimento-deploy-wp-theme--copy'),
    'name_admin_bar' => __('Projeto', 'desenvolvimento-deploy-wp-theme--copy'),
    'all_items' => __('Todos os projetos', 'desenvolvimento-deploy-wp-theme--copy'),
    'add_new_item' => __('Adicionar Novo', 'desenvolvimento-deploy-wp-theme--copy'),
    'new_item' => __('Novo projeto', 'desenvolvimento-deploy-wp-theme--copy'),
    'edit_item' => __('Editar Projeto', 'desenvolvimento-deploy-wp-theme--copy'),
    'update_item' => __('Atualizar Projeto', 'desenvolvimento-deploy-wp-theme--copy'),
    'view-item' => __('Visualizar Projeto', 'desenvolvimento-deploy-wp-theme--copy'),
    'view-items' => __('Visualizar Projetos', 'desenvolvimento-deploy-wp-theme--copy')
  );
  $args = array(
    'label' => __('Projeto', 'desenvolvimento-deploy-wp-theme--copy'),
    'description' => __('Projeto Description', 'desenvolvimento-deploy-wp-theme--copy'),
    'labels' => $labels,
    'supports' => array('title', 'editor', 'thumbnail'),
    'taxonomies' => array(),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-megaphone',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'show_in_rest' => true,
    'can_expost' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable'=> true,
    'capability_type' => 'post',
    'rewrite' => array(
      'slug' => 'projects',
    ),
  );
  register_post_type('dd_projects', $args);
}
add_action('init', 'dd_register_project_post_type', 0);