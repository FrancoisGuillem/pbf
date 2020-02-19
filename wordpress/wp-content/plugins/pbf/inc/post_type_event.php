<?php
include_once( plugin_dir_path( __FILE__ ) . 'field_address.php');
include_once( plugin_dir_path( __FILE__ ) . 'field_organizers.php');
include_once( plugin_dir_path( __FILE__ ) . 'field_schedule.php');

 // Register Custom Post Type: Evènement
add_action( 'init', 'register_type_events', 0 );
function register_type_events() {

 	$labels = array(
 		'name'                  => _x( 'Evènements', 'Post Type General Name', 'pbf' ),
 		'singular_name'         => _x( 'Evènement', 'Post Type Singular Name', 'pbf' ),
 		'menu_name'             => __( 'Evènements', 'pbf' ),
 		'name_admin_bar'        => __( 'Evènements', 'pbf' ),
 		'archives'              => __( 'Evènements', 'pbf' ),
 		'attributes'            => __( "Attribut de l'Evènement", 'pbf' ),
 		'parent_item_colon'     => __( 'Parent Item:', 'pbf' ),
 		'all_items'             => __( 'Tous les Evènements', 'pbf' ),
 		'add_new_item'          => __( 'Ajouter un Evènement', 'pbf' ),
 		'add_new'               => __( 'Ajouter', 'pbf' ),
 		'new_item'              => __( 'Nouvel Evènement', 'pbf' ),
 		'edit_item'             => __( "Editer l'Evènement", 'pbf' ),
 		'update_item'           => __( "Actualiser l'Evènement", 'pbf' ),
 		'view_item'             => __( 'Voir Evènement', 'pbf' ),
 		'view_items'            => __( 'Voir Evènements', 'pbf' ),
 		'search_items'          => __( 'Chercher Evènement', 'pbf' ),
 		'not_found'             => __( 'Not found', 'pbf' ),
 		'not_found_in_trash'    => __( 'Not found in Trash', 'pbf' ),
 		'featured_image'        => __( 'Featured Image', 'pbf' ),
 		'set_featured_image'    => __( 'Set featured image', 'pbf' ),
 		'remove_featured_image' => __( 'Remove featured image', 'pbf' ),
 		'use_featured_image'    => __( 'Use as featured image', 'pbf' ),
 		'insert_into_item'      => __( 'Insert into item', 'pbf' ),
 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'pbf' ),
 		'items_list'            => __( 'Items list', 'pbf' ),
 		'items_list_navigation' => __( 'Items list navigation', 'pbf' ),
 		'filter_items_list'     => __( 'Filter items list', 'pbf' ),
 	);
 	$args = array(
 		'label'                 => __( 'Evènements', 'pbf' ),
 		'description'           => __( 'Les Evènements du Paris Beer Festival', 'pbf' ),
 		'labels'                => $labels,
 		'supports'              => array( 'title', 'editor', 'thumbnail' ),
 		'hierarchical'          => false,
 		'public'                => true,
 		'show_ui'               => true,
 		'show_in_menu'          => true,
 		'menu_position'         => 5,
 		'show_in_admin_bar'     => true,
 		'show_in_nav_menus'     => true,
 		'can_export'            => true,
 		'has_archive'           => true,
 		'exclude_from_search'   => false,
 		'publicly_queryable'    => true,
 		'capability_type'       => 'page',
 	);
 	register_post_type( 'event', $args );

 }

 // Add participants metabox
 add_action( 'add_meta_boxes', 'event_organizers' );
 function event_organizers() {
     add_meta_box(
         'event_organizers',
         __( "Organisateurs de l'évènement", 'pbw' ),
         'field_organizers',
         'event',
         'normal',
         'high'
     );
 }

 // Add address metabox
 add_action( 'add_meta_boxes', 'event_schedule' );
 function event_schedule() {
     add_meta_box(
         'event_schedule',
         __( "Horaires", 'pbw' ),
         'field_schedule',
         'event',
         'normal',
         'high'
     );
 }

 // Add address metabox
 add_action( 'add_meta_boxes', 'event_address' );
 function event_address() {
     add_meta_box(
         'event_address',
         __( "Adresse (Laisser vide si l'évènement a lieu chez l'organisateur principal)", 'pbw' ),
         'field_address',
         'event',
         'normal',
         'high'
     );
 }
