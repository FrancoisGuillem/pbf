<?php
function staticmap_function($atts, $content = null)
{
  ob_start();

  // define attributes and their defaults
  extract(shortcode_atts(array(
    'icon' => '',
    'title' => ''
  ), $atts));

?>
  <section class="static-map">
    <?= do_shortcode($content) ?>
  </section>
<?php
  return ob_get_clean();
}

add_shortcode('static-map', 'staticmap_function');
