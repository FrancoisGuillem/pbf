<?php

/**
 * Template Name: List + text
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}
?>
<section class="list-text">
  <div class="container">
    <div class="list-text-content">
      <h<?= $titleLevel; ?> class="list-text-title"><?= get_the_title() ?></h<?= $titleLevel; ?>>
      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>
