<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FMG
 */

?>

	<style media="screen">
		.footer-widget-area {
			grid-template-columns: <?php echo get_field('footer_column_count', 'option') ?>
		}
	</style>
	<div class="fmg-footer">
		<div class="container">
			<?php

			if ( is_active_sidebar( 'footer-widget' ) ) : ?>
			    <div id="footer-widget-area" class="footer-widget-area" role="complementary">
			    <?php dynamic_sidebar( 'footer-widget' ); ?>
			    </div>

			<?php endif; ?>
		</div>
	</div>

	<footer id="colophon" class="site-footer">
		<div class="site-info container">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fmg' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'fmg' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'fmg' ), 'fmg', '<a href="http://underscores.me/">Tony Ciccarone</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
