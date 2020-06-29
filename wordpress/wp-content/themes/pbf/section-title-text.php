<?php

/**
 * Template Name: Title + text
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}

$variant = get_post_meta(get_the_ID(), 'variant', true);

if ($variant) {
  $variant = 'variant-' . $variant;
}

?>
<section class="title-text <?= $variant ?>">
  <div class=" container">
    <h<?= $titleLevel; ?> class="title-text-title"><?= get_the_title() ?></h<?= $titleLevel; ?>>
    <div class="title-text-content">
      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>
