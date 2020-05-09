<?php

/**
 * Template Name: Image links
 */
?>

<section class="festival-intro container">
  <h2 class="festival-title"><?php the_title(); ?></h2>
  <?php the_content();
  $metadata = get_post_meta($post->ID);
  $category = $metadata["images-category"][0] ?? "";
  if ($category) {
  ?>
    <div class="festival-links" data-bind="scroll-slider">
      <div class="festival-links-wrapper">
        <ul>
          <?php
          query_posts(array(
            'category_name'  => $category,
            'posts_per_page' => -1,
            'order' => 'ASC'
          ));
          while (have_posts()) : the_post();
            $cardMetadata = get_post_meta($post->ID);
            $link = $cardMetadata["card-link"][0] ?? "";

            if (substr($link, 0, 4) !== "http") {
              $link = get_permalink($link);
            }
          ?>
            <li>
              <a class="card" href="<?= $link ?>">
                <span class="card-image">
                  <?php the_post_thumbnail(); ?>
                </span>
                <span class="label"><?php the_title(); ?></span>
              </a>
            </li>
          <?php
          endwhile;
          ?>
        </ul>
      </div>
      <ul class="festival-index" role="presentation">
        <li class="current"></li>
        <li></li>
        <li></li>
      </ul>
    </div>
  <?php } ?>
</section>
