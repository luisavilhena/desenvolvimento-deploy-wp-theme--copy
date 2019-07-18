<?php

function dd_component__breadcrumb($steps) {
  ?>
  <div class="dd-breadcrumb">
    <?php foreach ($steps as $index => $step) : ?>
    <?php if ($step['url']) : ?>
    <a class="dd-breadcrumb__step" href="<?php echo $step['url']; ?>">
      <?php echo $step['label']; ?>
    </a>
    <?php else : ?>
    <span class="dd-breadcrumb__step">
      <?php echo $step['label']; ?>
    </span>
    <?php endif; ?>
    <?php if ($index < count($steps) - 1) : ?>
    <span class="dd-breadcrumb__separator">
      &gt;
    </span>
    <?php endif; ?>
    <?php endforeach; ?>
  </div>
  <?php
}
