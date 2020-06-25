<?php
function heading_function($atts, $content = null)
{
  ob_start();

  // define attributes and their defaults
  extract(shortcode_atts(array(
    'icon' => '',
  ), $atts));


  $titleLevel = wp_cache_get('titleLevel');

  if ($titleLevel === false) {
    $titleLevel = 3;
  }

  $iconFile = '';

  if ($icon) {
    $iconFile = file_get_contents("assets/" . $icon . ".svg.php", TRUE);
  }
?>
  <h<?= $titleLevel ?> class="title-level"><?= $iconFile . $content ?></h<?= $titleLevel ?>>
<?php
  return ob_get_clean();
}

add_shortcode('heading', 'heading_function');
