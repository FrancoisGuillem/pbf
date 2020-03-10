<?php

/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

// $date = date( "Y-m-d" );

function pbf_get_formatted_date($date, $class = "")
{
  $class = $_GET['date'] === $date ? " class='selected'" : "";

  return "<li" . $class . "><a href='?date=" . $date . "'>" . pbf_dow($date) . "<span>" . pbf_day($date) . " " . pbf_month($date) . "</span></a></li>";
}

get_header(); ?>

<div class="page-header">
  <h1 class="page-title"><?= __("[:en]Schedule[:][:fr]Le Programme[:]") ?></h1>
</div>
<div class="container events">
  <ul class="date-selector">
    <?= pbf_get_formatted_date("2020-04-25") ?>
    <?= pbf_get_formatted_date("2020-04-26") ?>
    <?= pbf_get_formatted_date("2020-04-27") ?>
    <?= pbf_get_formatted_date("2020-04-28") ?>
    <?= pbf_get_formatted_date("2020-04-29") ?>
    <?= pbf_get_formatted_date("2020-04-30") ?>
    <?= pbf_get_formatted_date("2020-05-01") ?>
    <li class="date-selector-final">
      <div>
        <p>Ground Control</p>
        <ul>
          <?= pbf_get_formatted_date("2020-05-02") ?>
          <?= pbf_get_formatted_date("2020-05-03") ?>
        </ul>
      </div>
    </li>
  </ul>
  <?php if (have_posts()) : ?>
  <?php
    /* Start the Loop */
    while (have_posts()) : the_post();

      /*
      * Include the Post-Format-specific template for the content.
      * If you want to override this in a child theme, then include a file
      * called content-___.php (where ___ is the Post Format name) and that will be used instead.
      */
      get_template_part('template-parts/content-event-preview');

    endwhile;

    the_posts_navigation();

  else :
    _e("[:en]No event for this date for now[:][:fr]Pas d'évènement pour cette date[:]");

  endif; ?>
</div>

<?php
get_footer();
