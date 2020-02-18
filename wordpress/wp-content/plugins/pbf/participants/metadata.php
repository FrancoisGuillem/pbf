<?php
// Add custom fields
// add_action( 'add_meta_boxes', 'product_price_box' );
// function product_price_box() {
//     add_meta_box(
//         'product_price_box',
//         __( 'Product Price', 'pbw' ),
//         'product_price_box_content',
//         'participant',
//         'side',
//         'high'
//     );
// }
//
// function product_price_box_content( $post ) {
//   $val = get_post_meta($post->ID,'product_price',true);
//
//   wp_nonce_field( plugin_basename( __FILE__ ), 'product_price_box_content_nonce' );
//   echo '<label for="product_price"></label>';
//   echo '<input type="text" id="product_price" name="product_price" value="'. $val .'" placeholder="enter a price" />';
// }
//
// add_action( 'save_post', 'product_price_box_save' );
// function product_price_box_save( $post_id ) {
//   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
//   return;
//
//   if ( !wp_verify_nonce( $_POST['product_price_box_content_nonce'], plugin_basename( __FILE__ ) ) )
//   return;
//
//   if ( 'page' == $_POST['post_type'] ) {
//     if ( !current_user_can( 'edit_page', $post_id ) )
//     return;
//   } else {
//     if ( !current_user_can( 'edit_post', $post_id ) )
//     return;
//   }
//   $product_price = $_POST['product_price'];
//   update_post_meta( $post_id, 'product_price', $product_price );
// }
// ?>
