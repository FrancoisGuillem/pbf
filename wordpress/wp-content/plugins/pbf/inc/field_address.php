<?php

function field_address( $post ) {
  $metadata = get_post_meta($post->ID);

  wp_nonce_field('save_pbf_post', 'pbf_post_form_nonce' );
  echo '';
  ?>
  <input type="text" id="address" name="address" value="<?= $metadata["address"][0] ?? "" ?>" placeholder="Adresse" style="width:100%;"/>
  Longitude
  <input type="text" id="long" name="long" value="<?= $metadata['long'][0] ?? "" ?>" placeholder="Longitude"/>
  Lattitude
  <input type="text" id="lat" name="lat" value="<?= $metadata['lat'][0] ?? "" ?>" placeholder="Longitude"/>
  <?php
}

?>
