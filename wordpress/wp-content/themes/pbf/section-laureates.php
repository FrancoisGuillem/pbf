<?php

/**
 * Template Name: Laureates
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}

$subtitle = get_post_meta(get_the_ID(), 'sub-title', true);

?>
<section class="laureates container">
  <?php if ($subtitle) { ?>
    <header class="laureates-title">
      <h<?= $titleLevel; ?>><?= get_the_title() ?></h<?= $titleLevel; ?>>
      <p role="doc-subtitle"><?= $subtitle ?></p>
    </header>
  <?php } else { ?>
    <h<?= $titleLevel; ?> class="laureates-title"><?= get_the_title() ?></h<?= $titleLevel; ?>>
  <?php } ?>
  <?php if (!empty(get_the_content())) { ?>
    <div class="laureate-content">
      <?= get_the_content_pbf(); ?>
    </div>
  <?php } ?>
  <ul class="laureates-list">
    <?php
    query_posts(array(
      'category_name'  => 'laureate',
      'posts_per_page' => -1,
      'meta_key' => 'laureate-year',
      'orderby' => 'meta_value_num',
      'order' => 'ASC'
    ));
    while (have_posts()) : the_post();
      $year = get_post_meta(get_the_ID(), 'laureate-year', true);
    ?>

      <li class="laureate-entry">
        <div class="header">
          <span class="image-wrapper laureate-entry-image"><?php the_post_thumbnail([80, 80]); ?></span>
          <div class="title">
            <p class="laureate-entry-title"><?php the_title(); ?></p>
            <p class="laureate-entry-year"><?= $year ?></p>
          </div>
        </div class="header">
        <?= the_content(); ?>
      </li>
    <?php
    endwhile;
    ?>
  </ul>
</section>
