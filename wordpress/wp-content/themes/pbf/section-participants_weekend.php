<?php
/**
 * Template Name: Participants Weekend
 */


 /* Récupération des participants présents pendant le weekend de cloture.
    Les participants sont rangés par catégorie, comme sur la page archive-participant.php
 */
$categories = array();

$the_query = new WP_Query( array(
    'post_type' => 'participant',
    'tax_query' => array(
        array (
            'taxonomy' => 'participant_presence',
            'field' => 'slug',
            'terms' => 'weekend',
        )
    ),
) );

while ( $the_query->have_posts() ) :
    $the_query->the_post();

    $terms = get_the_terms($post->ID, 'participant_cat');
    if (empty($terms)) {
      $category = array(
  			"name" => __("[:fr]Non Classé[:en]No Category[:]"),
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
      "thumbnail" => get_the_post_thumbnail_url(null, "medium")
    );
    array_push($categories[$category["slug"]]["participants"], $participant);
endwhile;

/* Restore original Post Data */
wp_reset_postdata();
 ?>

<h1>Ils seront là au Ground Control</h1>

<?php
/* -----------------------------------------------------------------------------
 * Boucle sur les catégories de participants
 * -----------------------------------------------------------------------------
 */
foreach ($categories as $category) :
 ?>

<section class="participant-category" data-category="<?= $category["slug"]; ?>">
  <h2 class='participant-category-title'><?= $category["name"]; ?></h2>
  <ul>

  <?php
  /* ---------------------------------------------------------------------------
   * Boucle sur les participants
   * ---------------------------------------------------------------------------
   */
  foreach ($category["participants"] as $participant) :
   ?>

  <li>
    <?php
     // On rend disponible la variable $participant pour le template
     set_query_var('participant', $participant);
     get_template_part('template-parts/content-participant-weekend');
     ?>
  </li>

  <?php endforeach; // Fin boucle participants?>

  </ul>
</section>

<?php endforeach; // Fin boucle catégories?>
