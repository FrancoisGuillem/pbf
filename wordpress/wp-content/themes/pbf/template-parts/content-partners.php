<?php

/**
 * Template pour afficher la liste des partenaires.
 *
 * @package pbf
 */

$args = array(
  'post_type' => 'partner',
);

$query = new WP_Query($args);

if ($query->have_posts()) { ?>
  <ul>
    <?php
    /* ---------------------------------------------------------------------
     * Boucle sur les partenaires
     * ---------------------------------------------------------------------
     */
    while ($query->have_posts()) : $query->the_post();
    ?>
      <li><?php get_template_part('template-parts/content-partner'); ?></li>
    <?php
    endwhile;

    // the_posts_navigation();
    ?>
  </ul>
<?php } ?>
