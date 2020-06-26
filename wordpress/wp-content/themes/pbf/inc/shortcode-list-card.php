<?php
function listcard_function($atts, $content = null)
{
  ob_start();

  // define attributes and their defaults
  extract(shortcode_atts(array(
    'category' => '',
  ), $atts));

  query_posts(array(
    'category_name'  => $category,
    'posts_per_page' => 3,
    'order' => 'ASC'
  ));
?>

  <div class="list-card" data-bind="scroll-slider">
    <div class="list-card-wrapper">
      <ul>
        <?php
        while (have_posts()) : the_post();
          $cardMetadata = get_post_meta(get_the_ID());
          $link = $cardMetadata["card-link"][0] ?? "";

          if (substr($link, 0, 4) !== "http") {
            $link = get_permalink($link);
          }
        ?>
          <li>
            <a class="card" href="<?= $link ?>">
              <span class="card-image">
                <?php the_post_thumbnail('medium'); ?>
              </span>
              <span class="label"><?php the_title(); ?></span>
            </a>
          </li>
        <?php
        endwhile;
        ?>
      </ul>
    </div>
    <ul class="list-card-index" role="presentation">
      <?php
      while (have_posts()) : the_post();
      ?>
        <li></li>
      <?php
      endwhile;
      ?>

    </ul>
  </div>
<?php
  return ob_get_clean();
}

add_shortcode('list-card', 'listcard_function');
