<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pbf
 */

//$metadata = get_post_meta(get_the_ID());
//$events = $metadata["events"][0];
?>

<div class="col-lg-3 col-md-4 participant" id="post-<?php the_ID(); ?>">
	<a href="<?= esc_url( get_permalink() ) ?>">
		<div class="thumbnail-container">
			<div class="post-thumbnail participant-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
		<div class="participant-preview-title">
			<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</div>
	</a>
</div>
