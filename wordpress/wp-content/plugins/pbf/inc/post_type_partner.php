<?php
include_once( plugin_dir_path( __FILE__ ) . 'field_social.php');
include_once( plugin_dir_path( __FILE__ ) . 'field_partner_level.php');
// Register Custom Post Type: Participants
function register_type_partner() {

 	$labels = array(
 		'name'                  => _x( 'Partenaires', 'Post Type General Name', 'pbf' ),
 		'singular_name'         => _x( 'Partenaire', 'Post Type Singular Name', 'pbf' ),
 		'menu_name'             => __( 'Partenaires', 'pbf' ),
 		'name_admin_bar'        => __( 'Partenaires', 'pbf' ),
 		'archives'              => __( 'Partenaires', 'pbf' ),
 		'attributes'            => __( 'Item Attributes', 'pbf' ),
 		'parent_item_colon'     => __( 'Parent Item:', 'pbf' ),
 		'all_items'             => __( 'Tous les Partenaires', 'pbf' ),
 		'add_new_item'          => __( 'Ajouter un Partenaire', 'pbf' ),
 		'add_new'               => __( 'Ajouter un Partenaire', 'pbf' ),
 		'new_item'              => __( 'Nouveau Partenaire', 'pbf' ),
 		'edit_item'             => __( 'Modifier Partenaire', 'pbf' ),
 		'update_item'           => __( 'Actualiser Partenaire', 'pbf' ),
 		'view_item'             => __( 'Voir Partenaire', 'pbf' ),
 		'view_items'            => __( 'Voir Partenaires', 'pbf' ),
 		'search_items'          => __( 'Rechercher un Partenaire', 'pbf' ),
 		'not_found'             => __( 'Not found', 'pbf' ),
 		'not_found_in_trash'    => __( 'Not found in Trash', 'pbf' ),
 		'featured_image'        => __( 'Logo', 'pbf' ),
 		'set_featured_image'    => __( 'Définir Logo', 'pbf' ),
 		'remove_featured_image' => __( 'Retirer Logo', 'pbf' ),
 		'use_featured_image'    => __( 'Utiliser comme logo', 'pbf' ),
 		'insert_into_item'      => __( 'Insert into item', 'pbf' ),
 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'pbf' ),
 		'items_list'            => __( 'Liste des Partenaires', 'pbf' ),
 		'items_list_navigation' => __( 'Items list navigation', 'pbf' ),
 		'filter_items_list'     => __( 'Filtrer Partenaires', 'pbf' ),
 	);
 	$args = array(
 		'label'                 => __( 'Partenaire', 'pbf' ),
 		'description'           => __( 'Partenaires du Paris Beer Festival', 'pbf' ),
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
    'show_in_rest'          => true,
 	);
 	register_post_type( 'partner', $args );

 }
 add_action( 'init', 'register_type_partner', 0 );


add_action("add_meta_boxes", "partner_level");
function partner_level() {
  add_meta_box(
    "partner_level",
    __("Niveau Partenariat", "pbf"),
    "field_partner_level",
    "partner",
    "normal",
    "high"
  );
}

add_action("add_meta_boxes", "partner_social");
function partner_social() {
  add_meta_box(
    "partner_social",
    __("Liens Sociaux", "pbf"),
    "field_social",
    "partner",
    "normal",
    "high"
  );
}
