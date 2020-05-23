<?php

/**
 * Template pour afficher la liste des partenaires.
 *
 * @package pbf
 */

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

  // we get page template name for the post and remove ".php" at the end to make it work
  $template = preg_replace("/\.php$/", "", get_page_template_slug($post));

  // now let WordPress fetch that page for you
  echo get_template_part($template);
}
