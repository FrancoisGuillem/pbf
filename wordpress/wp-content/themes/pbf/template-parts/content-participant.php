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
		border-radius: 50%;
    -webkit-border-radius: 50%;
	}

	.participant-description h1 {
		font-size: 28px;
		text-align: center;
	}

	.event-preview h1 {
		font-size: 28px;
	}

  .event-preview-date {
		background: #ff007a;
		color: white;
		text-align:center;
		padding: 15px 0px;
	}

	.event-preview-date-container div {
		display: inline-block;
	}

	.event-preview:nth-of-type(even) .event-preview-date {
		background-color: #cc0461;
	}

	.event-preview-info {
		padding: 30px;
		border: 1px solid #e5e5e5;
		border-left: none;
		color: #5a5a5a;
	}

	.event-preview-date-container {
		width: 100%;
	}

	@media (min-width: 766px) {
		.event-preview-date {
			padding: 30px 0px;
			position: relative;
			-webkit-box-flex: 0;
			-ms-flex: 0 0 100%;
			flex: 0 0 100%;
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			text-align: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
		}

		.event-preview-date-container div {
			display: block;
		}

		.event-preview-day {
			font-size: 48px;
		}

		.event-preview-month, .event-preview-daymonth {
			font-size: 24px;
		}
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
				<div class="event-preview-date-container">

					<?php if (empty($evt["end_date"])) { // seul la date de début a été renseignée ?>

						<div class="event-preview-dow">
							<?= pbf_dow($evt["start_date"])  ?>
						</div>
						<div class="event-preview-day">
							<?= pbf_day($evt["start_date"])  ?>
						</div>
						<div class="event-preview-month">
							<?= pbf_month($evt["start_date"])  ?>
						</div>

					<?php } else { // Date de début et de fin sont renseignées ?>
						<div class="">
							<?= __("[:en]From[:][:fr]Du[:]") ?>
						</div>
						<div class="event-preview-daymonth">
							<?= pbf_day($evt["start_date"]). " " . pbf_month($evt["start_date"])  ?>
						</div>
						<div class="">
							<?= __("[:en]To[:][:fr]Au[:]") ?>
						</div>
						<div class="event-preview-daymonth">
							<?= pbf_day($evt["end_date"]) . " " . pbf_month($evt["end_date"])  ?>
						</div>
					<?php } ?>

					<div class="event-preview-time">
						<?= pbf_time($evt);  ?>
					</div>
				</div>
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
