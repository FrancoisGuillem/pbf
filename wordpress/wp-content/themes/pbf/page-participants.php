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
/* ----------------------------------------------------------------------------
    * Fin de la préparation des données
    * ----------------------------------------------------------------------------
   */
get_header(); ?>

<div class="page-header">
  <h1 class="page-title"><?= get_the_title() ?></h1>
</div>

<? get_template_part('template-parts/content-participants'); ?>

<?php
get_footer();
