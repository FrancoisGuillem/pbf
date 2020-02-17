<?php
/**
 * Plugin Name: PBF
 * Description: Plugin du Paris Beer Festival
 */


 // Register Custom Post Type: Participants
 add_action( 'init', 'register_type_place', 0 );
 function register_type_place() {

 	$labels = array(
 		'name'                  => _x( 'place', 'Post Type General Name', 'pbw' ),
 		'singular_name'         => _x( 'Place', 'Post Type Singular Name', 'pbw' ),
 		'menu_name'             => __( 'Places', 'pbw' ),
 		'name_admin_bar'        => __( 'Places', 'pbw' ),
 		'archives'              => __( 'Places', 'pbw' ),
 		'attributes'            => __( 'Item Attributes', 'pbw' ),
 		'parent_item_colon'     => __( 'Parent Item:', 'pbw' ),
 		'all_items'             => __( 'All Places', 'pbw' ),
 		'add_new_item'          => __( 'Add New Place', 'pbw' ),
 		'add_new'               => __( 'Add New', 'pbw' ),
 		'new_item'              => __( 'New Place', 'pbw' ),
 		'edit_item'             => __( 'Edit Place', 'pbw' ),
 		'update_item'           => __( 'Update Place', 'pbw' ),
 		'view_item'             => __( 'View Place', 'pbw' ),
 		'view_items'            => __( 'View Places', 'pbw' ),
 		'search_items'          => __( 'Search Place', 'pbw' ),
 		'not_found'             => __( 'Not found', 'pbw' ),
 		'not_found_in_trash'    => __( 'Not found in Trash', 'pbw' ),
 		'featured_image'        => __( 'Featured Image', 'pbw' ),
 		'set_featured_image'    => __( 'Set featured image', 'pbw' ),
 		'remove_featured_image' => __( 'Remove featured image', 'pbw' ),
 		'use_featured_image'    => __( 'Use as featured image', 'pbw' ),
 		'insert_into_item'      => __( 'Insert into item', 'pbw' ),
 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'pbw' ),
 		'items_list'            => __( 'Places list', 'pbw' ),
 		'items_list_navigation' => __( 'Places list navigation', 'pbw' ),
 		'filter_items_list'     => __( 'Filter places list', 'pbw' ),
 	);
 	$args = array(
 		'label'                 => __( 'Places', 'pbw' ),
 		'description'           => __( 'Adresses of participants and events', 'pbw' ),
 		'labels'                => $labels,
 		'supports'              => array( 'title', 'editor'),
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
 	register_post_type( 'place', $args );

 }
