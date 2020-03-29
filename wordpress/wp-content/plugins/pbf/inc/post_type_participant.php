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
 		'edit_item'             => __( 'Modifier Participant', 'pbf' ),
 		'update_item'           => __( 'Modifier Participant', 'pbf' ),
 		'view_item'             => __( 'Voir le Participants', 'pbf' ),
 		'view_items'            => __( 'Voir les Participants', 'pbf' ),
 		'search_items'          => __( 'Chercher un Participant', 'pbf' ),
 		'not_found'             => __( 'Introuvable', 'pbf' ),
 		'not_found_in_trash'    => __( 'Introuvable dans la corbeille', 'pbf' ),
 		'featured_image'        => __( 'Logo', 'pbf' ),
 		'set_featured_image'    => __( 'Définir Logo', 'pbf' ),
 		'remove_featured_image' => __( 'Retirer Logo', 'pbf' ),
 		'use_featured_image'    => __( 'Définir comme Logo', 'pbf' ),
 		'insert_into_item'      => __( 'Insert into item', 'pbf' ),
 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'pbf' ),
 		'items_list'            => __( 'Liste des Participants', 'pbf' ),
 		'items_list_navigation' => __( 'Navigation', 'pbf' ),
 		'filter_items_list'     => __( 'Filtrer la Liste des Participants', 'pbf' ),
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
    'show_in_rest'          => true,
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

// Ajouter métadonnées dans l'API rest
add_action( 'rest_api_init', function () {
    register_rest_field( 'participant', 'meta', array(
        'get_callback' => function( $participant) {
            //$comment_obj = get_comment( $comment_arr['id'] );
            $metadata = get_post_meta($participant["id"]);

            $response = array();
            $response["geo"] = array();
            if (array_key_exists("address", $metadata)) {
              $response["geo"]["address"] = $metadata["address"][0];
            }
            if (array_key_exists("long", $metadata)) {
              $response["geo"]["long"] = floatval($metadata["long"][0]);
            }
            if (array_key_exists("lat", $metadata)) {
              $response["geo"]["lat"] = floatval($metadata["lat"][0]);
            }

            $response["social"] = array();
            if (array_key_exists("facebook", $metadata) && !empty($metadata["facebook"][0])) {
              $response["social"]["facebook"] = $metadata["facebook"][0];
            }
            if (array_key_exists("instagram", $metadata) && !empty($metadata["instagram"][0])) {
              $response["social"]["instagram"] = $metadata["instagram"][0];
            }

            $response["events"] = array();

            if (array_key_exists("events", $metadata) && !empty($metadata["events"][0])) {
              $events = explode(",", $metadata["events"][0]);
              $response["events"] = array_map('intval', $events);
            }

            $response["thumbnail"] = get_the_post_thumbnail($participant["id"]);

            return $response;
        },
        'schema' => array(
            'description' => __( 'metadonnees participant' ),
            'type'        => 'integer'
        ),
    ) );
  });
