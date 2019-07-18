<?php

function dd__column($column) {
  ?>
  <div class="<?php echo $column['class']; ?>">
    <?php echo $column['contents']; ?>
  </div>
  <?php
}

function dd__component_row($columns) {
  ?>
  <div class="row">
    <?php
    foreach ($columns as $column) {
      dd__column($column);
    }
    ?>
  </div>
  <?php
}

function dd__component_row_3_9($left, $right) {
  dd__component_row(array(
    array(
      'class' => 'col-md-3',
      'contents' => $left(),
    ),
    array(
      'class' => 'col-md-9',
      'contents' => $right(),
    )
  ));
}
