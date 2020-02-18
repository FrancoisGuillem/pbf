<?php
/**
  * Plugin Name: PBF
  * Description: The Wordpress Extension of Paris Beer Festival
  * Text Domain: pbf
  * Domain Path: /languages
  */
include( plugin_dir_path( __FILE__ ) . 'participants/register_type.php');
include( plugin_dir_path( __FILE__ ) . 'places/register_type.php');
include( plugin_dir_path( __FILE__ ) . 'events/register_type.php');
include( plugin_dir_path( __FILE__ ) . 'participants/metadata.php');
include( plugin_dir_path( __FILE__ ) . 'places/metadata.php');
?>
