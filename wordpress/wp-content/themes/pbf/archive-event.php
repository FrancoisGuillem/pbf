<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

function pbf_get_formatted_date($date, $class = "") {
	return "<div id='filter-". $date ."' class='" . $class . "' onclick='select_date(\"". $date ."\")'>" . pbf_dow($date) . "<h3>" . pbf_day($date) . " " . pbf_month($date) . "</h3></div>";
}

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-12">
		<main id="main" class="site-main" role="main">
			<style media="screen">
			  h1 {
					text-align: center;
				}

				.date-selector {
					margin-bottom: 60px;
				}

				.date-selector > div {
					border: solid 4px white;
					height: 100px;
					background-color: #f1f0f6;
					color: #1c1c24;
					text-align: center;
					font-size: 16px;
					padding: 15px 0 0 0;
					cursor: pointer;
				}

				.date-selector  .selected {
					background-color: #ff007a;
					color: #fff;
				}

				.date-selector  .selected h3 {
					color: #fff;
				}

				.date-selector > div:hover {
					border-color: #1c1c24;
				}

				.date-selector > div  h3 {
					color: #1c1c24;
					font-size:24px;
					margin-top:6px;
				}

				#nav-grand-finale {
					background-color: #ffc509 !important;
					font-size: 18px;
					font-weight: bold;
					padding: 7px 0 0 0;
				}

				#nav-grand-finale > div > div {
					border-right: solid 1px white;
					font-size: 16px;
					font-weight: normal;
				}

				#nav-grand-finale h3 {
					font-size: 16px;
					margin-top: 0px;
				}

				.small-date-btn {
					height: 58px;
				}
			</style>
			<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
			<script type="text/javascript">
			<?php
			if (isset($_GET["date"])) {
				echo "var today = '" . $_GET["date"] . "'";
			}  else {
				echo "var today = new Date();";
				echo "today = today.toISOString().split('T')[0];";
			}
			?>

			$( document ).ready(function() {
				if (today < "2020-04-25") {today = "2020-04-25";}
				$("#filter-" + today).addClass("selected");
			});

			function select_date(date) {
				current_url = window.location.href;
				if (current_url.indexOf("?") > -1) {
					current_url = current_url.substring(0, current_url.indexOf("?"));
				}
				new_url = current_url + "?date=" + date;
				window.location.href = new_url;
			}
			</script>
			<header class="page-header">
				'<h1 class="page-title"><?= __("[:en]Schedule[:][:fr]Le Programme[:]") ?></h1>'
			</header><!-- .page-header -->
			<div class="row date-selector">
				<?= pbf_get_formatted_date("2020-04-25", "col-4 col-md-2 no-gutters offset-md-1")?>
				<?= pbf_get_formatted_date("2020-04-26", "col-4 col-md-2 no-gutters")?>
				<?= pbf_get_formatted_date("2020-04-27", "col-4 col-md-2 no-gutters")?>
				<?= pbf_get_formatted_date("2020-04-28", "col-4 col-md-2 no-gutters")?>
				<?= pbf_get_formatted_date("2020-04-29", "col-4 col-md-2 offset-md-0 no-gutters")?>
				<?= pbf_get_formatted_date("2020-04-30", "col-4 col-md-2 no-gutters offset-md-2")?>
				<?= pbf_get_formatted_date("2020-05-01", "col-4 col-md-2 no-gutters")?>
				<div class="col-8 col-md-4 np-gutters" id="nav-grand-finale">
					GROUND CONTROL
					<div class="row no-gutters">
							<?= pbf_get_formatted_date("2020-05-02", "col-6 no-gutters small-date-btn")?>
							<?= pbf_get_formatted_date("2020-05-03", "col-6 no-gutters small-date-btn")?>
					</div>
				</div>
			</div>
			<?php if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-event-preview');

			endwhile;

			the_posts_navigation();

		else :
			_e("[:en]No event for this date for now[:][:fr]Pas d'évènement pour cette date[:]");

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
