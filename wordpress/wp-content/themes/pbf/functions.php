<?php

/**
 * WP Bootstrap Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pbf
 */

if (!function_exists('wp_bootstrap_starter_setup')) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function wp_bootstrap_starter_setup()
  {
    /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WP Bootstrap Starter, use a find and replace
	 * to change 'pbf' to the name of your theme in all the template files.
	 */
    load_theme_textdomain('pbf', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    // add_theme_support('automatic-feed-links');

    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support('title-tag');

    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
      'primary' => esc_html__('Primary', 'pbf'),
      'reseaux-sociaux' => esc_html__('Réseaux Sociaux', 'pbf'),
      'footer-menu' => esc_html__('Footer', 'pbf'),
    ));

    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
    add_theme_support('html5', array(
      'comment-form',
      'comment-list',
      'caption',
    ));

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('wp_bootstrap_starter_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    )));

    // add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    function wp_boostrap_starter_add_editor_styles()
    {
      add_editor_style('custom-editor-style.css');
    }
    add_action('admin_init', 'wp_boostrap_starter_add_editor_styles');
  }
endif;
add_action('after_setup_theme', 'wp_bootstrap_starter_setup');


/**
 * Add Welcome message to dashboard
 */
function wp_bootstrap_starter_reminder()
{
  $theme_page_url = 'https://afterimagedesigns.com/wp-bootstrap-starter/?dashboard=1';

  if (!get_option('triggered_welcomet')) {
    $message = sprintf(
      __('Welcome to WP Bootstrap Starter Theme! Before diving in to your new theme, please visit the <a style="color: #fff; font-weight: bold;" href="%1$s" target="_blank">theme\'s</a> page for access to dozens of tips and in-depth tutorials.', 'pbf'),
      esc_url($theme_page_url)
    );

    printf(
      '<div class="notice is-dismissible" style="background-color: #6C2EB9; color: #fff; border-left: none;">
                        <p>%1$s</p>
                    </div>',
      $message
    );
    add_option('triggered_welcomet', '1', '', 'yes');
  }
}
add_action('admin_notices', 'wp_bootstrap_starter_reminder');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_bootstrap_starter_content_width()
{
  $GLOBALS['content_width'] = apply_filters('wp_bootstrap_starter_content_width', 1170);
}
add_action('after_setup_theme', 'wp_bootstrap_starter_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_starter_widgets_init()
{
  register_sidebar(array(
    'name'          => esc_html__('Sidebar', 'pbf'),
    'id'            => 'sidebar-1',
    'description'   => esc_html__('Add widgets here.', 'pbf'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));
  register_sidebar(array(
    'name'          => esc_html__('Footer 1', 'pbf'),
    'id'            => 'footer-1',
    'description'   => esc_html__('Add widgets here.', 'pbf'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));
  register_sidebar(array(
    'name'          => esc_html__('Footer 2', 'pbf'),
    'id'            => 'footer-2',
    'description'   => esc_html__('Add widgets here.', 'pbf'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));
  register_sidebar(array(
    'name'          => esc_html__('Footer 3', 'pbf'),
    'id'            => 'footer-3',
    'description'   => esc_html__('Add widgets here.', 'pbf'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));
}
add_action('widgets_init', 'wp_bootstrap_starter_widgets_init');


/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_starter_scripts()
{
  wp_enqueue_style('pbf', get_stylesheet_uri());
  wp_enqueue_script('hoverIntent');

  if (!is_user_logged_in()) {
    //   wp_deregister_script('jquery');
    wp_deregister_script('hoverIntent');
  }
}
add_action('wp_enqueue_scripts', 'wp_bootstrap_starter_scripts');

function wp_bootstrap_starter_password_form()
{
  global $post;
  $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
  $o = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
    <div class="d-block mb-3">' . __("To view this protected post, enter the password below:", "pbf") . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __("Password:", "pbf") . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__("Submit", "pbf") . '" class="btn btn-primary"/></div>
    </form>';
  return $o;
}
add_filter('the_password_form', 'wp_bootstrap_starter_password_form');

$lang = qtranxf_getLanguage();

function filter_locales($entry)
{
  return $entry !== qtranxf_getLanguage();
}

function get_localized_url()
{

  global $wp;

  $data = array();
  $otherLang = array_values(array_filter(qtranxf_getSortedLanguages(), "filter_locales"))[0];

  $data['code'] = $otherLang;
  $data['name'] = qtranxf_getLanguageNameNative($otherLang);
  $data['path'] = qtranxf_convertURL(home_url(add_query_arg(array(), $wp->request)), $otherLang);

  return $data;
}

function filter_wp_nav_menu($nav_menu, $args)
{
  global $schemaURL;

  //map out the nav_menu for parsing
  $dom = new DOMDocument();
  @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $nav_menu);
  $x = new DOMXPath($dom);

  //parse the <nav> nodes
  foreach ($x->query("//nav[@id='main-navigation']") as $node) {
    $node->setAttribute("role", "navigation");
    $node->setAttribute("aria-hidden", 'false');
    //regenerate the html
    $nav_menu = $node->c14n();
  }


  return $nav_menu;
}

function get_the_content_pbf($more_link_text = '(more...)', $stripteaser = 0, $more_file = '')
{
  $content = get_the_content($more_link_text, $stripteaser, $more_file);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $content = preg_replace('#<a href(.*?)>(.*?)</a>#i', '<a class="link-page" \1>' . file_get_contents("inc/assets/arrow-right.svg.php", TRUE) . '<span>\2</span></a>', $content);

  return $content;
}

add_filter('wp_nav_menu', 'filter_wp_nav_menu', 10, 2);

function disable_embeds_code_init()
{

  // Remove the REST API endpoint.
  remove_action('rest_api_init', 'wp_oembed_register_route');

  // Turn off oEmbed auto discovery.
  add_filter('embed_oembed_discover', '__return_false');

  // Don't filter oEmbed results.
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

  // Remove oEmbed discovery links.
  remove_action('wp_head', 'wp_oembed_add_discovery_links');

  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action('wp_head', 'wp_oembed_add_host_js');
  add_filter('tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin');

  // Remove all embeds rewrite rules.
  add_filter('rewrite_rules_array', 'disable_embeds_rewrites');

  // Remove filter of the oEmbed result before any HTTP requests are made.
  remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
}

add_action('init', 'disable_embeds_code_init', 9999);

function disable_embeds_tiny_mce_plugin($plugins)
{
  return array_diff($plugins, array('wpembed'));
}

function disable_embeds_rewrites($rules)
{
  foreach ($rules as $rule => $rewrite) {
    if (false !== strpos($rewrite, 'embed=true')) {
      unset($rules[$rule]);
    }
  }
  return $rules;
}
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */

function tgm_io_shortcode_empty_paragraph_fix($content)
{

  $array = array(
    '<p>['    => '[',
    ']</p>'   => ']',
    ']<br />' => ']'
  );
  return strtr($content, $array);
}

add_filter('the_content', 'tgm_io_shortcode_empty_paragraph_fix');

function mytheme_tinymce_settings($settings)
{
  // //First, we define the styles we want to add in format 'Style Name' => 'css classes'
  // $classes = array(
  // 	__('Test style 1', 'mytheme') => 'teststyle1',
  // 	__('Test style 2', 'mytheme') => 'teststyle2',
  // 	__('Test style 3', 'mytheme') => 'teststyle3',
  // );

  // //Delimit styles by semicolon in format 'Title=classes;' so TinyMCE can use it
  // if ( ! empty( $settings['theme_advanced_styles'] ) ) {
  // 	$settings['theme_advanced_styles'] .= ';';
  // } else {
  // 	//If there's nothing defined yet, define it
  // 	$settings['theme_advanced_styles'] = '';
  // }

  // //Loop through our newly defined classes and add them to TinyMCE
  // $class_settings = '';
  // foreach ( $classes as $name => $value ) {
  // 	$class_settings .= "{$name}={$value};";
  // }

  // //Add our new class settings to the TinyMCE $settings array
  // $settings['theme_advanced_styles'] .= trim( $class_settings, '; ' );

  $settings['valid_children'] = '+dl[div],+div[dt|dd]';

  return $settings;
}
add_filter('tiny_mce_before_init', 'mytheme_tinymce_settings');

function my_deregister_scripts()
{
  wp_dequeue_script('wp-embed');
}
add_action('wp_footer', 'my_deregister_scripts');

add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');

remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('template_redirect', 'rest_output_link_header', 11);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load plugin compatibility file.
 */
require get_template_directory() . '/inc/plugin-compatibility/plugin-compatibility.php';

/**
 * Load custom WordPress nav walker.
 */
if (!class_exists('wp_bootstrap_navwalker')) {
  require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
}

require_once(get_template_directory() . '/inc/social-navwalker.php');

// Custom functions
include_once(get_template_directory() . '/inc/pbf_functions.php');

include_once(get_template_directory() . '/inc/shortcode-list-text.php');
include_once(get_template_directory() . '/inc/shortcode-heading-icon.php');
// include_once(get_template_directory() . '/inc/shortcode-static-map.php');
include_once(get_template_directory() . '/inc/shortcode-thumbnail.php');
include_once(get_template_directory() . '/inc/shortcode-map-preview.php');
