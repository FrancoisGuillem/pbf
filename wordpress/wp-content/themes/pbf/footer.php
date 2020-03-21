<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<?php if (!is_page_template('blank-page.php') && !is_page_template('blank-page-with-container.php')) : ?>
  </main>
  <?php get_template_part('footer-widget'); ?>
  <footer class="site-footer" role="contentinfo">
    <div class="container footer-content">
        <div class="footer-desc">
            <img src="" alt="Logo Paris Beer Festival" width="74" height="64" />
            <p><?php _e("[:fr]Du 25 avril au 3 mai 2020, une semaine entière consacrée à la bière artisanale en Île-de-France.
                      [:en]English description[:]"); ?></p>
        </div>
        <?php
                wp_nav_menu(array(
                  'theme_location'    => 'footer-menu',
                  'container'       => 'div',
                  'container_class' => '',
                  'menu_id'         => false,
                  'menu_class'      => 'footer-nav',
                  'depth'           => 3,
                  'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                  'walker'          => new wp_bootstrap_navwalker()
                ));
                ?>
        <div class="footer-asso">
            <?php _e("[:fr]Un évenement
                      [:en]An event by[:]"); ?>
            <img src="" alt="Logo Paris Beer Club"  width="123" height="56" />
        </div>
    </div>
    <div class="colophon">
        <div class="container">
            <?php
                wp_nav_menu(array(
                  'theme_location'    => 'reseaux-sociaux',
                  'container'       => 'div',
                  'container_class' => '',
                  'menu_id'         => false,
                  'menu_class'      => 'reseaux-sociaux',
                  'depth'           => 3,
                  'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                  'walker'          => new wp_bootstrap_navwalker()
                ));
                ?>
            <span class="footer-copyright">&copy; <?php echo date('Y'); ?> Paris Beer Club</span>
        </div>
    </div>
  </footer>
<?php endif; ?>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/script.js" />
<?php wp_footer(); ?>
</body>

</html>
