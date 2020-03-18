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
    'show_in_rest'          => true,
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

 // Lien facebook
  add_action("add_meta_boxes", "event_social");
  function event_social() {
    add_meta_box(
      "event_social",
      __("Facebook", "pbf"),
      "field_social",
      "event",
      "normal",
      "high"
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

// Ajouter métadonnées dans l'API rest
add_action( 'rest_api_init', function () {
  register_rest_field( 'event', 'meta', array(
    'get_callback' => function( $event) {
      $metadata = get_post_meta($event["id"]);

      $response = array();


      $response["geo"] = pbf_get_event_address($metadata);

      $response["social"] = array();
      if (array_key_exists("facebook", $metadata) && !empty($metadata["facebook"][0])) {
        $response["social"]["facebook"] = $metadata["facebook"][0];
      }
      if (array_key_exists("instagram", $metadata) && !empty($metadata["instagram"][0])) {
        $response["social"]["instagram"] = $metadata["instagram"][0];
      }

      $response["schedule"] = array();
      if (array_key_exists("start_date", $metadata) && !empty($metadata["start_date"][0])) {
        $response["schedule"]["start_date"] = $metadata["start_date"][0];
      }
      if (array_key_exists("end_date", $metadata) && !empty($metadata["end_date"][0])) {
        $response["schedule"]["end_date"] = $metadata["end_date"][0];
      }
      if (array_key_exists("start_time", $metadata) && !empty($metadata["start_time"][0])) {
        $response["schedule"]["start_time"] = $metadata["start_time"][0];
      }
      if (array_key_exists("end_time", $metadata) && !empty($metadata["end_time"][0])) {
        $response["schedule"]["end_time"] = $metadata["end_time"][0];
      }

      $response["organizers"] = array();

      if (array_key_exists("organizers", $metadata) && !empty($metadata["organizers"][0])) {
        $organizers = explode(",", $metadata["organizers"][0]);
        $response["organizers"] = array_map('intval', $organizers);
      }

      return $response;
    },
    'schema' => array(
      'description' => __( 'metadonnees evenements' ),
      'type'        => 'integer'
    ),
  ));
});

// Récupère l'adresse d'un évènement.
// Il s'agit soit de l'adresse directement entrée dans la page de l'évènement,
// soit l'adresse du premier organisateur de l'évènement
function pbf_get_event_address($event_metadata) {
  if (array_key_exists("address", $event_metadata) && $event_metadata["address"][0] != "") {
    return array(
      "address" => $event_metadata["address"][0] ?? "",
      "long" => floatval($event_metadata["long"][0] ?? ""),
      "lat" => floatval($event_metadata["lat"][0] ?? "")
    );
  }

  if (array_key_exists("organizers", $event_metadata) && ! empty($event_metadata["organizers"])) {
    $org_id = explode(",", $event_metadata["organizers"][0])[0];
    $organizer_metadata = get_post_meta($org_id);
    return array(
      "address" => $organizer_metadata["address"][0] ?? "",
      "long" => floatval($organizer_metadata["long"][0] ?? ""),
      "lat" => floatval($organizer_metadata["lat"][0] ?? "")
    );
  }

  return array();
}

/* Récupère les noms et liens des organisateurs.
 *
 * @param $event_metadata
 */
function pbf_get_event_organizers($event_metadata) {
  $organizers = [];
  $organizer_ids = explode(",", $event_metadata["organizers"][0]);

  foreach ($organizer_ids as $org_id) {
    $post = get_post($org_id);
    $organizer = array(
      "id" => $org_id,
      "title" => get_the_title($post),
      "link" => get_permalink($post)
    );
    array_push($organizers, $organizer);
  }

  return $organizers;
}
