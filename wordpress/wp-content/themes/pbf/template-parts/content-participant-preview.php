<?php
/**
 * template pour afficher les partcipants dans la page qui les liste tous.
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

<div class="col-lg-3 col-md-4 participant" id="post-<?= $participant["id"]; ?>">
	<a href="<?= esc_url( $participant["permalink"]) ?>">
		<div class="thumbnail-container">
			<div class="post-thumbnail participant-thumbnail">
				<?= $participant["thumbnail"]; ?>
			</div>
		</div>
		<div class="participant-preview-title">
			<?php _e( '<h2><a href="' . esc_url( $participant["permalink"] ) . '" rel="bookmark">' . $participant["title"] . '</a></h2>' ); ?>
		</div>
	</a>
</div>
