<?php

/**
 * Template Name: Full width
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

  $getSubChilds = array(
    'parent'        => $post->ID,
    'child_of'      => $post->ID,
    'sort_column'   => 'menu_order',
    'sort_order'    => 'ASC'
  );

  $subPages = get_pages($getSubChilds);

  if (count($subPages)) {
    $template = locate_template('template-parts/content-loop.php', false, false);
  } else {
    $template = locate_template('template-parts/content-' . $post->post_name . '.php', false, false);
  }

  if ($template) {
?>
    <h2 class="list-all-sub-title"><?= get_the_title() ?></h2>
<?php
    include($template);
  } else {

    // we get page template name for the post and remove ".php" at the end to make it work
    $template = preg_replace("/\.php$/", "", get_page_template_slug($post));

    // now let WordPress fetch that page for you
    echo get_template_part($template);
  }
}

get_footer();
