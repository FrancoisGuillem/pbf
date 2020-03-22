<?php
/**
  * Plugin Name: PBF
  * Description: The Wordpress Extension of Paris Beer Festival
  * Text Domain: pbf
  * Domain Path: /languages
  */
include( plugin_dir_path( __FILE__ ) . 'inc/post_type_participant.php');
include( plugin_dir_path( __FILE__ ) . 'inc/post_type_event.php');
include( plugin_dir_path( __FILE__ ) . 'inc/post_type_partner.php');
include( plugin_dir_path( __FILE__ ) . 'inc/save_post.php');
include( plugin_dir_path( __FILE__ ) . 'inc/delete_post.php');
include( plugin_dir_path( __FILE__ ) . 'inc/filter_events_by_date.php');
include( plugin_dir_path( __FILE__ ) . 'inc/order_partners_by_level.php');


// Add jquery to admin pages
add_action( 'admin_enqueue_scripts', 'my_admin_scripts_method' );
function my_admin_scripts_method() {
  if( is_admin() ){
    wp_enqueue_script( 'jquery.validate.min', plugins_url( 'js/jquery.validate.min.js', __FILE__ ));
    wp_enqueue_script( 'messages_fr.min', plugins_url( 'js/messages_fr.min.js', __FILE__ ));
    wp_enqueue_script( 'jquery-ui.min', plugins_url( 'js/jquery-ui.min.js', __FILE__ ));
    wp_enqueue_style( 'jquery-ui.min', plugins_url( 'style/jquery-ui.min.css', __FILE__ ));
    wp_enqueue_style( 'jquery-ui.theme.min', plugins_url( 'style/jquery-ui.theme.min.css', __FILE__ ));

    global $typenow;
    if ($typenow == "event") {
      wp_enqueue_script('validate_metadata_event', plugins_url('js/validate_metadata_event.js', __FILE__));
    }
    if ($typenow == "participant") {
      wp_enqueue_script('validate_metadata_participant', plugins_url('js/validate_metadata_participant.js', __FILE__));
    }
    if ($typenow == "partner") {
      wp_enqueue_script('validate_metadata_partner', plugins_url('js/validate_metadata_partner.js', __FILE__));
    }
  }
}

?>
