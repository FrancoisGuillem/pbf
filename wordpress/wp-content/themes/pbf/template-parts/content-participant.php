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
 * $website : lien du site web du participant (chaine vide si non renseigné)
 *
 * Variables boucle événements
 * ---------------------------
 * $evt["title"] : titre de l'événement
 * $evt["link"] : lien de l'évènement
 * $evt["content"]: description de l'événement
 * $evt["geo"]["address"]: addresse de l'évènement
 * $evt["facebook"]: lien facebook de l'événement
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
$website = $metadata["website"][0] ?? "";

$presence = get_the_terms($post->ID, 'participant_presence');

if ($presence) {
  $presence = array_map(function ($x) {
    return $x->slug;
  }, $presence)[0];
}

$terms = get_the_terms($post->ID, 'participant_cat');
if (!empty($terms)) {
  $category = $terms[0]->name;
} else {
  $category = __("[:fr]Non Classé[:en]No Category[:]");
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

<p class="container">
  <a class="link-page" href="<?= get_post_permalink($presence === "weekend" ? "495" : "207", TRUE) ?>">
    <?php get_template_part("inc/assets/arrow-left.svg"); ?>
    <span><?= __("[:en]Participants list[:][:fr]Liste des participants[:]") ?></span>
  </a>
</p>
<div class="container">
  <?php if ($presence === "weekend") { ?>
    <div class="participant-description full-width">
      <div class="participant-header">
        <?php if ($thumbnail) { ?>
          <span class="participant-img">
            <img src="<?= $thumbnail; ?>" alt="" />
          </span>
        <?php } ?>
        <p class="participant-title"><?= $title ?></p>
        <p class="tag-solid variant-primary"><?= $category; ?></p>
        <ul class="participant-links">
          <?php
          if (!empty($facebook)) { ?>
            <li><a href="<?= $facebook ?>" rel="noopener noreferrer" target="_blank"><?php get_template_part("inc/assets/facebook.svg"); ?><span>Facebook</span></a></li>
          <?php }
          if (!empty($instagram)) { ?>
            <li><a href="<?= $instagram ?>" rel="noopener noreferrer" target="_blank"><?php get_template_part("inc/assets/instagram.svg"); ?><span>Instagram</span></a></li>
          <?php }
          if (!empty($website)) { ?>
            <li><a href="<?= $website ?>" rel="noopener noreferrer" target="_blank"><?php get_template_part("inc/assets/globe.svg"); ?><span><?= _e("[:fr]Site web[:en]Website[:]"); ?></span></a></li>
          <?php }
          ?>
        </ul>
      </div>
      <div class="content">
        <?= the_content() ?>
      </div>
    </div>
  <?php } else { ?>
    <div class="participant-description">
      <?php if ($thumbnail) { ?>
        <span class="participant-img">
          <img src="<?= $thumbnail; ?>" alt="" />
        </span>
      <?php } ?>
      <p class="participant-title"><?= $title ?></p>
      <p class="tag-solid variant-primary"><?= $category; ?></p>
      <div class="content">
        <?= the_content() ?>
      </div>
      <ul class="participant-links">
        <?php
        if (!empty($facebook)) { ?>
          <li><a href="<?= $facebook ?>" rel="noopener noreferrer" target="_blank"><?php get_template_part("inc/assets/facebook.svg"); ?><span>Facebook</span></a></li>
        <?php }
        if (!empty($instagram)) { ?>
          <li><a href="<?= $instagram ?>" rel="noopener noreferrer" target="_blank"><?php get_template_part("inc/assets/instagram.svg"); ?><span>Instagram</span></a></li>
        <?php }
        if (!empty($website)) { ?>
          <li><a href="<?= $website ?>" rel="noopener noreferrer" target="_blank"><?php get_template_part("inc/assets/globe.svg"); ?><span><?= _e("[:fr]Site web[:en]Website[:]"); ?></span></a></li>
        <?php }
        ?>
      </ul>
    </div>
    <?php if ($events) { ?>
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
              <article class="event-detail">
                <div class="event-detail-info">
                  <?php
                  set_query_var('evt', $evt["metadata"]);
                  get_template_part('template-parts/content-schedule');
                  ?>
                  <?php if ($evt["facebook"]) { ?>
                    <a href=" <?= $evt["facebook"] ?>" class="event-detail-link"><?php get_template_part("inc/assets/facebook.svg"); ?><span><?= __("[:en]View the event on Facebook[:][:fr]Voir l'évènement sur Facebook[:]") ?></span></a>

                  <?php } ?>
                </div>
                <div class="event-detail-content">
                  <h2 class="event-detail-title"><?= $evt["title"] ?></h2>
                  <?php if (!empty($evt["geo"])) { ?>
                    <p class="event-detail-address"><?= $evt["geo"]["address"] ?></p>
                  <?php } ?>
                  <?= $evt["content"] ?>
                  <footer class="event-detail-footer">
                    <ul class="event-detail-organizers">
                      <?php foreach ($evt["organizers"] as $organizer) { ?>
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
                      } ?>
                    </ul>
                  </footer>
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
    <?php } else { ?>
      <div class="participant-events">
        <div class="participant-no-events">
          <?php get_template_part("inc/assets/toast.svg"); ?>
          <p><?= _e('[:fr]Événements à venir[:en]Events to come[:]') ?></p>
        </div>
      </div>
  <?php }
  } ?>
</div>
