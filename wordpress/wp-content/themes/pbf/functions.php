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

    // Add theme support for selective refresh for widgets.
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
add_filter('wp_nav_menu', 'filter_wp_nav_menu', 10, 2);


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
