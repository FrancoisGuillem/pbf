<?php

/**
 * Template Name: Two columns
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}

?>
<section class="columns">
  <div class="container">
    <div class="columns-content">
      <h<?= $titleLevel; ?> class="columns-title"><?= get_the_title() ?></h<?= $titleLevel; ?>>
      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>
