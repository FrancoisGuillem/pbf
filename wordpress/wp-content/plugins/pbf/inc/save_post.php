<?php

// Save metadata of custom post types defined by the plugin
add_action( 'save_post', 'pbf_save_custom_fields' );
function pbf_save_custom_fields( $post_id ) {

  // Save address
  if (pbf_check_nonce("field_address")) {
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
  if (pbf_check_nonce("field_schedule")) {
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

  // Save social
  if (pbf_check_nonce("field_social")) {
    $valid_keys = ['facebook', 'instagram'];
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
  if ( pbf_check_nonce("field_organizers")) {
    if (array_key_exists("organizers", $_POST)) {

      $organizers_old = pbf_string_to_array(get_post_meta($post_id, "organizers", true));

      update_post_meta($post_id, "organizers", $_POST["organizers"]);

      $organizers = pbf_string_to_array($_POST["organizers"]);

      $removed_organizers = array_diff($organizers_old, $organizers);

      foreach ($removed_organizers as $org_id) {
        $event_ids = pbf_string_to_array(get_post_meta($org_id, "events", true));
        $event_ids = array_diff($event_ids, array($post_id));
        update_post_meta($org_id, "events", implode(",", $event_ids));
      }

      foreach ($organizers as $org_id) {
          $event_ids = pbf_string_to_array(get_post_meta($org_id, "events", true));
          $event_ids = array_unique(array_merge($event_ids, array($post_id)));
          update_post_meta($org_id, "events", implode(",", $event_ids));
      }
    }
  }
}

function pbf_check_nonce($field) {
  return array_key_exists($field, $_POST) && wp_verify_nonce( $_POST[$field], 'save_pbf_post' );
}

function pbf_string_to_array($x) {
  if (empty($x)) {
    $x = [];
  } else {
    $x = explode(",", $x);
  }
  return $x;
}
?>
