<?php
/*
Template Name: Homepage
*/

$subtitle = "[:fr]" . get_theme_mod("pbf_subtitle") . "[:en]" . get_theme_mod("pbf_subtitle_en") . "[:]";
$subtitle = __($subtitle);

get_header(); ?>
<div class="hero variant-primary">
  <div class="container">
    <div class="hero-heading logo">
      <h1 class="hero-title">
        <span class="hero-logo"><?php get_template_part("inc/assets/logo.svg"); ?></span>
        <span><?php echo esc_attr(get_bloginfo('name')); ?></span>
      </h1>
      <p role="doc-subtitle" class="hero-subtitle"><span><?= $subtitle; ?></span></p>
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
<section class="festival-intro container">
  <?php while (have_posts()) : the_post(); ?>
    <h2 class="festival-title"><?php the_title(); ?></h2>
    <?php the_content(); ?>
  <?php endwhile; ?>
  <div class="festival-links" data-bind="scroll-slider">
    <div class="festival-links-wrapper">
      <ul>
        <li>
          <a name="festival-link-2" class="card" href="/event">
            <span class="card-image">
              <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/festival-cards/event.jpg" alt="" />
            </span>
            <span class="label"><?php _e("[:fr]Événements[:en]Events[:]"); ?></span>
          </a>
        </li>
        <li>
          <a name="festival-link-1" class="card" href="/participant">
            <span class="card-image">
              <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/festival-cards/participant.jpg" alt="" />
            </span>
            <span class="label"><?php _e("[:fr]Participants[:en]Participants[:]"); ?></span>
          </a>
        </li>
        <li>
          <a name="festival-link-3" class="card" href="/">
            <span class="card-image">
              <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/festival-cards/final.jpg" alt="" />
            </span>
            <span class="label"><?php _e("[:fr]Grand Final[:en]Grand Finale[:]"); ?></span>
          </a>
        </li>
      </ul>
    </div>
    <ul class="festival-index" role="presentation">
      <li class="current"></li>
      <li></li>
      <li></li>
    </ul>
  </div>
</section>

<section class="text-illus">
  <div class="container">
    <div class="text-illus-image">
      <span class="image-wrapper">

        <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/asso/asso@0.5x.jpg" srcset="<?php echo get_template_directory_uri(); ?>/inc/assets/asso/asso@0.33x.jpg 356w,
                <?php echo get_template_directory_uri(); ?>/inc/assets/asso/asso@0.5x.jpg 540w,
                <?php echo get_template_directory_uri(); ?>/inc/assets/asso/asso.jpg 1080w" sizes="(min-width: 992px) 540px, 356px" alt="" />
      </span>
    </div>

    <div class="text-illus-content">
      <?php
      $id = url_to_postid("/association");
      $asso_desc = get_post($id);
      if ($asso_desc) {
        echo '<h2 class="text-illus-title">' . get_the_title($asso_desc) . '</h2>';
        echo apply_filters('the_content', $asso_desc->post_content);
      }
      ?>
      <p><a class="link-page" href="https://www.parisbeerclub.fr">
          <?php get_template_part("inc/assets/arrow-right.svg"); ?>
          <span><?= __("[:en]Read more[:][:fr]En savoir plus[:]") ?></span>
        </a></p>
    </div>

  </div>
</section>
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
