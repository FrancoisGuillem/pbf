<?php
/**
 * Template part for displaying event schedule
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pbf
 */
?>

<div class="event-preview-date-container">

	<?php if (empty($evt["end_date"][0])) { // seul la date de début a été renseignée ?>

		<div class="event-preview-dow">
			<?= pbf_dow($evt["start_date"][0]);  ?>
		</div>
		<div class="event-preview-day">
			<?= pbf_day($evt["start_date"][0]); ?>
		</div>
		<div class="event-preview-month">
			<?= pbf_month($evt["start_date"][0]);  ?>
		</div>

	<?php } else { // Date de début et de fin sont renseignées ?>
		<div class="">
			<?= __("[:en]From[:][:fr]Du[:]"); ?>
		</div>
		<div class="event-preview-daymonth">
			<?= pbf_day($evt["start_date"][0]). " " . pbf_month($evt["start_date"][0]);  ?>
		</div>
		<div class="">
			<?= __("[:en]To[:][:fr]Au[:]") ?>
		</div>
		<div class="event-preview-daymonth">
			<?= pbf_day($evt["end_date"][0]) . " " . pbf_month($evt["end_date"][0]);  ?>
		</div>
	<?php } ?>

	<div class="event-preview-time">
		<?= pbf_time($evt);  ?>
	</div>
</div>
