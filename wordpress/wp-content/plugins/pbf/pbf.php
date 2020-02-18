<?php
/**
  * Plugin Name: PBF
  * Description: The Wordpress Extension of Paris Beer Festival
  * Text Domain: pbf
  * Domain Path: /languages
  */
include( plugin_dir_path( __FILE__ ) . 'inc/post_type_participant.php');
include( plugin_dir_path( __FILE__ ) . 'inc/post_type_place.php');
include( plugin_dir_path( __FILE__ ) . 'inc/post_type_event.php');
include( plugin_dir_path( __FILE__ ) . 'inc/save_post.php');
?>
