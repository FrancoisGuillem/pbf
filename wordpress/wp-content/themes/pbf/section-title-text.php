<?php

/**
 * Template Name: Title + text
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}

?>
<section class="title-text">
  <div class="container">
    <h<?= $titleLevel; ?> class="title-text-title"><?= get_the_title() ?></h<?= $titleLevel; ?>>
    <div class="title-text-content">
      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>
