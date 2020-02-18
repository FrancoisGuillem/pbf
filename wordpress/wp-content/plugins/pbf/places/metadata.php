<?php
// Add custom fields
add_action( 'add_meta_boxes', 'meta_box_place' );
function meta_box_place() {
    add_meta_box(
        'meta_box_place',
        __( 'Adresse', 'pbw' ),
        'meta_box_place_content',
        'place',
        'normal',
        'high'
    );
}

function meta_box_place_content( $post ) {
  $val = get_post_meta($post->ID,'address',true);

  wp_nonce_field( plugin_basename( __FILE__ ), 'meta_box_place_content_nonce' );
  echo '<label for="Adresse"></label>';
  echo '<input type="text" id="address" name="address" value="'. $val .'" placeholder="Address" style="width:100%;" onchange="update_map()"/>';
  ?>
  <div class="mapouter">
    <div class="gmap_canvas">
      <iframe width="600" height="500" id="gmap_canvas" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
      <a href="https://www.whatismyip-address.com">moj net</a></div>
      <style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>
    </div>
    <script>
    function update_map() {
      var value = document.getElementById("address").value;
      if (value != "") {
        var url = "https://maps.google.com/maps?q=" + encodeURI(value) + "&t=&z=13&ie=UTF8&iwloc=&output=embed";
        document.getElementById("gmap_canvas").src = url;
      }
    }
    </script>
  <?php
}

add_action( 'save_post', 'meta_box_place_save' );
function meta_box_place_save( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;

  if ( !wp_verify_nonce( $_POST['meta_box_place_content_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }
  if (array_key_exists('address', $_POST)) {
        update_post_meta(
            $post_id,
            'address',
            $_POST['address']
        );
  }
}
?>
