<?php

/**
 * Template Name: Laureates
 */

?>
<section class="laureates container">
  <h2 class="laureates-title"><?= get_the_title() ?></h2>
  <?= the_content(); ?>
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
