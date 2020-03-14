<?php

/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

add_filter('body_class', function ($classes) {
  $classes['events'];
  return $classes;
});

$dates = array(
  "2020-04-25",
  "2020-04-26",
  "2020-04-27",
  "2020-04-28",
  "2020-04-29",
  "2020-04-30",
  "2020-05-01",
  "2020-05-02",
  "2020-05-03",
);

function pbf_get_formatted_date($date, $index)
{
  $currentDate = date("Y-m-d");
  $class = $_GET['date'] === $date || (!isset($_GET['date']) && $index === 0) ? " aria-current='true'" : "";

  return "<li><a href='?date=" . $date . "'" . $class . "><time datetime='" . $date . "'>" . pbf_dow($date) . "<br/><span>" . pbf_day($date) . " " . pbf_month($date) . "</span></time></a></li>";
}

get_header(); ?>

<div class="page-header">
  <h1 class="page-title"><?= __("[:en]Schedule[:][:fr]Évènements[:]") ?></h1>
</div>
<form class="event-filters container">
  <legend>Categories</legend>
  <ul>
    <li><input type="checkbox" name="category" id="cat-association" value="association" checked><label for="cat-association" class="tag-solid">Association</label></li>
    <li><input type="checkbox" name="category" id="cat-bar" value="bar" checked><label for="cat-bar" class="tag-solid">Bar</label></li>
    <li><input type="checkbox" name="category" id="cat-brasserie" value="brasserie" checked><label for="cat-brasserie" class="tag-solid">Brasserie</label></li>
    <li><input type="checkbox" name="category" id="cat-cave" value="cave"><label for="cat-cave" class="tag-solid">Cave</label></li>
  </ul>
</form>
<ul class="dates-list">
  <?php foreach ($dates as $index => $date) {
    echo pbf_get_formatted_date($date, $index);
  } ?>
</ul>
<div class="container">
  <?php if (have_posts()) { ?>
    <ul>
      <?php
      /* Start the Loop */
      while (have_posts()) : the_post();

        /*
      * Include the Post-Format-specific template for the content.
      * If you want to override this in a child theme, then include a file
      * called content-___.php (where ___ is the Post Format name) and that will be used instead.
      */
      ?><li><?php get_template_part('template-parts/content-event-preview'); ?></li>
      <?php
      endwhile;

      the_posts_navigation();
      ?>
    </ul>
  <?php } else { ?>
    <p class="event-empty"><?= _e("[:en]No event for this date for now[:][:fr]Pas d'évènement pour cette date[:]") ?></p>
  <?php } ?>
</div>

<?php
get_footer();
