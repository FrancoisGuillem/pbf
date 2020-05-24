<?php

/**
 * Template Name: List + text
 */
?>
<section class="list-text">
  <div class="container">
    <div class="list-text-content">
      <h2 class="list-text-title"><?= get_the_title() ?></h2>
      <?= get_the_content_pbf(); ?>
    </div>

  </div>
</section>