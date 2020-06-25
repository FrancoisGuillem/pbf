<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pbf
 */

add_filter('body_class', function ($classes) {
  $classes['events'];
  return $classes;
});

$dates = array(
  "2020-10-03",
  "2020-10-04",
  "2020-10-05",
  "2020-10-06",
  "2020-10-07",
  "2020-10-08",
  "2020-10-09",
  "2020-10-10",
  "2020-10-11",
);

function pbf_get_formatted_date($date, $index)
{
  $selected_date = pbf_get_selected_date();
  $class = $selected_date === $date ? " aria-current='true'" : "";

  return "<li><a href='?date=" . $date . "'" . $class . "><time datetime='" . $date . "'>" . pbf_dow($date) . "<br/><span>" . pbf_day($date) . " " . pbf_month($date) . "</span></time></a></li>";
}

get_header(); ?>

<div class="page-header">
  <h1 class="page-title"><?= get_the_title() ?></h1>
</div>

<?php
if (pbf_get_selected_date() >= "2020-09-03") { ?>
  <ul class="dates-list">
    <?php foreach ($dates as $index => $date) {
      echo pbf_get_formatted_date($date, $index);
    } ?>
  </ul>
<?php } ?>
<? get_template_part('template-parts/content-agenda'); ?>

<?php
get_footer();
