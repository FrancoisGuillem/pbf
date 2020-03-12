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
  <footer id="colophon" class="site-footer" role="contentinfo">
    <p>
      &copy; <?php echo date('Y'); ?> <?php echo '<a href="' . home_url() . '">' . get_bloginfo('name') . '</a>'; ?>
    </p>
  </footer>
<?php endif; ?>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/script.js" />
<?php wp_footer(); ?>
</body>

</html>
