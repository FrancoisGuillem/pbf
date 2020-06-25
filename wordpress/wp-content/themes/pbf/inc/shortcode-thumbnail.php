<?php
function thumbnail_function($atts, $content = null)
{
  ob_start();

  // define attributes and their defaults
  extract(shortcode_atts(array(
    'size' => [],
  ), $atts));

  if (!is_array($size)) {
    $sizes = explode(",", $size);

    if (count($sizes) > 1) {
      $size = $sizes;
    }
  }

?>
  <span class="image-wrapper">
    <?php the_post_thumbnail($size); ?>
  </span>
<?php
  return ob_get_clean();
}

add_shortcode('thumbnail', 'thumbnail_function');
