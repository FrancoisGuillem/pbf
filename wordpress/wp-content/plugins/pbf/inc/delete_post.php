<?php
add_action( 'wp_trash_post', 'pbf_delete_event' );
function pbf_delete_event( $post_id ) {
  $metadata = get_post_meta($post_id);
  if (!array_key_exists("organizers", $metadata)) {
    return;
  } else {
    $organizers = $metadata["organizers"][0];
    if (empty($organizers)) {return;}
  }

  // Pour chaque organisateur, on retire l'évènement
  $organizers = explode(',', $organizers);

  foreach($organizers as $org_id) {
    $event_ids = get_post_meta($org_id, "events", true);
    if (!empty($event_ids)) { // Juste au cas où
      $event_ids = explode(",", $event_ids);
      $event_ids = array_diff($event_ids, array($post_id));
      update_post_meta($org_id, "events", implode(",", $event_ids));
    }
  }

}
 ?>
