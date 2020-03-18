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
    $category = array(
			"name" => _e("[:fr]Non Classé[:en]No Category[:]"),
			"slug" => "no-category"
		);
  } else {
    $category = array(
      "name" => $terms[0]->name,
      "slug" => $terms[0]->slug,
    );
  }

  if (!array_key_exists($category["slug"], $categories)) {
    $categories[$category["slug"]] = $category;
    $categories[$category["slug"]]["participants"] = array();
  }

  $participant = array(
    "title" => get_the_title(),
    "id" => get_the_ID(),
    "permalink" => get_permalink(),
    "thumbnail" => get_the_post_thumbnail_url()
  );
  array_push($categories[$category["slug"]]["participants"], $participant);
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
  <form class="category-filters" data-controls="categories-listing">
    <legend>Categories</legend>
    <ul>
      <?php foreach ($categories as $category) { ?>
        <li><input type="checkbox" name="category" id="cat-<?= $category["slug"]; ?>" value="<?= $category["slug"]; ?>" checked><label for="cat-<?= $category["slug"]; ?>" class="tag-solid"><?= $category["name"]; ?></label></li>
      <?php } ?>
    </ul>
  </form>
  <div id="categories-listing">
    <?php
    /* ---------------------------------------------------------------------
  * Boucle sur les catégories de participants
  * ---------------------------------------------------------------------
  */
    foreach ($categories as $category) :
    ?>
      <section class="participant-category" data-category="<?= $category["slug"]; ?>">
        <h2 class='participant-category-title'><?= $category["name"]; ?></h2>
        <ul>
          <?php
          /*
    * Boucle sur les participants d'une catégorie
    * Ne pas modifier les lignes ci-dessous. Modifier plutôt le Template
    * template-parts/content-participant-preview.php
    */
          foreach ($category["participants"] as $participant) { ?>
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
  </div>
  <?php
  //the_posts_navigation();
  ?>
</div>

<?php
get_footer();
