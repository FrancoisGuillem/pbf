<?php
/**
 * Plugin Name: PBF
 * Description: Plugin du Paris Beer Festival
 */

 // Register Custom Post Type: event
add_action( 'init', 'register_type_event', 0 );
function register_type_event() {

 	$labels = array(
 		'name'                  => _x( 'Events', 'Post Type General Name', 'pbw' ),
 		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'pbw' ),
 		'menu_name'             => __( 'Events', 'pbw' ),
 		'name_admin_bar'        => __( 'Events', 'pbw' ),
 		'archives'              => __( 'Events', 'pbw' ),
 		'attributes'            => __( 'Event Attributes', 'pbw' ),
 		'parent_item_colon'     => __( 'Parent Item:', 'pbw' ),
 		'all_items'             => __( 'All Events', 'pbw' ),
 		'add_new_item'          => __( 'Add New Event', 'pbw' ),
 		'add_new'               => __( 'Add New', 'pbw' ),
 		'new_item'              => __( 'New Event', 'pbw' ),
 		'edit_item'             => __( 'Edit Event', 'pbw' ),
 		'update_item'           => __( 'Update Event', 'pbw' ),
 		'view_item'             => __( 'View Event', 'pbw' ),
 		'view_items'            => __( 'View Events', 'pbw' ),
 		'search_items'          => __( 'Search Event', 'pbw' ),
 		'not_found'             => __( 'Not found', 'pbw' ),
 		'not_found_in_trash'    => __( 'Not found in Trash', 'pbw' ),
 		'featured_image'        => __( 'Featured Image', 'pbw' ),
 		'set_featured_image'    => __( 'Set featured image', 'pbw' ),
 		'remove_featured_image' => __( 'Remove featured image', 'pbw' ),
 		'use_featured_image'    => __( 'Use as featured image', 'pbw' ),
 		'insert_into_item'      => __( 'Insert into item', 'pbw' ),
 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'pbw' ),
 		'items_list'            => __( 'Items list', 'pbw' ),
 		'items_list_navigation' => __( 'Items list navigation', 'pbw' ),
 		'filter_items_list'     => __( 'Filter items list', 'pbw' ),
 	);
 	$args = array(
 		'label'                 => __( 'events', 'pbw' ),
 		'description'           => __( 'Paris Beer Festival Events', 'pbw' ),
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
