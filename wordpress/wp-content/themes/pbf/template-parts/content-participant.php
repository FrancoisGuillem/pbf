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
$thumbnail = get_the_post_thumbnail_url();

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

<p class="back-link-page container">
  <a href="<?= qtranxf_get_url_for_language('/participant', qtranxf_getLanguage()) ?>">
    <?php get_template_part("inc/assets/arrow-left.svg"); ?>
    <span><?= __("[:en]Participants list[:][:fr]Liste des participants[:]") ?></span>
  </a>
</p>
<div class="container">
  <div class="participant-description">
    <span class="participant-img">
      <img src="<?= $thumbnail; ?>" alt="" />
    </span>
    <p class="participant-title"><?= $title ?></p>
    <p class="tag-solid variant-primary"><?= $category; ?></p>
    <div class="content">
      <?= the_content() ?>
    </div>
    <ul class="participant-links">
      <?php
      if (!empty($facebook)) { ?>
        <li><a href="<?= $facebook ?>"><?php get_template_part("inc/assets/facebook.svg"); ?><span>Facebook</span></a></li>
      <?php }
      if (!empty($instagram)) { ?>
        <li><a href="<?= $instagram ?>"><?php get_template_part("inc/assets/instagram.svg"); ?><span>Instagram</span></a></li>
      <?php }
      ?>
    </ul>
  </div>

  <section class="participant-events">
    <h2 class="participant-events-title"><?= __("[:en]Schedule[:][:fr]Évènements[:]") ?></h2>
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
              <p class='event-preview-address'><?= $address; ?></p>
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
  </section>

</div>
