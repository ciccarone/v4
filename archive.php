<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package V4
 */

get_header();

$archive_padding = get_field('archive_post_full_layout_padding', 'option')['padding_options_top_bottom'] . ' ' . get_field('archive_post_full_layout_padding', 'option')['padding_options_left_right'];
?>

<div class="v4-archive <?php echo get_field('archive_boxed_layout', 'option') ? 'boxed' : ''; ?> <?php echo $archive_padding; ?>">
	<main id="primary" class="site-main">

		<?php if (have_posts()) : ?>

			<header class="page-header">
				<?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				the_archive_description('<div class="archive-description">', '</div>');
				?>
			</header><!-- .page-header -->

		<?php

			$card_classes = get_field('index_layout', 'option') == ('cards' || 'full') ? 'v4-cards v4-cards__count--' . get_field('index_layout_column_count', 'option') . ' grid' : '';
			echo '<div class="v4-index v4-index__layout--' . get_field('index_layout', 'option') . ' ' . $card_classes . ' ">';
			/* Start the Loop */
			while (have_posts()) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				switch (get_field('index_layout', 'option')) {
					case 'cards':
								
					$cards['count'] = get_field('index_layout_column_count', 'option');
					$cards['limit'] = 12;
					$cards['query'] = false;
					$cards['category'] = false;
					$cards['type'] = false;
					$cards['type_class'] = false;
					$cards['category_condition'] = false;
					$cards['border_radius'] = false;
					?>

					<div class="v4-cards v4-cards__count--<?php echo $cards['count']; ?> grid <?php echo $cards['type_class']; ?>">
						<?php
						echo v4_dynamic_cards($cards);
						?>
					</div>
					<?php 
	
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
	<?php get_sidebar(); ?>
</div>
<?php

get_footer();
