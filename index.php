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

$index_padding = get_field('index_full_layout_padding', 'option')['padding_options_top_bottom'] . ' ' . get_field('index_full_layout_padding', 'option')['padding_options_left_right'];


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

			$card_classes = get_field('index_layout', 'option') == ('cards' || 'full') ? 'v4-cards v4-cards__count--' . get_field('index_layout_column_count', 'option') . ' grid' : '';
			echo '<div class="v4-index v4-index__layout--'.get_field('index_layout', 'option'). ' ' . $card_classes . ' ">';

			
			while (have_posts()) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */

				switch (get_field('index_layout', 'option')) {
					case 'cards':
						$card_bg_color = get_field('card_background_color', 'option')['color_names'];

						$card_title = v4_heading_generator_default(get_the_ID());

						$card_excerpt = v4_card_excerpt_generator_default(get_the_ID());

						$card_button = v4_button_generator_default(get_the_ID());
						
						$card_image['image_option'] = 'featured';

						echo '<div class="v4-card bg-color__' . $card_bg_color . ' ' . get_field('global_border_radius', ) . '">';
						echo v4_card_image_generator($card_image, get_the_ID());
						$padding_options_top_bottom = get_field('card_padding_padding_options_top_bottom', 'option');
						$padding_options_left_right = get_field('card_padding_padding_options_left_right', 'option');
						echo '<div class="v4-card__content '. $padding_options_top_bottom . ' '. $padding_options_left_right .'">';
						echo $card_title;
						echo $card_excerpt;
						echo $card_button;
						echo '</div>';
						echo '</div>';
						// get_template_part('template-parts/index-post-cards');

						break;

					case 'simple_list':
						get_template_part('template-parts/index', get_post_type());
						break;
					

					case 'full':
						get_template_part('template-parts/index-full');
						break;
					
					default:
						# code...
						break;
				}

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
