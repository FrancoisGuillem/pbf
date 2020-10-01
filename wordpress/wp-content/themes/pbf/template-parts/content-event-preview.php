<?php

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pbf
 */

$metadata = get_post_meta(get_the_ID());
$geo = pbf_get_event_address($metadata);
$start = $metadata["start_date"][0] ?? "";
$end = $metadata["end_date"][0] ?? "";
$organizers = get_pbf_event_organizers($metadata);
$tags = array();
$facebook = $metadata["facebook"][0] ?? "";
// print_r($organizers);

if (empty($end)) {
  $end = $start;
}
?>
<article class="event-detail">
  <div class="event-detail-info">
    <?php
    set_query_var('evt', $metadata);
    get_template_part('template-parts/content-schedule');
    ?>
    <?php if ($facebook) { ?>
      <a href=" <?= $facebook ?>" class="event-detail-link" rel="noopener noreferrer" target="_blank"><?php get_template_part("inc/assets/facebook.svg"); ?><span><?= __("[:en]View the event on Facebook[:][:fr]Voir l'évènement sur Facebook[:]") ?></span></a>

    <?php } ?>
  </div>
  <div class="event-detail-content">
    <h2 class="event-detail-title">
      <?= the_title(); ?>
    </h2>
    <?php if (!empty($geo["address"])) { ?>
      <p class="event-detail-address"><?= $geo["address"] ?></p>
    <?php } ?>
    <?= the_content() ?>
    <footer class="event-detail-footer">
      <ul class="event-detail-organizers">
        <?php foreach ($organizers as $organizer) { ?>
          <li>
            <a class="event-detail-organizer" href="<?= $organizer["permalink"]; ?>">
              <?php if ($organizer["thumbnail"]) { ?>
                <span class="event-organizer-img">
                  <img src="<?= $organizer["thumbnail"] ?>" alt="" />
                </span>
              <?php } ?>
              <span class="event-organizer-title"><?= $organizer["title"] ?></span>
            </a>
          </li>
        <?php
          foreach ($organizer["categories"] as $tag) {
            if (!in_array($tag, $tags)) {
              $tags[] = $tag;
            }
          }
        } ?>
      </ul>
      <ul class="event-organizer-tags">
        <?php foreach ($tags as $tag) { ?>
          <li class="tag-solid variant-primary"><?= $tag; ?></li>
        <?php } ?>
      </ul>
    </footer>
  </div>
</article>
