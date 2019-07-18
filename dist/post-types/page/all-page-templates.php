<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_post_type_support('page', array('excerpt'));

Container::make('post_meta', 'Configurações gerais da página')
  ->where('post_type', '=', 'page')
  ->add_fields(array(
    Field::make('select', 'ap_page__color_scheme', 'Esquema de cores da página')
      ->set_options(array(
        'marine' => 'Azul',
        'purple' => 'Roxo',
        'peach' => 'Pêssego',
        'pink' => 'Rosa',
        'turquoise' => 'Turquesa',
      ))
  ));
