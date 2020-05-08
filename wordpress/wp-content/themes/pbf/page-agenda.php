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

$args = array(
  'post_type' => 'event',
  'filter' => 'date',
);

$query = new WP_Query($args);

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
<div class="container">
  <?php
  if ($query->have_posts()) { ?>
    <ul>
      <?php
      /* Start the Loop */
      while ($query->have_posts()) : $query->the_post();

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
  <?php } else {
    the_post(); ?>
    <div class="events-empty">
      <?php get_template_part("inc/assets/toast.svg"); ?>
      <?= the_content(); ?>
    </div>
  <?php } ?>
</div>

<?php
get_footer();
