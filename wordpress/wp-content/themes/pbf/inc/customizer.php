<?php

/**
 * WP Bootstrap Starter Theme Customizer
 *
 * @package pbf
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themeslug_sanitize_checkbox($checked)
{
  // Boolean check.
  return ((isset($checked) && true == $checked) ? true : false);
}

function wp_bootstrap_starter_customize_register($wp_customize)
{
  // Paris Beer Festival Specific

  // Page d'accueil FR
  $wp_customize->add_section(
    "pbf_home_content",
    array(
      "title" => "Contenu de la page d'accueil",
      "priority" => 10,
    )
  );

  $wp_customize->add_setting('pbf_subtitle', array(
    'default'   => 'du XX au XX',
    'type'       => 'theme_mod',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pbf_subtitle_control', array(
    'label' => __('Sous-Titre sous le logo', 'pbf'),
    'section'    => 'pbf_home_content',
    'settings'   => 'pbf_subtitle',
    'type' => 'text'
  )));

  $wp_customize->add_setting('pbf_subtitle_en', array(
    'default'   => 'from XX to XX',
    'type'       => 'theme_mod',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pbf_subtitle_control_en', array(
    'label' => __('Sous-Titre anglais', 'pbf'),
    'section'    => 'pbf_home_content',
    'settings'   => 'pbf_subtitle_en',
    'type' => 'text'
  )));

  $wp_customize->add_setting('pbf_link_text', array(
    'default'   => '',
    'type'       => 'theme_mod',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pbf_link_text_control', array(
    'label' => __('Titre du lien sous le logo', 'pbf'),
    'section'    => 'pbf_home_content',
    'settings'   => 'pbf_link_text',
    'type' => 'text'
  )));

  $wp_customize->add_setting('pbf_link', array(
    'default'   => '',
    'type'       => 'theme_mod',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pbf_link_control', array(
    'label' => __('Lien sous le logo', 'pbf'),
    'section'    => 'pbf_home_content',
    'settings'   => 'pbf_link',
    'type' => 'text'
  )));
}
add_action('customize_register', 'wp_bootstrap_starter_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_bootstrap_starter_customize_preview_js()
{
  wp_enqueue_script('wp_bootstrap_starter_customizer', get_template_directory_uri() . '/inc/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'wp_bootstrap_starter_customize_preview_js');
