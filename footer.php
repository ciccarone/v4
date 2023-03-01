<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package V4
 */

?>

<style media="screen">
	.footer-widget-area {
		grid-template-columns: <?php echo get_field('footer_column_count', 'option') ?>
	}
</style>

<?php

if (is_active_sidebar('footer-widget')) : ?>
	<div class="v4-footer bg-color__<?php echo get_field('footer_background_color', 'option')['color_names'] ?> py-5 <?php echo get_field('footer_text_color', 'option') ?>">
		<div class="container">
			<div id="footer-widget-area" class="footer-widget-area" role="complementary">
				<?php dynamic_sidebar('footer-widget'); ?>
			</div>
		</div>
	</div>
<?php endif; ?>


<footer id="colophon" class="site-footer">
	<div class="site-info container py-2">
		<?php echo get_field('copyright_content', 'option') ?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>