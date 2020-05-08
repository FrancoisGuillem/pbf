<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pbf
 */

add_filter('body_class', function ($classes) {
  array_push($classes, 'partners');

  return $classes;
});

$args = array(
  'post_type' => 'partner',
);

$query = new WP_Query($args);

get_header(); ?>

<div class="page-header">
  <h1 class="page-title"><?= get_the_title() ?></h1>
</div>
<div class="container">
  <?php if ($query->have_posts()) { ?>
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
</div>

<?php
get_footer();
