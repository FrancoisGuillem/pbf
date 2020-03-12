<?php

/**
 * Template pour afficher la liste des participants.
 * Ce fichier gère seulement la structure de la page et le titre des catégories.
 * Pour modifier l'affichage des partcipants, vous pouvez éditer le fichier
 * 'template_parts/content-participant-preview.php'
 *
 * Variables
 *----------
 * $category titre de la catégorie. Disponible uniquement dans la boucle des
 * catégories
 *
 * @package pbf
 */

/* ----------------------------------------------------------------------------
  * Préparation des données. Ne pas modifier.
  * ----------------------------------------------------------------------------
  *
	* On récupère tous les participants et on les organise par catégorie.
	*/
$categories = array();

while (have_posts()) : the_post();

  $terms = get_the_terms($post->ID, 'participant_cat');
  if (empty($terms)) {
    $category = "No Category";
  } else {
    $category = $terms[0]->name;
  }

  if (!array_key_exists($category, $categories)) {
    $categories[$category] = array();
  }

  $participant = array(
    "title" => get_the_title(),
    "id" => get_the_ID(),
    "permalink" => get_permalink(),
    "thumbnail" => get_the_post_thumbnail()
  );
  array_push($categories[$category], $participant);
endwhile;

/* ----------------------------------------------------------------------------
	* Fin de la préparation des données
	* ----------------------------------------------------------------------------
 */
?>

<?php get_header(); ?>

<div class="page-header">
  <h1 class="page-title"><?= _e("[:fr]Les Participants du[:en]The Participants of the[:] Paris Beer Festival", "pbf") ?></h1>
</div>

<div class="container participants">
  <?php
  /* ---------------------------------------------------------------------
  * Boucle sur les catégories de participants
  * ---------------------------------------------------------------------
  */
  foreach ($categories as $category => $participants) :
  ?>
    <h2 class='category-title'><?= $category; ?></h2>
  <?php
    /*
    * Boucle sur les participants d'une catégorie
    * Ne pas modifier les lignes ci-dessous. Modifier plutôt le Template
    * template-parts/content-participant-preview.php
    */
    foreach ($participants as $participant) {
      // On rend disponible la variable $participant pour le template
      set_query_var('participant', $participant);
      get_template_part('template-parts/content-participant-preview');
    }

  endforeach;
  /* ---------------------------------------------------------------------
  * Boucle sur les catégories de participants
  * ---------------------------------------------------------------------
  */
  ?>

  <?php the_posts_navigation(); ?>
</div>

<?php
get_footer();
