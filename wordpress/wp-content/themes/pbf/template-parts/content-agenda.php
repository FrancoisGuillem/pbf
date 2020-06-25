<?php

/**
 * Template pour afficher la liste des partenaires.
 *
 * @package pbf
 */

$args = array(
  'post_type' => 'event',
  'filter' => 'date',
);

$query = new WP_Query($args);

if ($query->have_posts()) { ?>
  <div class="container">
    <ul>
      <?php
      /* Start the Loop */
      while ($query->have_posts()) : $query->the_post();

        /*
    * Include the Post-Format-specific template for the content.
    * If you want to override this in a child theme, then include a file
    * called content-___.php (where ___ is the Post Format name) and that will be used instead.
    */
      ?><li><?php get_template_part('template-parts/content-event-preview'); ?></li>
      <?php
      endwhile;

      the_posts_navigation();
      ?>
    </ul>
  </div>
<?php } else { ?>
  <div class="events-empty">
    <?php get_template_part("inc/assets/toast.svg"); ?>
    <?= get_the_content_pbf(); ?>
  </div>
<?php }
