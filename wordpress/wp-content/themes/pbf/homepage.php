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

<section class="association">
  <div class="container">
    <div class="association-image">
      <span class="image-wrapper">

        <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/asso/asso@0.5x.jpg" srcset="<?php echo get_template_directory_uri(); ?>/inc/assets/asso/asso@0.33x.jpg 356w,
                <?php echo get_template_directory_uri(); ?>/inc/assets/asso/asso@0.5x.jpg 540w,
                <?php echo get_template_directory_uri(); ?>/inc/assets/asso/asso.jpg 1080w" sizes="(min-width: 992px) 540px, 356px" alt="" />
      </span>
    </div>

    <div class="association-content">
      <h2 class="association-title">Organisé par l’association Paris Beer Club</h2>

      <p>Paris Beer Club est une association loi 1901, créée en 2010 par une poignée de passionnés qui se sont donnés pour objectif de valoriser l’artisanat brassicole et de faire connaître ses déclinaisons gastronomiques et culturelles. Dès 2013, l’association a accepté de porter l’organisation de la Paris Beer Week. Nous sommes un collectif de bénévoles regroupant professionnels indépendants, particuliers mordus de craft beer et associations de passionnés. Il ne s’agit pas d’un salon professionnel, nous ne proposons donc pas de stands loués au mètre carré et ne revendiquons pas le soutien de l’industrie agro-alimentaire.</p>

      <p>Notre but n’est pas de faire de la promotion commerciale mais de développer l’intérêt du public pour les produits brassicoles non standardisés, et de transmettre notre enthousiasme pour le partage et la convivialité qu’ils dégagent.</p>

      <a class="link-page" href="https://www.parisbeerclub.fr">
        <?php get_template_part("inc/assets/arrow-right.svg"); ?>
        <span><?= __("[:en]Read more[:][:fr]En savoir plus[:]") ?></span>
      </a>
    </div>

  </div>
</section>
<section class="sponsors">
  <div class="container">
    <h2 class="sponsors-title"><?php _e("[:fr]Partenaires[:en]Partners[:]"); ?></h2>
    <ul>
      <li><a href="https://www.groundcontrolparis.com/" class="sponsor-groundcontrol"><img src="<?php echo get_template_directory_uri(); ?>/inc/assets/sponsors/ground-control.png" width="247" height="98" alt="" /><span>Ground Control</span></a></li>
      <li><a href="https://fermentis.com/" class="sponsor-fermentis"><img src="<?php echo get_template_directory_uri(); ?>/inc/assets/sponsors/fermentis.png" width="240" height="187" alt="" /><span>Fermentis</span></a></li>
      <li><a href="https://grainfather.com/" class="sponsor-grainfather"><img src="<?php echo get_template_directory_uri(); ?>/inc/assets/sponsors/the-grainfather.png" width="232" height="103" alt="" /><span>The Graindfather</span></a></li>
      <li><a href="http://www.dbi-biere.com/" class="sponsor-dbi"><img src="<?php echo get_template_directory_uri(); ?>/inc/assets/sponsors/dbi.png" width="150" height="146" alt="" /><span>DBI</span></a></li>
    </ul>
  </div>
</section>

<?php

get_footer(); ?>
