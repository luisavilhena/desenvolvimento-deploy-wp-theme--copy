<?php

function dd_component__page_header($options) {
  dd_component__page_section(array(
    'classes' => array('page-header'),
    'background_color' => 'magenta',
  ), function () use ($options) {
    ?>
    <div class="row">
      <div class="col-md-6">
        <h1 class="h1">
          <?php echo $options['title']; ?>
        </h1>
      </div>
      <div class="col-md-6">

      </div>
    </div>
    <?php
  });
}
