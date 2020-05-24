<?php
function listtext_function($atts, $content = null)
{
  ob_start();

  // define attributes and their defaults
  extract(shortcode_atts(array(
    'category' => '',
  ), $atts));

?>
  <ol class="list-text-list">
    <?php
    query_posts(array(
      'category_name'  => $category,
      'posts_per_page' => -1,
      'order' => 'ASC'
    ));
    while (have_posts()) : the_post(); ?>
      <li>
        <div>
          <span class="list-image" role="presentation">
            <?php the_post_thumbnail(); ?>
          </span>
          <p class="title"><?php the_title(); ?></p>
          <?= get_the_content_pbf(); ?>
        </div>
      </li>
    <?php
    endwhile;
    ?>
  </ol>
<?php
  return ob_get_clean();
}

add_shortcode('list-text', 'listtext_function');
