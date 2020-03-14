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
    "thumbnail" => get_the_post_thumbnail_url()
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
  <h1 class="page-title"><?= _e("[:fr]Participants[:en]Participants[:]") ?></h1>
</div>

<div class="container">
  <form class="category-filters">
    <legend>Categories</legend>
    <ul>
      <li><input type="checkbox" name="category" id="cat-association" value="association" checked><label for="cat-association" class="tag-solid">Association</label></li>
      <li><input type="checkbox" name="category" id="cat-bar" value="bar" checked><label for="cat-bar" class="tag-solid">Bar</label></li>
      <li><input type="checkbox" name="category" id="cat-brasserie" value="brasserie" checked><label for="cat-brasserie" class="tag-solid">Brasserie</label></li>
      <li><input type="checkbox" name="category" id="cat-cave" value="cave"><label for="cat-cave" class="tag-solid">Cave</label></li>
    </ul>
  </form>

  <?php
  /* ---------------------------------------------------------------------
  * Boucle sur les catégories de participants
  * ---------------------------------------------------------------------
  */
  foreach ($categories as $category => $participants) :
  ?>
    <section class="participant-category">
      <h2 class='participant-category-title'><?= $category; ?></h2>
      <ul>
        <?php
        /*
    * Boucle sur les participants d'une catégorie
    * Ne pas modifier les lignes ci-dessous. Modifier plutôt le Template
    * template-parts/content-participant-preview.php
    */
        foreach ($participants as $participant) { ?>
          <li>
            <?php
            // On rend disponible la variable $participant pour le template
            set_query_var('participant', $participant);
            get_template_part('template-parts/content-participant-preview');
            ?>
          </li>
        <?php
        } ?>
      </ul>
    </section>
  <?php

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
