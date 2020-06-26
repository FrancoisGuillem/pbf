<?php

/**
 * Template Name: Image links
 */

$titleLevel = wp_cache_get('titleLevel');

if ($titleLevel === false) {
  $titleLevel = 2;
}
?>

<section class="festival-intro container">
  <h<?= $titleLevel; ?> class="festival-title"><?php the_title(); ?></h<?= $titleLevel; ?>>
  <?php the_content(); ?>
</section>
