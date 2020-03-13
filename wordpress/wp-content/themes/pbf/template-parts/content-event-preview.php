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

<article class="row event-preview" data-start="<?= $start ?>" data-end="<?= $end ?>">
  <div class="event-organizer">
    <span class="organizer-img">
      <img src="<?= $organizer["thumbnail"]; ?>" alt="" />
    </span>
    <div>
      <h3><?= $organizer["title"]; ?></h3>
      <ul>
        <?php foreach ($organizer["categories"] as $tag) { ?>
          <li class="tag"><?= $tag; ?></li>
        <?php } ?>
      </ul>

    </div>
    <div class="col-md-2 event-preview-date">
      <?php
      set_query_var('evt', $metadata);
      get_template_part('template-parts/content-schedule');
      ?>
    </div>
    <div class="col-md-10 event-preview-info">
      <h2 class="event-preview-title">
        <a href="<?= esc_url(get_permalink()) ?>">
          <?= the_title() ?>
        </a>
      </h2>
      <?= the_content() ?>
      <?php if (!empty($geo["address"])) { ?>
        <p class="event-preview-address"><?= $geo["address"] ?></p>
      <?php } ?>
    </div>
</article>
