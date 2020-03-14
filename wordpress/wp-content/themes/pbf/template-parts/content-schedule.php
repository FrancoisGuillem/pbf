<?php

/**
 * Template part for displaying event schedule
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pbf
 */
?>

<p class="event-preview-date">

  <?php if (empty($evt["end_date"][0])) { // seul la date de début a été renseignée
  ?>
    <time datetime="<?= $evt["start_date"][0] ?>">
      <span class="event-preview-day"><?= pbf_day($evt["start_date"][0]); ?> <?= pbf_month($evt["start_date"][0]);  ?></span>
      <?php if ('' !== pbf_time($evt)) { ?>
        <span class="event-preview-time"><?= pbf_time($evt);  ?></span>
      <?php } ?>
    </time>
  <?php } else { // Date de début et de fin sont renseignées
  ?>
    <?= __("[:en]From[:][:fr]Du[:]"); ?>
    <time class="event-preview-daymonth" datetime="<?= $evt["start_date"][0] ?>">
      <span class="event-preview-day"><?= pbf_day($evt["start_date"][0]) . " " . pbf_month($evt["start_date"][0]);  ?></span>
    </time>
    <?= __("[:en]To[:][:fr]Au[:]") ?>
    <time class="event-preview-daymonth" datetime="<?= $evt["end_date"][0] ?>">
      <span class="event-preview-day"><?= pbf_day($evt["end_date"][0]) . " " . pbf_month($evt["end_date"][0]);  ?></span>
    </time>
    <?php if ('' !== pbf_time($evt)) { ?>
      <span class="event-preview-time"><?= pbf_time($evt);  ?></span>
    <?php } ?>
  <?php } ?>

</p>
