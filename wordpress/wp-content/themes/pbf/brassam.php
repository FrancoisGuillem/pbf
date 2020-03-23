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
<section class="festival-intro container">
  <h2 class="festival-title">Les grandes étapes</h2>
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
<?php

get_footer(); ?>
