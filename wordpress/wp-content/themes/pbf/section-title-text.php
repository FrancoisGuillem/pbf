<?php

/**
 * Template Name: Title + text
 */
?>
<section class="title-text">
  <div class="container">
    <h2 class="title-text-title"><?= get_the_title() ?></h2>
    <div class="title-text-content">
      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>
