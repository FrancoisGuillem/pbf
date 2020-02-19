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
      delete_post_meta($post_id,"organizers");
        //j'éclate mon input
        $organizers = explode(',',$_POST['organizers']);
        $organizers = array_slice($organizers, 0, 3);

        foreach($organizers as $evt){
            //pour chaque entrée j'ajoute une meta
            add_post_meta($post_id, "organizers", intval($evt));
        }
    }
  }
}
?>
