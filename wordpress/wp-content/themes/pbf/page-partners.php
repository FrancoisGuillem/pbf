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

get_header(); ?>

<div class="page-header">
  <h1 class="page-title"><?= get_the_title() ?></h1>
</div>
<?php get_template_part('template-parts/content-partners'); ?>

<?php
get_footer();
