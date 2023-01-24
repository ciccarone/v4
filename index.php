<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package V4
 */

get_header();

$index_padding = false;
if (!get_field('index_boxed_layout', 'option')) {
	$index_padding = get_field('index_full_layout_padding', 'option')['padding_options_top_bottom'] . ' ' . get_field('index_full_layout_padding', 'option')['padding_options_left_right'];
}

?>
<div class="v4-single <?php echo get_field('index_boxed_layout', 'option') ? 'boxed' : ''; ?> <?php echo $index_padding; ?>">

	<main id="primary" class="site-main">

		<?php
		if (have_posts()) :

			if (is_home() && !is_front_page()) :
		?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
		<?php
			endif;
			v4_adplace('above_index_loop');
			/* Start the Loop */

			echo '<div class="v4-index v4-index__layout--'.get_field('index_layout', 'option').'">';

			while (have_posts()) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */


				get_template_part('template-parts/index', get_post_type());

			endwhile;

			echo '</div>';

			the_posts_navigation();

		else :

			get_template_part('template-parts/content', 'none');

		endif;
		?>

	</main><!-- #main -->

	<?php
	get_sidebar();
	?>
</div>
<?php
	get_footer();
