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
      <li class="brassam-step <?= get_the_tags()[0]->name ?>">
        <div>
          <p class="brassam-step-title"><?php the_title(); ?></p>
          <?= the_content(); ?>
        </div>
      </li>
    <?php
    endwhile;
    ?>
  </ol>
</section>
