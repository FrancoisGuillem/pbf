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
	}
</style>
<div class="row">
	<div class="col-md-4">
		<div class="participant-description">
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php the_title("<h1>", "</h1>"); ?>
			<?php echo "<div class='address'>".$metadata["address"][0]."</div>"; ?>
			<?php the_content(); ?>
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
