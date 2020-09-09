<?php
/*
Template Name: Homepage
*/

$subtitle = "[:fr]" . get_theme_mod("pbf_subtitle") . "[:en]" . get_theme_mod("pbf_subtitle_en") . "[:]";
$subtitle = __($subtitle);
$cta = get_theme_mod("pbf_link");
$cta_text = get_theme_mod("pbf_link_text");

get_header(); ?>
<div class="hero variant-primary">
  <div class="container">
    <div class="hero-heading logo">
      <h1 class="hero-title">
        <span class="hero-logo"><?php get_template_part("inc/assets/logo.svg"); ?></span>
        <span><?php echo esc_attr(get_bloginfo('name')); ?></span>
      </h1>
      <p role="doc-subtitle" class="hero-subtitle"><span><?= $subtitle; ?></span></p>
      <?php if (!empty($cta) && !empty($cta_text)) { ?>
        <a href="<?= $cta ?>" target="_blank" rel="noopener noreferrer" class="cta-solid variant-primary hero-info"><?= $cta_text ?></a>
      <?php } ?>
    </div>

    <div class="hero-image">
      <span class="image-wrapper">
        <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/hero-home/hero@0.5x.jpg" srcset="<?php echo get_template_directory_uri(); ?>/inc/assets/hero-home/hero@0.33x.jpg 607w,
                  <?php echo get_template_directory_uri(); ?>/inc/assets/hero-home/hero@0.5x.jpg 920w,
                  <?php echo get_template_directory_uri(); ?>/inc/assets/hero-home/hero.jpg 1840w" sizes="(min-width: 992px) 920px, 607px" alt="" />
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

<section class="sponsors">
  <div class="container">
    <h2 class="sponsors-title"><?php _e("[:fr]Partenaires[:en]Partners[:]"); ?></h2>
    <ul>
      <?php
      query_posts(array(
        'post_type' => 'partner',
        'showposts' => 100
      ));
      $current_level = 1;

      while (have_posts()) : the_post();
        $level = get_post_meta(get_the_ID())["partner_level"][0];
        if ($level > $current_level) {
          $current_level = $level;
          echo '</ul><ul>';
        }
      ?>
        <li><a href="/partner#<?php echo $post->post_name; ?>" class="sponsor-level-<?= $level ?>"><?php the_post_thumbnail([210, 420]); ?><span><?php the_title(); ?></span></a></li>

      <?php
      endwhile;
      ?>
    </ul>
  </div>
</section>

<?php

get_footer(); ?>
