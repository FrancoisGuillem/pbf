<?php

/**
 * Template Name: Text + illustration
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}
?>
<section class="text-illus">
  <div class="container">
    <figure class="text-illus-image">
      <span class="image-wrapper">
        <?php the_post_thumbnail([356, 540, 992]); ?>
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
