<?php

/**
 * Template Name: Blank without Container
 */

get_header();
?>
<div class="container">
  <?php
  while (have_posts()) : the_post();
    get_template_part('template-parts/content', 'notitle');
  endwhile; // End of the loop.
  ?>
</div>

<?php
get_footer();
