<?php

/**
 * Template Name: Text + illustration
 */
?>
<section class="text-illus">
  <div class="container">
    <div class="text-illus-image">
      <span class="image-wrapper">
        <?php the_post_thumbnail([356, 540, 992]); ?>
      </span>
    </div>

    <div class="text-illus-content">
      <h2 class="text-illus-title"><?= get_the_title() ?></h2>

      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>
