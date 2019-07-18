<?php
use Carbon_Fields\Field;
use Carbon_Fields\Block;

Block::make('dd Example')
  ->set_category('dd')
  ->set_inner_blocks(true)
  ->set_inner_blocks_position('below')
  ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
    ?>
    <div class="dd-example">
      <?php echo $inner_blocks; ?>
    </div>
    <?php
  });
