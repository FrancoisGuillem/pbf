<?php

/**
 * Fichier template qui gère l'affichage de la liste des partenaires
 *
 * @package pbf
 */

add_filter('body_class', function ($classes) {
  array_push($classes, 'partners');

  return $classes;
});


get_header(); ?>

<div class="page-header">
  <h1 class="page-title"><?= __("[:en]The Parners of the[:fr]Les partenaires du[:] Paris Beer Festival") ?></h1>
</div>
<div class="container">
  <?php if (have_posts()) { ?>
    <ul>
      <?php
      /* ---------------------------------------------------------------------
       * Boucle sur les partenaires
       * ---------------------------------------------------------------------
       */
      while (have_posts()) : the_post();
      ?>
        <li><?php get_template_part('template-parts/content-partner'); ?></li>
      <?php
      endwhile;

      // the_posts_navigation();
      ?>
    </ul>
  <?php } ?>
</div>

<?php
get_footer();
