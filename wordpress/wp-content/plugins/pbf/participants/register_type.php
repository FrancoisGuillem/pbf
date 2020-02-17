<?php
 // Register Custom Post Type: Participants
 function register_participants_type() {

 	$labels = array(
 		'name'                  => _x( 'Participants', 'Post Type General Name', 'pbw' ),
 		'singular_name'         => _x( 'Participant', 'Post Type Singular Name', 'pbw' ),
 		'menu_name'             => __( 'Participants', 'pbw' ),
 		'name_admin_bar'        => __( 'Participants', 'pbw' ),
 		'archives'              => __( 'Participants', 'pbw' ),
 		'attributes'            => __( 'Item Attributes', 'pbw' ),
 		'parent_item_colon'     => __( 'Parent Item:', 'pbw' ),
 		'all_items'             => __( 'Tous les participants', 'pbw' ),
 		'add_new_item'          => __( 'Add New Item', 'pbw' ),
 		'add_new'               => __( 'Add New', 'pbw' ),
 		'new_item'              => __( 'New Item', 'pbw' ),
 		'edit_item'             => __( 'Edit Item', 'pbw' ),
 		'update_item'           => __( 'Update Item', 'pbw' ),
 		'view_item'             => __( 'View Item', 'pbw' ),
 		'view_items'            => __( 'View Items', 'pbw' ),
 		'search_items'          => __( 'Search Item', 'pbw' ),
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
 		'label'                 => __( 'Participant', 'pbw' ),
 		'description'           => __( 'Organisateur des évènements Paris Beer Festival', 'pbw' ),
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
 	register_post_type( 'participant', $args );

 }
 add_action( 'init', 'register_participants_type', 0 );
