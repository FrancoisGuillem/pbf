<?php

function field_partner_level( $post ) {
  $metadata = get_post_meta($post->ID);
  $level = $metadata["partner_level"][0] ?? 4;
  wp_nonce_field('save_pbf_post', 'field_partner_level' );

?>
<p>
  <input type="number" id="partner_level" name="partner_level" value="<?= $level; ?>" min="1" max="4" style="width:100px;">
  Nombre entre 1 et 4 indiquant la rangée dans laquelle le partenaire apparait sur la home page
</p>
<?php
}
?>
