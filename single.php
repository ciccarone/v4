<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package V4
 */

get_header();
?>

<div class="v4-single <?php echo get_field('single_post_boxed_layout', 'option') ? 'boxed' : '';?>">
	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			if ($product_name = get_field('product_name')) {
				echo $product_name;
			}

			if ($star_rating = get_field('star_rating')) {
				echo generate_star_rating($star_rating);
			}

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'v4' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'v4' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	<?php

get_sidebar();
?>
</div>
<?php
get_footer();
