<?php
 // Register Custom Post Type: Lieux
 function register_type_place() {

 	$labels = array(
 		'name'                  => _x( 'Lieux', 'Post Type General Name', 'pbf' ),
 		'singular_name'         => _x( 'Lieu', 'Post Type Singular Name', 'pbf' ),
 		'menu_name'             => __( 'Lieux', 'pbf' ),
 		'name_admin_bar'        => __( 'Lieux', 'pbf' ),
 		'archives'              => __( 'Lieux', 'pbf' ),
 		'attributes'            => __( 'Item Attributes', 'pbf' ),
 		'parent_item_colon'     => __( 'Parent Item:', 'pbf' ),
 		'all_items'             => __( 'Tous les Lieux', 'pbf' ),
 		'add_new_item'          => __( 'Ajouter un Lieu', 'pbf' ),
 		'add_new'               => __( 'Ajouter un Lieu', 'pbf' ),
 		'new_item'              => __( 'Nouveau Lieu', 'pbf' ),
 		'edit_item'             => __( 'Edit Item', 'pbf' ),
 		'update_item'           => __( 'Update Item', 'pbf' ),
 		'view_item'             => __( 'View Item', 'pbf' ),
 		'view_items'            => __( 'View Items', 'pbf' ),
 		'search_items'          => __( 'Search Item', 'pbf' ),
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
 		'label'                 => __( 'Lieu', 'pbf' ),
 		'description'           => __( 'Organisateur des évènements Paris Beer Festival', 'pbf' ),
 		'labels'                => $labels,
 		'supports'              => array( 'title'),
 		'hierarchical'          => false,
 		'public'                => true,
 		'show_ui'               => true,
 		'show_in_menu'          => true,
 		'menu_position'         => 5,
 		'show_in_admin_bar'     => true,
 		'show_in_nav_menus'     => true,
 		'can_export'            => true,
 		'has_archive'           => false,
 		'exclude_from_search'   => false,
 		'publicly_queryable'    => true,
 		'capability_type'       => 'page',
 	);
 	register_post_type( 'place', $args );

 }
 add_action( 'init', 'register_type_place', 0 );
