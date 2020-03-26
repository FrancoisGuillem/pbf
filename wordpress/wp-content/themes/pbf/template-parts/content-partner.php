<?php

/**
 * Template pour afficher un partenaire dans la page qui liste tous les partenaires.
 *
 * Variables
 *----------
 * $title: nom du partenaire
 * $thumbnail: logo du partenaires
 * $content: description du partenaires
 *, $facebook, $instagram, $website: liens sociaux
 *
 * @package pbf
 */

$title = get_the_title();
$thumbnail = get_the_post_thumbnail_url();

$metadata = get_post_meta(get_the_ID());
$facebook = $metadata["facebook"][0] ?? "";
$instagram = $metadata["instagram"][0] ?? "";
$website = $metadata["website"][0] ?? "";

?>

<article class="partner-detail">
  <div class="partner-detail-info">
    <span class="partner-img">
      <img src="<?= $thumbnail; ?>" alt="" />
    </span>
    <h2 class="partner-detail-title">
      <?= $title; ?>
    </h2>
    <ul class="partner-links">
      <?php
      if (!empty($facebook)) { ?>
        <li><a href="<?= $facebook ?>"><?php get_template_part("inc/assets/facebook.svg"); ?><span>Facebook</span></a></li>
      <?php }
      if (!empty($instagram)) { ?>
        <li><a href="<?= $instagram ?>"><?php get_template_part("inc/assets/instagram.svg"); ?><span>Instagram</span></a></li>
      <?php }
      if (!empty($website)) { ?>
        <li><a href="<?= $website ?>"><?php get_template_part("inc/assets/globe.svg"); ?><span><?= _e("[:fr]Site web[:en]Website[:]"); ?></span></a></li>
      <?php }
      ?>
    </ul>
  </div>
  <div class="partner-detail-content">
    <?= the_content(); ?>
  </div>
</article>
