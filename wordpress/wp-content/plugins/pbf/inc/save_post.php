<?php

// Save metadata of custom post types defined by the plugin
add_action( 'save_post', 'meta_box_place_save' );
function meta_box_place_save( $post_id ) {

  // Save address
  if (array_key_exists("field_address", $_POST) && wp_verify_nonce( $_POST['field_address'], 'save_pbf_post' ) ) {
    $valid_keys = ['address', 'long', 'lat'];

    foreach ($valid_keys as $key) {
      if (array_key_exists($key, $_POST)) {
            update_post_meta(
                $post_id,
                $key,
                $_POST[$key]
            );
      }
    }
  }

  // Save schedule
  if (array_key_exists("field_schedule", $_POST) && wp_verify_nonce( $_POST['field_schedule'], 'save_pbf_post' ) ) {
    $valid_keys = ['start_date', 'end_date', 'start_time', 'end_time'];
    foreach ($valid_keys as $key) {
      if (array_key_exists($key, $_POST)) {
            update_post_meta(
                $post_id,
                $key,
                $_POST[$key]
            );
      }
    }
  }

  // Save or update organizers for a given event
  if (array_key_exists("field_organizers", $_POST) && wp_verify_nonce( $_POST['field_organizers'], 'save_pbf_post' ) ) {
    if (array_key_exists("organizers", $_POST)) {

      $organizers_old = get_post_meta($post_id, "organizers", true) ?? "";
      update_post_meta($post_id, "organizers", $_POST["organizers"]);

      $organizers = explode(',', $organizers);
      $organizers_old = explode(',', $organizers_old);

      $removed_organizers = array_diff($organizers_old, $organizers);

      // Pour chaque organisateur, on ajoute l'évènemnet aux évènements
      $organizers = explode(',', $_POST['organizers']);

      foreach($organizers as $org_id){
          $event_ids = get_post_meta($org_id, "events");
          $event_ids = explode(",", $event_ids);
          if (in_array($org_id, $removed_organizers)) {
            $event_ids = array_diff($event_ids, array(strval($post_id)));
          } else {
            $event_ids = array_unique(array_merge($event_ids, array(strval($post_id))));
          }
          update_post_meta($org_id, "events", implode(",", $event_ids));
      }
    }
  }
}
?>
