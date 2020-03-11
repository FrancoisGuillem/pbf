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

 while ( have_posts() ) : the_post();

 	$terms = get_the_terms( $post->ID , 'participant_cat' );
 	if (empty($terms)) {
 		$category = "No Category";
 	}	 else {
 		$category = $terms[0]->name;
 	}

 	if (!array_key_exists($category, $categories)) {$categories[$category] = array();}

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
	<style media="screen">
		.participant {
			position: relative;
			margin-top: 20px;
			padding: 20px;
		}

		.participant img {
			transition: all .2s ease-in-out;
		}

		.participant:hover img {
			transform: scale(1.3);
			filter: sepia(50%);
			-webkit-filter: sepia(50%);
			-moz-filter: sepia(50%);
		}

		.participant .thumbnail-container {
			overflow: hidden;
		}

		.participant .participant-thumbnail {
			margin: 0;
		}

		.participant-preview-title {
			position:absolute;
			bottom: 0px;
			right: 0px;
			margin:0 20px;
			padding: 10px;
			width: 75%;
			background-color: rgba(255, 255, 255, 0.85);
			text-align: center;
		}

		.participant .participant-preview-title a {
			color:  #1c1c24;
			font-size: 24px;
		}

		.participant:hover .participant-preview-title a {
			color: #ff007a;
		}

		.category-title {
			width: 100%;
			text-align: center;
		}
	</style>
	<section id="primary" class="content-area col-sm-12 col-lg-12">
		<main id="main" class="site-main" role="main">
			<header class="page-header">
				<h1 class="page-title"><?= _e("[:fr]Les Participants du[:en]The Participants of the[:] Paris Beer Festival", "pbf") ?></h1>
			</header><!-- .page-header -->
			<div class="row">
				<?php
				/* ---------------------------------------------------------------------
				 * Boucle sur les catégories de participants
				 * ---------------------------------------------------------------------
				 */
				foreach ($categories as $category => $participants):
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
						set_query_var( 'participant', $participant );
						get_template_part( 'template-parts/content-participant-preview' );
					}

				endforeach;
				/* ---------------------------------------------------------------------
				 * Boucle sur les catégories de participants
				 * ---------------------------------------------------------------------
				 */
				?>

				<?php the_posts_navigation(); ?>
			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
