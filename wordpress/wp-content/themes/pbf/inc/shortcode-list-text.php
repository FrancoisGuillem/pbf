<?php
function listtext_function($atts, $content = null)
{
  ob_start();

  // define attributes and their defaults
  extract(shortcode_atts(array(
    'category' => '',
    'ordered' => FALSE
  ), $atts));

  $rootEl = $ordered ? 'ol' : 'ul';

?>
  <div>
    <<?= $rootEl ?> class="list-text-list">
      <?php
      query_posts(array(
        'category_name'  => $category,
        'posts_per_page' => -1,
        'order' => 'ASC'
      ));
      while (have_posts()) : the_post();
        $entryMetadata = get_post_meta(get_the_ID());
        $icon = $entryMetadata["icon"][0] ?? "";

        $iconFile = '';

        if ($icon) {
          $iconFile = @file_get_contents("assets/" . $icon . ".svg.php", TRUE);
        }

        if ($iconFile === FALSE) {
          $iconFile = '';
        }

        $link = get_post_meta(get_the_ID(), "card-link", true);
        $external = ' rel="noopener noreferrer" target="_blank"';

        if ($link && substr($link, 0, 4) !== "http") {
          $external = '';
          $link = get_permalink($link);
        }
      ?>
        <li>
          <div>
            <?php if (has_post_thumbnail()) { ?>
              <?php
              if ($link) { ?>
                <a class="list-text-link" href="<?= $link ?>" <?= $external ?>>
                  <span class="list-image" role="presentation">
                    <?php the_post_thumbnail(); ?>
                  </span>
                </a>
              <?php
              } else {
              ?>
                <span class="list-image" role="presentation">
                  <?php the_post_thumbnail(); ?>
                </span>
            <?php }
            } ?>
            <p class="title"><?= $iconFile . get_the_title(); ?></p>
            <?= get_the_content_pbf(); ?>
          </div>
        </li>
      <?php
      endwhile;
      ?>
    </<?= $rootEl ?>>
  </div>
<?php
  return ob_get_clean();
}

add_shortcode('list-text', 'listtext_function');
