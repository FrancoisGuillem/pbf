<?php
function mappreview_function($atts, $content = null)
{
  ob_start();

  // define attributes and their defaults
  extract(shortcode_atts(array(
    'url' => '',
  ), $atts));

?>
  <div class="map-preview">
    <iframe src="<?= $url ?>" width="640" height="480"></iframe>
  </div>
<?php
  return ob_get_clean();
}

add_shortcode('map-preview', 'mappreview_function');
