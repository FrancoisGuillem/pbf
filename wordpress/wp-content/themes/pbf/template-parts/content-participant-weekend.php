<?php

/**
 * template pour afficher les participants au weekend de cloture
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
    <div class="participant-title-wrapper">
      <h3 class="participant-title">
        <?= $participant["title"] ?>
      </h3>
    </div>
  </a>
</article>
