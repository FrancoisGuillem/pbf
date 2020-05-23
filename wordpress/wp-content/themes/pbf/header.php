<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pbf
 */

global $wp;
$current_url = home_url(add_query_arg(array(), $wp->request));
$thumbnail = get_the_post_thumbnail_url();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-input="mouse">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name='viewport' content='width=device-width, initial-scale=1, viewport-fit=cover'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/favicon.svg">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/safari-pinned-tab.svg" color="#2a2150">
  <!-- <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/favicon.ico"> -->
  <meta name="msapplication-TileColor" content="#2a2150">
  <meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
  <meta property="og:image" content="<?= $thumbnail ?: get_template_directory_uri() . '/inc/assets/social.jpg' ?>" />
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $current_url; ?>">
  <meta property="og:title" content="<?= wp_title('|', true, 'right') . bloginfo('name'); ?>">
  <meta name="description" content="<?= get_the_excerpt() ?: bloginfo('description'); ?>" />
  <meta property="og:description" content="<?= get_the_excerpt() ?: bloginfo('description'); ?>" />
  <meta name="twitter:card" content="<?= $thumbnail ? 'summary' : 'summary_large_image' ?>">
  <meta name="twitter:site" content="@ParisBeerClub">
  <meta name="author" content="Paris Beer Club">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'pbf'); ?></a>
    <?php if (!is_page_template('blank-page.php') && !is_page_template('blank-page-with-container.php')) : ?>
      <header class="site-header" role="banner">
        <div class="container">
          <a class="site-header-logo" href="<?php echo esc_url(home_url('/')); ?>">
            <?php get_template_part("inc/assets/logo.svg"); ?>
            <span><?php echo esc_attr(get_bloginfo('name')); ?></span>
          </a>
          <button class="cta-icon site-navigation-opener" type="button" aria-controls="main-navigation" aria-expanded="false" aria-label="Toggle navigation">
            <?php get_template_part("inc/assets/menu.svg"); ?>
          </button>

          <?php
          $localized_page = get_localized_url();
          $lang_switch = '<li class="lang-switch"><a href="' . $localized_page['path'] . '" hreflang="' . $localized_page['code'] . '" title="' . qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage('[:fr]View the page in English[:en]Voir la page en français[:]') . '">' . $localized_page['code'] . '</a></li>';

          wp_nav_menu(array(
            'theme_location'  => 'primary',
            'container'       => 'nav',
            'container_id'    => 'main-navigation',
            'container_class' => 'site-navigation',
            'menu_id'         => false,
            'menu_class'      => false,
            'depth'           => 3,
            'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
            'walker'          => new wp_bootstrap_navwalker(),
            'items_wrap' => '<ul>%3$s' . $lang_switch . '</ul>',
          ));

          ?>

        </div>
      </header>
      <main id="main" class="site-content" role="main">
      <?php endif; ?>