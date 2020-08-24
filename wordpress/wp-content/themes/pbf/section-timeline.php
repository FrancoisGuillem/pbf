<?php

/**
 * Template Name: Events
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}

$subtitle = get_post_meta(get_the_ID(), 'sub-title', true);
$day = get_post_meta(get_the_ID(), 'event_day', true);

?>
<section class="timeline container">
  <?php if ($subtitle) { ?>
    <header class="timeline-title">
      <h<?= $titleLevel; ?>><?= get_the_title() ?></h<?= $titleLevel; ?>>
      <p role="doc-subtitle"><?= $subtitle ?></p>
    </header>
  <?php } else { ?>
    <h<?= $titleLevel; ?> class="timeline-title"><?= get_the_title() ?></h<?= $titleLevel; ?>>
  <?php } ?>
  <?php if (!empty(get_the_content())) { ?>
    <div class="timeline-content">
      <?= get_the_content_pbf(); ?>
    </div>
  <?php } ?>
  <ul class="timeline-list">
    <?php
    query_posts(array(
      'category_name'  => 'event',
      'posts_per_page' => -1,
      'meta_key' => 'event_time',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'event_day',
          'value' => $day,
          'compare' => '=',
          'type' => 'STRING'
        )
      )
    ));
    while (have_posts()) : the_post();
      $time = get_post_meta(get_the_ID(), 'event_time', true);
    ?>

      <li class="timeline-entry">
        <div class="header">
          <div class="title">
            <p class="timeline-entry-title"><?php the_title(); ?></p>
            <p class="timeline-entry-time"><?= $time ?></p>
          </div>
        </div class="header">
        <?= the_content(); ?>
      </li>
    <?php
    endwhile;
    ?>
  </ul>
</section>
