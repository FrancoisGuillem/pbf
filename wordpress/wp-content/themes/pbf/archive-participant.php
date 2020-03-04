<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
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
	</style>
	<section id="primary" class="content-area col-sm-12 col-lg-12">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?= _e("[:fr]Les Participants du[:en]The Participants of the[:] Paris Beer Festival", "pbf") ?></h1>
			</header><!-- .page-header -->
			<div class="row">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content-participant-preview' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content_participant-preview');

			endif; ?>
			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
