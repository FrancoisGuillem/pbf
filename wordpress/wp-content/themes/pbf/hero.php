<?php

/**
 * Template Name: Hero
 */

$custom = get_post_custom();
$heroInfo = $custom['hero-info'][0]  ?? "";
$heroInfoLink = $custom['hero-info-link'][0]  ?? "";
$heroType = $custom['hero-type'][0]  ?? "primary";
?>
<div class="hero variant-<?= $heroType ?>">
  <div class="container">
    <div class="hero-heading">
      <h2 class="hero-title"><?= get_the_title() ?></h2>
      <p role="doc-subtitle" class="hero-subtitle"><span><?php echo get_the_content(); ?></span></p>
      <?php if ($heroInfo) {
        if ($heroInfoLink) { ?>
          <a href="<?= $heroInfoLink ?>" class="cta-solid variant-primary hero-info"><?= $heroInfo ?></a>
        <?php } else { ?>
          <p class="hero-info"><span><?= $heroInfo ?></span></p>
      <?php }
      } ?>
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
