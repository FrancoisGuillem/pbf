<?php

/**
 * Template Name: Text + map
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}

?>
<section class="text-map">
  <div class="container">
    <h<?= $titleLevel; ?> class="text-map-title"><?= get_the_title() ?></h<?= $titleLevel; ?>>
    <div class="text-map-content">
      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>
