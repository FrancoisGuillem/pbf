<?php
/*
Template Name: Brassam
*/
add_filter('body_class', function ($classes) {
  array_push($classes, 'brassam');

  return $classes;
});

get_header(); ?>
<div class="page-header">
  <h1 class="page-title"><?= get_the_title() ?></h1>
</div>
<div class="hero variant-secondary">
  <div class="container">
    <div class="hero-heading">
      <h2 class="hero-title">Concours de<br />brassage amateur</h2>
      <p role="doc-subtitle" class="hero-subtitle"><span>Résultats le 3 mai 2020</span></p>
      <p class="hero-info"><span>Inscriptions cloturées</span></p>
    </div>


    <div class="hero-image">
      <span class="image-wrapper scrim-light-left">
        <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/brassam/brassam@0.5x.jpg" srcset="<?php echo get_template_directory_uri(); ?>/inc/assets/brassam/brassam@0.33x.jpg 607w,
                  <?php echo get_template_directory_uri(); ?>/inc/assets/brassam/brassam@0.5x.jpg 920w,
                  <?php echo get_template_directory_uri(); ?>/inc/assets/brassam/brassam.jpg 1840w" sizes="(min-width: 992px) 920px, 607px" alt="" />
      </span>
    </div>
  </div>
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

  // we get page template name for the post and remove ".php" at the end to make it work
  $template = preg_replace("/\.php$/", "", get_page_template_slug($post));

  // now let WordPress fetch that page for you
  echo get_template_part($template);
}
?>
<?php

get_footer(); ?>
