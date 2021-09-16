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
					$color_div = false;
					$section_buttons = $page_section['button_repeater'] ? fmg_button_generator($page_section['button_repeater']) : false;
					$section_bg = isset($page_section['section_background_color_color_names']) ? 'bg-color__'.$page_section['section_background_color_color_names'] : '';
					$section_text_color = isset($page_section['section_text_color']) ? $page_section['section_text_color'] : '';
					$section_bg_image = isset($page_section['section_background_image']) ? 'style="background-image:url('.$page_section['section_background_image']['sizes']['large'].')"' : false;
					$section_padding = isset($page_section['section_padding']) ? $page_section['section_padding'] : '';
					if ($overlay_color = $page_section['section_background_color_overlay']) {
						list($r, $g, $b) = sscanf($overlay_color, "#%02x%02x%02x");
						$color_div = '<div class="color_overlay" style="background-color: rgba('.$r.','.$g.','.$b.','.$page_section['section_background_color_overlay_opacity'].')"></div>';
					}
					echo '<section class="page-section page-section--'.$page_section['acf_fc_layout'].' '.$section_bg.' '. $section_padding . ' ' .$section_text_color .'" ' . $section_bg_image.'>';
					include( locate_template( 'template-parts/fmg-'.$page_section['acf_fc_layout'].'.php', false, false ) );
					echo $color_div;
					echo '</section>';

				}
			}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
