<?php

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pbf
 */
?>

<article class="participant" id="post-<?= $participant["id"]; ?>">
  <a href="<?= esc_url($participant["permalink"]) ?>">
    <div class="thumbnail-container">
      <div class="post-thumbnail participant-thumbnail">
        <?= $participant["thumbnail"]; ?>
      </div>
    </div>
  </a>
  <h3 class="participant-preview-title">
    <?php _e('<a href="' . esc_url($participant["permalink"]) . '" rel="bookmark">' . $participant["title"] . '</a>'); ?>
  </h3>
</article>
