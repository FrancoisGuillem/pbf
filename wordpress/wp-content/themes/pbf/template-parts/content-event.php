<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pbf
 */

$metadata = get_post_meta(get_the_ID());
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php wp_bootstrap_starter_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<div class="row">
		  <div class="col-md-4">
				<div class="post-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
		  </div>
			<div class="col-md-8">
				<?php
						if ( is_single() ) :
							  // COntenu affiché sur la page de l'évènement
				 				the_content();
								echo '<div>'. __("Adresse:", "pbf") .'</div>';
								echo "<div class='address'>". pbf_get_event_address($metadata) ."</div>";
								echo '<div>'. __("Dates et horaires:", "pbf") .'</div>';
								pbf_event_schedule($metadata);
						else :
							 // Contenu affiché dans la liste des évènements
								the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pbf' ) );
								echo "<div class='address'>". pbf_get_event_address($metadata) ."</div>";
								pbf_event_schedule($metadata);
						endif;

				 wp_link_pages( array(
					 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pbf' ),
					 'after'  => '</div>',
				 ) );
			 ?>
			</div>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wp_bootstrap_starter_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
