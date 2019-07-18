<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('theme_options', 'Informações de contato e redes sociais')
  ->add_fields(array(
  	// Contact info
    Field::make('text','dd__email', 'E-mail'),
    Field::make('text','dd__phone', 'Telefone'),
    Field::make('text','dd__instagram_url', 'Instagram'),
    Field::make('text','dd__facebook_url', 'Facebook'),
    Field::make('text','dd__linkedin_url', 'Linked-in'),

    // Social
    Field::make('image', 'dd__social_share_image', 'Imagem de compartilhamento')
      ->set_value_type('url'),
    Field::make('textarea', 'dd__social_description', 'Descrição de compartilhamento'),
    Field::make('textarea', 'dd__social_keywords', 'Palavras chave'),

    // Google Analytics
    Field::make('textarea', 'dd__google_analytics_script', 'Google Analytics Tracking Code'),
  ));

Container::make('theme_options', 'Redirecionamentos')
  ->add_fields(array(
    Field::make('complex', 'dd__redirects', 'Redirecionamentos')
      ->add_fields(array(
        Field::make('text', 'source', 'Endereço original'),
        Field::make('text', 'destination', 'Endereço destino'),
      ))
  ));
