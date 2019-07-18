<?php

function dd_component__page_section($section, $section_contents) {
  $conditional_classes = array(
    'section-with-bg' => $section['background_color'],
    'bg-' . $section['background_color'] => $section['background_color'],
    'section-transparent' => !$section['background_color'],
  );

  ?>
  <section class="<?php echo dd__helper_classes($section['classes'], $conditional_classes); ?>">
    <div class="website-side-padding website-max-width">
    <?php
    $section_contents();
    ?>
    </div>
  </section>
  <?php
}
