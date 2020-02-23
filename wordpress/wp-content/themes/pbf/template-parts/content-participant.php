<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pbf
 */

$metadata = get_post_meta(get_the_ID());
$events = get_pbf_participant_events($metadata);
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
				<?php the_post_thumbnail(); ?>
			</div>
			<?php the_title("<h1>", "</h1>"); ?>
			<div class="participant-cat">
				<?php
					$terms = get_the_terms( $post->ID , 'participant_cat' );
					foreach ( $terms as $term ) {
						echo $term->name;
					}
				?>
			</div>
			<div class="custom-separator">
				<img src="<?php echo get_template_directory_uri(); ?>/inc/assets/img/funfact_wave.png">
			</div>
			<?php echo "<div class='address'>".$metadata["address"][0]."</div>"; ?>
			<?php the_content(); ?>
			<div class="social">
					<?php
					if (!empty($metadata["facebook"][0])) {
						echo "<a href='".$metadata["facebook"][0]."'><i class='fab fa-facebook'></i></a>";
					}
					if (!empty($metadata["instagram"][0])) {
						echo "<a href='".$metadata["instagram"][0]."'><i class='fab fa-instagram'></i></a>";
					}
					 ?>
			</div>
			<?php edit_post_link(); ?>
		</div>
	</div>

	<div class="col-md-8">
		<?php foreach ($events as $evt) { ?>
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
				<div class="">
					<?= $evt["content"] ?>
				</div>
				<div class="event-preview-address">
					<?= $evt["address"]["address"] ?>
				</div>
			</div>
		</div>
	  <?php } ?>
	</div>

</div>
