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
  array_push($classes, 'list-page');

  return $classes;
});

$titleLevel = 3;


get_header(); ?>

<div class="page-header">
  <h1 class="page-title"><?= get_the_title() ?></h1>
</div>
<div class="container">
  <?php
  $getchilds = array(
    'parent'        => $post->ID,
    'child_of'      => $post->ID,
    'sort_column'   => 'menu_order',
    'sort_order'    => 'ASC'
  );

  $postlist = get_pages($getchilds);

  foreach ($postlist as $post) {
    // setup post data, so page template will use it as a "master" post
    setup_postdata($post);
    $template = locate_template('template-parts/content-' . $post->post_name . '.php', false, false);

    if ($template) {
  ?>
      <h2 class="list-all-sub-title"><?= get_the_title() ?></h2>
  <?php
      include($template);
    }
  }
  ?>

</div>

<?php
get_footer();
