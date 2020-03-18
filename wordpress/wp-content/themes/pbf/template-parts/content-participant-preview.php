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
    <?php if ($participant["thumbnail"]) { ?>
      <span class="participant-img">
        <img src="<?= $participant["thumbnail"] ?>" alt="" />
      </span>
    <?php } ?>
    <h3 class="participant-title">
      <?= $participant["title"] ?>
    </h3>
  </a>
</article>
