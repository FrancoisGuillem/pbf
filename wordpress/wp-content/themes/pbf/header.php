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

function getUrlInTargetLanguage($targetLang)
{
  global $qtranslate_slug;
  return $qtranslate_slug->get_permalink($targetLang);
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-input="mouse">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="profile" href="http://gmpg.org/xfn/11">
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
          $lang_switch = '<li><a href="' . $localized_page['path'] . '" hreflang="' . $localized_page['code'] . '" title="' . qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage('[:fr]View the page in English[:en]Voir la page en français[:]') . '">' . $localized_page['code'] . '</a></li>';

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
      <?php if (is_front_page() && !get_theme_mod('header_banner_visibility')) : ?>
        <div id="page-sub-header" <?php if (has_header_image()) { ?>style="background-image: url('<?php header_image(); ?>');" <?php } ?>>
          <div class="container">
            <h1>
              <?php
              if (get_theme_mod('header_banner_title_setting')) {
                echo get_theme_mod('header_banner_title_setting');
              } else {
                echo 'WordPress + Bootstrap';
              }
              ?>
            </h1>
            <p>
              <?php
              if (get_theme_mod('header_banner_tagline_setting')) {
                echo get_theme_mod('header_banner_tagline_setting');
              } else {
                echo esc_html__('To customize the contents of this header banner and other elements of your site, go to Dashboard > Appearance > Customize', 'pbf');
              }
              ?>
            </p>
            <a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>
          </div>
        </div>
      <?php endif; ?>
      <main id="main" class="site-content" role="main">
      <?php endif; ?>
