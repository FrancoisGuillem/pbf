<?php

/**
 * Template Name: Text + illustration
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}
$image_data = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');

$image_height = ($image_data[2] / $image_data[1] * 100) . '%';

?>
<section class="text-illus">
  <div class="container">
    <figure class="text-illus-image">
      <span class="image-wrapper" style="padding-top: <?= $image_height ?>;">
        <?php the_post_thumbnail('medium'); ?>
      </span>
      <?php
      $caption = get_the_post_thumbnail_caption();

      if ($caption) { ?>
        <figcaption><?= qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage(get_the_post_thumbnail_caption()); ?></figcaption>
      <?php }
      ?>
    </figure>

    <div class="text-illus-content">
      <h<?= $titleLevel; ?> class="text-illus-title"><?= get_the_title() ?></h<?= $titleLevel; ?>>
      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>
