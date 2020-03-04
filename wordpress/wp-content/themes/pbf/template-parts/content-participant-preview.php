<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
