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

  $wp_customize->add_setting('pbf_asso_title', array(
    'default'   => 'Organisé par l’association Paris Beer Club',
    'type'       => 'theme_mod',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pbf_asso_title_control', array(
    'label' => __('Titre section asso', 'pbf'),
    'section'    => 'pbf_home_content',
    'settings'   => 'pbf_asso_title',
    'type' => 'text'
  )));

  $wp_customize->add_setting('pbf_asso_desc', array(
    'default'   => '<p>Paris Beer Club est une association loi 1901, créée en 2010 par une poignée de passionnés qui se sont donnés pour objectif de valoriser l’artisanat brassicole et de faire connaître ses déclinaisons gastronomiques et culturelles. Dès 2013, l’association a accepté de porter l’organisation de la Paris Beer Week. Nous sommes un collectif de bénévoles regroupant professionnels indépendants, particuliers mordus de craft beer et associations de passionnés. Il ne s’agit pas d’un salon professionnel, nous ne proposons donc pas de stands loués au mètre carré et ne revendiquons pas le soutien de l’industrie agro-alimentaire.</p><p>Notre but n’est pas de faire de la promotion commerciale mais de développer l’intérêt du public pour les produits brassicoles non standardisés, et de transmettre notre enthousiasme pour le partage et la convivialité qu’ils dégagent.</p>',
    'type'       => 'theme_mod'
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pbf_asso_desc_control', array(
    'label' => __('Description de l\'asso', 'pbf'),
    'description' => __( "Vous pouvez insérer du code html" ),
    'section'    => 'pbf_home_content',
    'settings'   => 'pbf_asso_desc',
    'type' => 'textarea'
  )));

  // Page d'accueil EN
  $wp_customize->add_section(
    "pbf_home_content_en",
    array(
      "title" => "Contenu anglais de la page d'accueil",
      "priority" => 10,
    )
  );

  $wp_customize->add_setting('pbf_subtitle_en', array(
    'default'   => 'from XX to XX',
    'type'       => 'theme_mod',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pbf_subtitle_control_en', array(
    'label' => __('Sous-Titre sous le logo', 'pbf'),
    'section'    => 'pbf_home_content_en',
    'settings'   => 'pbf_subtitle_en',
    'type' => 'text'
  )));

  $wp_customize->add_setting('pbf_asso_title_en', array(
    'default'   => 'Organized by the association Paris Beer Club',
    'type'       => 'theme_mod',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pbf_asso_title_control_en', array(
    'label' => __('Titre section asso', 'pbf'),
    'section'    => 'pbf_home_content_en',
    'settings'   => 'pbf_asso_title_en',
    'type' => 'text'
  )));

  $wp_customize->add_setting('pbf_asso_desc_en', array(
    'default'   => '<p>Paris Beer Club est une association loi 1901, créée en 2010 par une poignée de passionnés qui se sont donnés pour objectif de valoriser l’artisanat brassicole et de faire connaître ses déclinaisons gastronomiques et culturelles. Dès 2013, l’association a accepté de porter l’organisation de la Paris Beer Week. Nous sommes un collectif de bénévoles regroupant professionnels indépendants, particuliers mordus de craft beer et associations de passionnés. Il ne s’agit pas d’un salon professionnel, nous ne proposons donc pas de stands loués au mètre carré et ne revendiquons pas le soutien de l’industrie agro-alimentaire.</p><p>Notre but n’est pas de faire de la promotion commerciale mais de développer l’intérêt du public pour les produits brassicoles non standardisés, et de transmettre notre enthousiasme pour le partage et la convivialité qu’ils dégagent.</p>',
    'type'       => 'theme_mod'
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pbf_asso_desc_control_en', array(
    'label' => __('Description de l\'asso', 'pbf'),
    'description' => __( "Vous pouvez insérer du code html" ),
    'section'    => 'pbf_home_content_en',
    'settings'   => 'pbf_asso_desc_en',
    'type' => 'textarea'
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
