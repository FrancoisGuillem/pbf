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
$content =get_the_content();

$metadata = get_post_meta(get_the_ID());

$address = $metadata["address"][0];
$facebook = $metadata["facebook"][0];
$instagram = $metadata["instagram"][0];

$terms = get_the_terms( $post->ID , 'participant_cat' );
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


<style media="screen">
	.participant-description {
		background: #f7f7f7;
		padding: 30px;
	}

	.participant-description img {
		-ms-border-radius: 50%;
    -webkit-border-radius: 50%;
		border-radius: 50%;
	}

	.participant-description h1 {
		font-size: 28px;
		text-align: center;
		margin-bottom: 0px;
	}

	.participant-cat {
		text-align: center;
		color: #5a5a5a;
		font-size: 16px;
	}

	.custom-separator {
		text-align: center;
		margin: 20px;
	}
</style>
<div class="row">
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
						echo "<a href='".$facebook."'><i class='fab fa-facebook'></i></a>";
					}
					if (!empty($instagram)) {
						echo "<a href='".$instagram."'><i class='fab fa-instagram'></i></a>";
					}
					 ?>
			</div>
			<?php edit_post_link(); ?>
		</div>
	</div>

	<div class="col-md-8">
		<?php
		/*
		 * --------------------------------------------------------------------------
		 * Boucle des événements
		 * --------------------------------------------------------------------------
		 */
		foreach ($events as $evt) {
		?>
		<div class="row event-preview">
			<div class="col-md-2 event-preview-date">
				<?php
				set_query_var( 'evt', $evt["metadata"] );
				get_template_part( 'template-parts/content-schedule');
				?>
			</div>
			<div class="col-md-10 event-preview-info">
				<a href="<?= $evt["link"]?>">
					<h1><?= $evt["title"] ?></h1>
				</a>
				<div class="coorganisers">
					<?php // Affichage des coorganisateurs de la soirée
						$organizers = pbf_get_event_organizers($evt["metadata"]);
						$count = 0;
					  foreach ($organizers as $coorganizer) :
							if ($coorganizer["id"] != get_the_ID() && $count == 0):
								_e("[:fr]Avec[:en]With[:] ");
								$count = $count + 1;
					?>
					<a href="<?= $coorganizer["link"] ?>"><?= $coorganizer["title"] ?></a>
					<?php
							endif;
						endforeach;
					?>
				</div>
				<div class="">
					<?= $evt["content"] ?>
				</div>
				<div class="event-preview-address">
					<?= $evt["geo"]["address"] ?>
				</div>
			</div>
		</div>
	  <?php
	  }
		/* -------------------------------------------------------------------------
		 * Fin boucle des événements
     * -------------------------------------------------------------------------
		 */
		?>
	</div>

</div>
