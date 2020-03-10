<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
<div class="container error-404 not-found">
  <div class="page-header">
    <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'pbf'); ?></h1>
  </div>

  <div class="page-content">
    <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'pbf'); ?></p>

    <?php
    // get_search_form();

    ?>

  </div>
</div>

<?php
get_footer(); ?>
