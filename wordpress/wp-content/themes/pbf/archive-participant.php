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
    position: absolute;
    bottom: 0px;
    right: 0px;
    margin: 0 20px;
    padding: 10px;
    width: 75%;
    background-color: rgba(255, 255, 255, 0.85);
    text-align: center;
  }

  .participant .participant-preview-title a {
    color: #1c1c24;
    font-size: 24px;
  }

  .participant:hover .participant-preview-title a {
    color: #ff007a;
  }

  .category-title {
    width: 100%;
    text-align: center;
  }
</style>
<?php
if (have_posts()) : ?>

  <div class="page-header">
    <h1 class="page-title"><?= _e("[:fr]Les Participants du[:en]The Participants of the[:] Paris Beer Festival", "pbf") ?></h1>
  </div>

  <div class="container participants">
  <?php
  /* Start the Loop */
  $categories = array();

  while (have_posts()) : the_post();

    $terms = get_the_terms($post->ID, 'participant_cat');
    if (empty($terms)) {
      $category = "No Category";
    } else {
      $category = $terms[0]->name;
    }

    if (!array_key_exists($category, $categories)) {
      $categories[$category] = array();
    }

    $participant = array(
      "title" => get_the_title(),
      "id" => get_the_ID(),
      "permalink" => get_permalink(),
      "thumbnail" => get_the_post_thumbnail()
    );
    array_push($categories[$category], $participant);
  endwhile;

  foreach ($categories as $category => $participants) {
    echo "<h2 class='category-title'>" . $category . "</h2>";

    foreach ($participants as $participant) {
      set_query_var('participant', $participant);
      get_template_part('template-parts/content-participant-preview');
    }
  }
  # get_template_part( 'template-parts/content-participant-preview' );

  the_posts_navigation();

else :

  get_template_part('template-parts/content_participant-preview');

endif; ?>
  </div>

  <?php
  get_footer();
