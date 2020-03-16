<?php

function field_social( $post ) {
  $metadata = get_post_meta($post->ID);

  wp_nonce_field('save_pbf_post', 'field_social' );

  ?>
  <p><span class='field-label'>Facebook</span>
    <input type="text" id="facebook" name="facebook" value="<?= $metadata["facebook"][0] ?? ""?>" style="width: 600px;">
  </p>
<?php
global $post_type;
if ($post_type == "participant"):
?>
  <p><span class='field-label'>Instagram</span>
    <input type="text" id="instagram" name="instagram" value="<?= $metadata["instagram"][0] ?? ""?>" style="width: 600px;">
  </p>
  <p><span class='field-label'>Site Web</span>
    <input type="text" id="website" name="website" value="<?= $metadata["website"][0] ?? ""?>" style="width: 600px;">
  </p>
<?php endif; ?>
  <style media="screen">
    .field-label {
      width: 120px;
      display: inline-block;
    }
  </style>
  <?php
}

?>
