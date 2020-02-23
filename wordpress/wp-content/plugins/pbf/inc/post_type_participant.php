<?php
include_once( plugin_dir_path( __FILE__ ) . 'field_social.php');
include_once( plugin_dir_path( __FILE__ ) . 'field_address.php');
// Register Custom Post Type: Participants
function register_type_participant() {

 	$labels = array(
 		'name'                  => _x( 'Participants', 'Post Type General Name', 'pbf' ),
 		'singular_name'         => _x( 'Participant', 'Post Type Singular Name', 'pbf' ),
 		'menu_name'             => __( 'Participants', 'pbf' ),
 		'name_admin_bar'        => __( 'Participants', 'pbf' ),
 		'archives'              => __( 'Participants', 'pbf' ),
 		'attributes'            => __( 'Item Attributes', 'pbf' ),
 		'parent_item_colon'     => __( 'Parent Item:', 'pbf' ),
 		'all_items'             => __( 'Tous les participants', 'pbf' ),
 		'add_new_item'          => __( 'Ajouter un Participant', 'pbf' ),
 		'add_new'               => __( 'Ajouter un Participant', 'pbf' ),
 		'new_item'              => __( 'Nouveau Participant', 'pbf' ),
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
 		'label'                 => __( 'Participant', 'pbf' ),
 		'description'           => __( 'Organisateur des évènements Paris Beer Festival', 'pbf' ),
 		'labels'                => $labels,
 		'supports'              => array( 'title', 'editor', 'thumbnail' ),
    "taxonomies"            => array("participant_cat"),
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
 add_action( 'init', 'register_type_participant', 0 );

// Custom categories
function participant_cat() {
	/* Property Type */
	$labels = array(
		'name'                       => _x('Catégories', 'Taxonomy General Name', 'textdomain'),
		'singular_name'              => _x('Catégorie', 'Taxonomy Singular Name', 'textdomain'),
		'menu_name'                  => __('Catégorie', 'textdomain'),
		'all_items'                  => __('Toutes les Catégories', 'textdomain'),
		'parent_item'                => __('Parent Type', 'textdomain'),
		'parent_item_colon'          => __('Parent Type:', 'textdomain'),
		'new_item_name'              => __('Nom de la nouvelle catégorie', 'textdomain'),
		'add_new_item'               => __('Ajouter Catégorie', 'textdomain'),
		'edit_item'                  => __('Editer Catégorie', 'textdomain'),
		'update_item'                => __('Actualiser Catégorie', 'textdomain'),
		'view_item'                  => __('Voir Catégorie', 'textdomain'),
		'separate_items_with_commas' => __('Separate types with commas', 'textdomain'),
		'add_or_remove_items'        => __('Ajouter ou retirer', 'textdomain'),
		'choose_from_most_used'      => __('Choose from the most used', 'textdomain'),
		'popular_items'              => __('Popular Types', 'textdomain'),
		'search_items'               => __('Search Types', 'textdomain'),
		'not_found'                  => __('Not Found', 'textdomain'),
		'no_terms'                   => __('No types', 'textdomain'),
		'items_list'                 => __('Types list', 'textdomain'),
		'items_list_navigation'      => __('Types list navigation', 'textdomain'),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
    'query_var'                  => true,
		'show_in_rest'               => false
	);
	register_taxonomy('participant_cat', array('participant'), $args);
}
add_action('init', 'participant_cat', 10);




add_action("add_meta_boxes", "participant_social");
function participant_social() {
  add_meta_box(
    "participant_social",
    __("Réseaux sociaux", "pbf"),
    "field_social",
    "participant",
    "normal",
    "high"
  );
}


 // Add address metabox
 add_action( 'add_meta_boxes', 'participant_address' );
 function participant_address() {
     add_meta_box(
         'participant_address',
         __( 'Adresse du participant', 'pbw' ),
         'field_address',
         'participant',
         'normal',
         'high'
     );
 }
