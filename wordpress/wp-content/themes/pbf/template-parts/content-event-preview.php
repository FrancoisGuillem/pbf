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
$organizer = get_pbf_event_organizers($metadata);

// echo print_r($organizer);

if (empty($end)) {
  $end = $start;
}
?>

<article class="event-preview">
  <div class="event-organizer">

    <?php if ($organizer["thumbnail"]) { ?>
      <span class="event-organizer-img">
        <img src="<?= $organizer["thumbnail"]; ?>" alt="" />
      </span>
    <?php } ?>
    <div>
      <h3 class="event-organizer-title"><?= $organizer["title"]; ?></h3>
      <ul class="event-organizer-tags">
        <?php foreach ($organizer["categories"] as $tag) { ?>
          <li class="tag-solid variant-primary"><?= $tag; ?></li>
        <?php } ?>
      </ul>

    </div>
  </div>
  <div class="event-preview-details">
    <div class="event-preview-info">
      <?php
      set_query_var('evt', $metadata);
      get_template_part('template-parts/content-schedule');
      ?>
    </div>
    <div class="event-preview-content">
      <h2 class="event-preview-title">
        <a href="<?= esc_url(get_permalink()) ?>">
          <?= the_title() ?>
        </a>
      </h2>
      <?php if (!empty($geo["address"])) { ?>
        <p class="event-preview-address"><?= $geo["address"] ?></p>
      <?php } ?>
      <?= the_content() ?>
    </div>
  </div>
</article>
