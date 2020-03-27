<?php

/**
 * Template Name: Brassam Steps
 */

?>
<section class="brassam-steps container">
  <h2 class="brassam-steps-title"><?= get_the_title() ?></h2>
  <?= the_content(); ?>
  <ol>
    <?php
    query_posts(array(
      'category_name'  => 'brassam',
      'posts_per_page' => -1,
      'order' => 'ASC'
    ));
    while (have_posts()) : the_post(); ?>
      <li class="brassam-step">
        <span class="image-wrapper"><?php the_post_thumbnail([256, 400]); ?></span>
        <p class="brassam-step-title"><?php the_title(); ?></p>
        <?= the_content(); ?>
      </li>
    <?php
    endwhile;
    ?>
  </ol>
</section>
