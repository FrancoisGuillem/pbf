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

<section class="text-illus">
  <div class="container">
    <div class="text-illus-image">
      <span class="image-wrapper">

        <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/brassam/winner@0.5x.jpg" srcset="<?php echo get_template_directory_uri(); ?>/inc/assets/brassam/winner@0.33x.jpg 356w,
                <?php echo get_template_directory_uri(); ?>/inc/assets/brassam/winner@0.5x.jpg 540w,
                <?php echo get_template_directory_uri(); ?>/inc/assets/brassam/winner.jpg 1080w" sizes="(min-width: 992px) 540px, 356px" alt="" />
      </span>
    </div>

    <div class="text-illus-content">
      <h2 class="text-illus-title">Andrew, gagnant de la dernière édition</h2>

      <p>En collaboration avec la Brasserie de l'Être, Andrew, gagnant du concours de brassage amateur de la Paris Beer Week 2019 a pu brasser une Rouge des Flandes.</p>
    </div>

  </div>
</section>
<?php

get_footer(); ?>
