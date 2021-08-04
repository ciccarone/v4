<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FMG
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			if ($page_sections = get_field('page_sections')) {
				// var_dump($page_sections);
				foreach ($page_sections as $page_section) {
					$section_bg = isset($page_section['section_background_color_color_names']) ? 'bg-color__'.$page_section['section_background_color_color_names'] : '';
					$section_bg_image = isset($page_section['section_background_image']) ? 'style="background-image:url('.$page_section['section_background_image']['sizes']['large'].')"' : false;
					$section_padding = isset($page_section['section_padding']) ? $page_section['section_padding'] : '';
					echo '<section class="page-section page-section--'.$page_section['acf_fc_layout'].' '.$section_bg.' '. $section_padding . '" ' . $section_bg_image.'>';
					include( locate_template( 'template-parts/fmg-'.$page_section['acf_fc_layout'].'.php', false, false ) );

					echo '</section>';

				}
			}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
