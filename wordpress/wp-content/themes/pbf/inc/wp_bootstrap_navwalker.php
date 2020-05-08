<?php

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 4.1.0
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/* Check if Class Exists. */
if (!class_exists('WP_Bootstrap_Navwalker')) {
  /**
   * WP_Bootstrap_Navwalker class.
   *
   * @extends Walker_Nav_Menu
   */
  class WP_Bootstrap_Navwalker extends Walker_Nav_Menu
  {

    /**
     * Starts the list before the elements are added.
     *
     * @since WP 3.0.0
     *
     * @see Walker_Nav_Menu::start_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
      if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $indent = str_repeat($t, $depth);
      // Default class to add to the file.
      $classes = array('dropdown-menu');
      /**
       * Filters the CSS class(es) applied to a menu list element.
       *
       * @since WP 4.8.0
       *
       * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
       * @param stdClass $args    An object of `wp_nav_menu()` arguments.
       * @param int      $depth   Depth of menu item. Used for padding.
       */
      $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
      $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
      // $id = 'id="dropdown-' . ($depth + 1) . '"';
      $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }

    /**
     * Starts the element output.
     *
     * @since WP 3.0.0
     * @since WP 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     * @see Walker_Nav_Menu::start_el()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
      if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $indent = ($depth) ? str_repeat($t, $depth) : '';

      $classes = empty($item->classes) ? array() : (array) $item->classes;

      foreach ($classes as $key => $class) {
        if (preg_match('/^menu-|^current_|^current-|^qtranxs-/i', $class) && !empty($class)) {
          unset($classes[$key]);
        }
      }
      // echo "<pre>" . print_r($classes) .  "</pre>";
      /**
       * Filters the arguments for a single nav menu item.
       *
       *  WP 4.4.0
       *
       * @param stdClass $args  An object of wp_nav_menu() arguments.
       * @param WP_Post  $item  Menu item data object.
       * @param int      $depth Depth of menu item. Used for padding.
       */
      $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

      // Add .dropdown or .active classes where they are needed.
      if (isset($args->has_children) && $args->has_children) {
        $classes[] = 'dropdown';
      }

      // Form a string of classes in format: class="class_names".
      $class_names = join(' ', $classes);

      $output .= $indent . '<li>';

      // initialize array for holding the $atts for the link item.
      $atts = array();

      $atts['class'] = $class_names;

      // echo "<pre>" . $class_names . "</pre>";

      // If item has_children add atts to <a>.
      if (isset($args->has_children) && $args->has_children && 0 === $depth && $args->depth > 1) {
        $menuOpener = true;
        //   $atts['aria-expanded'] = 'false';
      }
      // } else {
      // if ($depth === 0 && (in_array('current-menu-item', $item->classes, true) || in_array('current-menu-parent', $item->classes, true))) {
      //   $atts['aria-current'] = 'page';
      // } else {
      $atts['href'] = !empty($item->url) ? $item->url : '';
      // }
      // }

      // Allow filtering of the $atts array before using it.
      $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

      // Build a string of html containing all the atts for the item.
      $attributes = '';
      foreach ($atts as $attr => $value) {
        if (!empty($value)) {
          $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
          $attributes .= ' ' . $attr . '="' . $value . '"';
        }
      }

      /**
       * Set a typeflag to easily test if this is a linkmod or not.
       */
      // $linkmod_type = self::get_linkmod_type($linkmod_classes);

      /**
       * START appending the internal item contents to the output.
       */
      $item_output = isset($args->before) ? $args->before : '';
      /**
       * This is the start of the internal nav item. Depending on what
       * kind of linkmod we have we may need different wrapper elements.
       */
      if (isset($menuOpener)) {
        $item_output .= '<a' . $attributes . '><span>';
      } else {
        // With no link mod type set this must be a standard <a> tag.
        $item_output .= '<a' . $attributes . '>';
      }


      /** This filter is documented in wp-includes/post-template.php */
      $title = apply_filters('the_title', $item->title, $item->ID);

      /**
       * Filters a menu item's title.
       *
       * @since WP 4.4.0
       *
       * @param string   $title The menu item's title.
       * @param WP_Post  $item  The current menu item.
       * @param stdClass $args  An object of wp_nav_menu() arguments.
       * @param int      $depth Depth of menu item. Used for padding.
       */
      $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

      // Put the item contents into $output.
      $item_output .= isset($args->link_before) ? $args->link_before . $title . $args->link_after : '';
      /**
       * This is the end of the internal nav item. We need to close the
       * correct element depending on the type of link or link mod.
       */
      if (isset($menuOpener)) {
        $item_output .= '</span>' . file_get_contents('assets/chevron.svg.php', TRUE) . '</a> ';
      } else {
        // With no link mod type set this must be a standard <a> tag.
        $item_output .= '</a>';
      }

      /**
       * END appending the internal item contents to the output.
       */
      $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth. It is possible to set the
     * max depth to include all depths, see walk() method.
     *
     * This method should not be called directly, use the walk() method instead.
     *
     * @since WP 2.5.0
     *
     * @see Walker::start_lvl()
     *
     * @param object $element           Data object.
     * @param array  $children_elements List of elements to continue traversing (passed by reference).
     * @param int    $max_depth         Max depth to traverse.
     * @param int    $depth             Depth of current element.
     * @param array  $args              An array of arguments.
     * @param string $output            Used to append additional content (passed by reference).
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
      if (!$element) {
        return;
      }
      $id_field = $this->db_fields['id'];
      // Display this element.
      if (is_object($args[0])) {
        $args[0]->has_children = !empty($children_elements[$element->$id_field]);
      }
      parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a menu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     */
    public static function fallback($args)
    {
      if (current_user_can('edit_theme_options')) {

        /* Get Arguments. */
        $container       = $args['container'];
        $container_id    = $args['container_id'];
        $container_class = $args['container_class'];
        $menu_class      = $args['menu_class'];
        $menu_id         = $args['menu_id'];

        // initialize var to store fallback html.
        $fallback_output = '';

        if ($container) {
          $fallback_output .= '<' . esc_attr($container);
          if ($container_id) {
            $fallback_output .= ' id="' . esc_attr($container_id) . '"';
          }
          if ($container_class) {
            $fallback_output .= ' class="' . esc_attr($container_class) . '"';
          }
          $fallback_output .= '>';
        }
        $fallback_output .= '<ul';
        if ($menu_id) {
          $fallback_output .= ' id="' . esc_attr($menu_id) . '"';
        }
        if ($menu_class) {
          $fallback_output .= ' class="' . esc_attr($menu_class) . '"';
        }
        $fallback_output .= '>';
        $fallback_output .= '<li><a href="' . esc_url(admin_url('nav-menus.php')) . '" title="' . esc_attr__('Add a menu', 'wp-bootstrap-starter') . '">' . esc_html__('Add a menu', 'wp-bootstrap-starter') . '</a></li>';
        $fallback_output .= '</ul>';
        if ($container) {
          $fallback_output .= '</' . esc_attr($container) . '>';
        }

        // if $args has 'echo' key and it's true echo, otherwise return.
        if (array_key_exists('echo', $args) && $args['echo']) {
          echo $fallback_output; // WPCS: XSS OK.
        } else {
          return $fallback_output;
        }
      }
    }
  }
}
