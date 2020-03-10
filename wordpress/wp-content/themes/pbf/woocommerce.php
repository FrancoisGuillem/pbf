<?php

/**
 * The template for displaying Woocommerce Product
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

get_header(); ?>

<div class="container woocommerce">
  <?php woocommerce_content(); ?>
</div>

<?php
get_sidebar();
get_footer();
