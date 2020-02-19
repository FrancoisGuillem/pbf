<?php
/**
  * Plugin Name: PBF
  * Description: The Wordpress Extension of Paris Beer Festival
  * Text Domain: pbf
  * Domain Path: /languages
  */
include( plugin_dir_path( __FILE__ ) . 'inc/post_type_participant.php');
include( plugin_dir_path( __FILE__ ) . 'inc/post_type_event.php');
include( plugin_dir_path( __FILE__ ) . 'inc/save_post.php');


// Add jquery to admin pages
add_action( 'admin_enqueue_scripts', 'my_admin_scripts_method' );
function my_admin_scripts_method() {
  if( is_admin() ){
    wp_enqueue_script( 'jquery-ui.min', plugins_url( 'js/jquery-ui.min.js', __FILE__ ));
    wp_enqueue_style( 'jquery-ui.min', plugins_url( 'style/jquery-ui.min.css', __FILE__ ));
    wp_enqueue_style( 'jquery-ui.theme.min', plugins_url( 'style/jquery-ui.theme.min.css', __FILE__ ));
  }
}

?>
