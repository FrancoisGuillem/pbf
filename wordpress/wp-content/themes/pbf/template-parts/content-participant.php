<?php

/**
 * Template de la page d'un participant.
 *
 * variables
 * ---------
 * $title : nom du participant
 * $thumbnail : code html de l'image du participant
 * $content : description du participant
 * $category : categorie du participant
 * $address : adresse du participant
 * $facebook : lien facebook (chaine vide si pas renseigné)
 * $instagram : lien instagram (chaine vide si pas renseigné)
 *
 * Variables boucle événements
 * ---------------------------
 * $evt["title"] : titre de l'événement
 * $evt["link"] : lien de l'évènement
 * $evt["content"]: description de l'événement
 * $evt["geo"]["address"]: addresse de l'évènement
 *
 * @package pbf
 */

/* ----------------------------------------------------------------------------
 * Préparation des données. Ne pas modifier.
 * ----------------------------------------------------------------------------
 *
 * On récupère tous les participants et on les organise par catégorie.
 */
$title = get_the_title();
$thumbnail = get_the_post_thumbnail();
$content = get_the_content();

$metadata = get_post_meta(get_the_ID());

$address = $metadata["address"][0];
$facebook = $metadata["facebook"][0] ?? "";
$instagram = $metadata["instagram"][0] ?? "";

$terms = get_the_terms($post->ID, 'participant_cat');
if (!empty($terms)) {
  $category = $terms[0]->name;
} else {
  $category = "";
}

$events = get_pbf_participant_events($metadata);

/* ----------------------------------------------------------------------------
 * Fin de la préparation des données
 * ----------------------------------------------------------------------------
*/
?>
<div class="page-header">
  <h1 class="page-title"><?= $title ?></h1>
</div>

<div class="container">
  <div class="col-md-4">
    <div class="participant-description">
      <div class="post-thumbnail">
        <?= $thumbnail; ?>
      </div>
      <h1><?= $title ?></h1>
      <div class="participant-cat">
        <?= $category; ?>
      </div>
      <div class="custom-separator">
        <img src="<?php echo get_template_directory_uri(); ?>/inc/assets/img/funfact_wave.png">
      </div>
      <div class='address'><?= $address; ?></div>
      <?= $content; ?>
      <div class="social">
        <?php
        if (!empty($facebook)) {
          echo "<a href='" . $facebook . "'><i class='fab fa-facebook'></i></a>";
        }
        if (!empty($instagram)) {
          echo "<a href='" . $instagram . "'><i class='fab fa-instagram'></i></a>";
        }
        ?>
      </div>
      <?php edit_post_link(); ?>
    </div>
  </div>

  <div class="col-md-8">
    <ul>
      <?php
      /*
    * --------------------------------------------------------------------------
    * Boucle des événements
    * --------------------------------------------------------------------------
    */
      foreach ($events as $evt) {
      ?><li>
          <article class="event-preview-details">
            <div class="event-preview-info">
              <?php
              set_query_var('evt', $evt["metadata"]);
              get_template_part('template-parts/content-schedule');
              ?>
            </div>
            <div class="event-preview-content">
              <h2 class="event-preview-title">
                <a href="<?= $evt["link"] ?>">
                  <?= $evt["title"] ?>
                </a>
              </h2>
              <?php if (!empty($evt["address"])) { ?>
                <p class="event-preview-address"><?= $evt["address"]["address"] ?></p>
              <?php } ?>
              <?= $evt["content"] ?>
            </div>
          </article>
        </li>
      <?php
      }
      /* -------------------------------------------------------------------------
		 * Fin boucle des événements
     * -------------------------------------------------------------------------
		 */
      ?>
    </ul>
  </div>

</div>
