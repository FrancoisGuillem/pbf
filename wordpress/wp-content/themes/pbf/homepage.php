<?php
/*
Template Name: Homepage
*/
add_filter('body_class', function ($classes) {
  $classes['home'];
  return $classes;
});

get_header(); ?>
<div class="hero-home">
  <div class="container">
    <div class="hero-home-heading">
      <h1 class="hero-home-title">
        <span class="hero-home-logo"><?php get_template_part("inc/assets/logo.svg"); ?></span>
        <span><?php echo esc_attr(get_bloginfo('name')); ?></span>
      </h1>
      <p role="doc-subtitle" class="hero-home-subtitle">Du 25 avril au 3 mai 2020</p>
    </div>

    <div class="hero-home-image">
      <span class="image-wrapper">
        <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/hero-home/hero@0.5x.jpg" srcset="<?php echo get_template_directory_uri(); ?>/inc/assets/hero-home/hero@0.33x.jpg 607w,
                  <?php echo get_template_directory_uri(); ?>/inc/assets/hero-home/hero@0.5x.jpg 920w,
                  <?php echo get_template_directory_uri(); ?>/inc/assets/hero-home/hero.jpg 1840w" sizes="(min-width: 992px) 920px, 607px" alt="" />
      </span>
    </div>
  </div>
</div>
<section class="festival-intro container">
  <h2 class="festival-title">Le festival de la bière pour tou•te•s</h2>
  <p>Rendez-vous du 25 avril au 1er mai 2020 pour une semaine d'événements en Ile-de-France ! Et le 2 et 3 mai, direction le Ground Control, pour un week-end de clôture avec 52 brasseries presentes.</p>
  <div class="festival-links" data-bind="scroll-slider">
    <div class="festival-links-wrapper">
      <ul>
        <li>
          <a name="festival-link-1" class="card" href="/participant">
            <span class="card-image">
              <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/festival-cards/participant.jpg" alt="" />
            </span>
            <span class="label">Partenaires</span>
          </a>
        </li>
        <li>
          <a name="festival-link-2" class="card" href="/event">
            <span class="card-image">
              <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/festival-cards/event.jpg" alt="" />
            </span>
            <span class="label">Événements</span>
          </a>
        </li>
        <li>
          <a name="festival-link-3" class="card" href="/">
            <span class="card-image">
              <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/festival-cards/final.jpg" alt="" />
            </span>
            <span class="label">Grand final</span>
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

<?php

get_footer(); ?>
