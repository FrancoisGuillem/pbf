<?php

/**
 * template pour afficher les partcipants dans la page qui les liste tous.
 *
 * Variables
 *----------
 * $participant["id"] : ID du participant. Peut être utile pour récupérer
 *    plus d'info via l'API.
 * $participant["permalink"]: lien vers la page du partcipant
 * $participant["thumbnail"]: code html de l'image du participant
 * $participant["title"]: nom du participant
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
