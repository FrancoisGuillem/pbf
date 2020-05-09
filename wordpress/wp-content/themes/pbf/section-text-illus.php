<?php

/**
 * Template Name: Text + illustration
 */
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
      <h2 class="text-illus-title"><?= get_the_title() ?></h2>
      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>
