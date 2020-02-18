<?php

// Save metadata of custom post types defined by the plugin
add_action( 'save_post', 'meta_box_place_save' );
function meta_box_place_save( $post_id ) {
  // Check that request is legit
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;

  if (!array_key_exists("pbf_post_form_nonce", $_POST) || !wp_verify_nonce( $_POST['pbf_post_form_nonce'], 'save_pbf_post' ) )
  return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  // Save metadata
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

  // Save Events organized by a participant
  if (array_key_exists("events", $_POST))
  delete_post_meta($post_id,"events");
    //j'éclate mon input
    $events = explode(',',$_POST['events']);
    $events = array_slice($events, 0, 3);

    foreach($events as $evt){
        //pour chaque entrée j'ajoute une meta
        add_post_meta($post_id, "events", intval($evt));
    }

}
?>
