<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Configurações de redirecionamento')
  ->add_fields(array(
    Field::make('text', 'ap_post__redirect_target_url', 'Link de redirecionamento')
  ));
