<?php

/**
 * Sharing image
 * - width: 800
 * - height: 600
 */
add_image_size('dd__social_sharing_image_no_crop', 800, 600, false);

/**
 * A4:
 * - width: 210
 * - height: 280
 * https://pt.wikipedia.org/wiki/ISO_216
 *
 */
add_image_size('dd__thumbnail_a4_vertical_no_crop', 420, 560, false);
add_image_size('dd__thumbnail_a4_vertical_crop', 420, 560, array('center', 'center'));
add_image_size('dd__thumbnail_a4_horizontal_crop', 560, 420, array('center', 'center'));

/**
 * Logos - used for logo bars
 * - width: 200 (max)
 * - height: 60
 */
add_image_size('dd__logo_image_no_crop', 400, 120, false);
