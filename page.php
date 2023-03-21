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
 * @package V4
 */

get_header();
?>

<main id="primary" class="site-main <?php echo v4_retrieve_overlay_header_boolean() ?>">

	<?php
	while (have_posts()) :
		the_post();

		if ($page_sections = get_field('page_sections')) {
			// var_dump($page_sections);
			foreach ($page_sections as $page_section) {
				$color_div = false;
				$section_bg = false;
				$section_border_radius = false;
				$section_headings = false;
				$section_buttons = false;


				if (isset($page_section['button_repeater'])) {
					$section_buttons = $page_section['button_repeater'] ? v4_button_generator($page_section['button_repeater'], $page_section['button_repeater_alignment']) : false;
				}

				if (isset($page_section['heading_repeater'])) {
					$section_headings = $page_section['heading_repeater'] ? v4_heading_generator($page_section['heading_repeater']) : false;
				}

				if (isset($page_section['image_file'])) {
					$section_image = $page_section['image_file'] ? v4_image_generator($page_section['image_file'], $page_section['image_size']) : false;
				}

				if (isset($page_section['text_repeater'])) {
					$section_texts = $page_section['text_repeater'] ? v4_text_generator($page_section['text_repeater']) : false;
				}
				
				$section_bg = isset($page_section['section_background_color']['color_names']) ? 'bg-color__' . $page_section['section_background_color']['color_names'] : '';

				$section_bg_attachment = $page_section['section_background_image_parallax'] ? 'bg-attachment--parallax' : '';

				$section_width = 'section-width--' . $page_section['section_width'];

				$section_text_color = isset($page_section['section_text_color']) ? $page_section['section_text_color'] : '';

				$section_bg_image = (isset($page_section['section_background_image']) && ($page_section['section_background_image'])) ? 'style="background-image:url(' . $page_section['section_background_image']['sizes']['large'] . ')"' : false;

				$section_padding_tb = isset($page_section['padding_options_top_bottom']) ? $page_section['padding_options_top_bottom'] : '';

				$section_padding_lr = isset($page_section['padding_options_left_right']) ? $page_section['padding_options_left_right'] : '';

				$section_margin = isset($page_section['section_margin']) ? $page_section['section_margin'] : '';
				//
				// $section_border_radius = !empty($page_section['section_border_radius']) ? 'global_border_radius' : '';

				if ($overlay_color = isset($page_section['color_names'])) {
					list($r, $g, $b) = sscanf(get_field('color_map_' . $page_section['color_names'], 'option')['color_selector'], "#%02x%02x%02x");

					$color_div = '<div class="color_overlay" style="background-color: rgba(' . $r . ',' . $g . ',' . $b . ',' . $page_section['section_background_color_overlay_opacity'] . ')"></div>';
				}

				echo '<section class="page-section page-section--' . $page_section['acf_fc_layout'] . ' ' . $section_bg . ' ' . $section_bg_attachment . ' ' . $section_padding_tb . ' ' . $section_padding_lr . ' ' . $section_margin . ' ' . $section_text_color . '" ' . $section_bg_image . '>';

				echo '<div class="' . $section_width . '"><div id="primary">';

				if ((isset($page_section['section_title'])) && ($page_section['section_title'])) {
					echo '<div class="container"><h3 class="mb-4">' . $page_section['section_title'] . '</h3></div>';
				}
				// var_dump($page_section['acf_fc_layout']);

				include(locate_template('template-parts/v4-' . $page_section['acf_fc_layout'] . '.php', false, false));

				if ($page_section['section_background_color_overlay_opacity']) {
					echo $color_div;
				}

				echo '</div>';

				if (isset($page_section['section_sidebar'])) {

					if ($page_section['section_sidebar'] !== 'none') {



						$sidebar_padding_top_bottom = get_field('sidebar_padding_padding_options_top_bottom', 'option');
						$sidebar_padding_left_right = get_field('sidebar_padding_padding_options_left_right', 'option');
						$sidebar_text_color = get_field('sidebar_text_color', 'option')['color_names']; ?>


						<div class="sidebar__container">
							<aside class="secondary text-<?php echo $sidebar_text_color; ?> widget-area <?php echo $sidebar_padding_top_bottom; ?>  <?php echo $sidebar_padding_left_right; ?> " id="acf_fc_layout_<?php echo $page_section['acf_fc_layout']; ?>">
								<div class="sidebar__inner">
									<?php v4_adplace('before_sidebar_widgets'); ?>

									<?php dynamic_sidebar($page_section['section_sidebar']); ?>

									<?php v4_adplace('after_sidebar_widgets'); ?>
								</div>
							</aside>
						</div>
						<?php
						if ($page_section['section_sidebar_sticky'] === "UNUSED") { ?>
							<script src="<?php echo get_template_directory_uri() ?>'/js/sticky.js'"></script>
							<script type="text/javascript">
								mastheadElement = document.querySelector("#masthead");
								elemHeight = mastheadElement.offsetHeight;

								var sidebar = new StickySidebar('#acf_fc_layout_<?php echo $page_section['acf_fc_layout']; ?>', {
									topSpacing: elemHeight + 20,
									bottomSpacing: elemHeight,
									containerSelector: '.section-width--boxed',
									innerWrapperSelector: '.sidebar__container'
								});
							</script>
	<?php }
						echo '</div>';
					}
				}
				echo '</section>';
			}
		} else {
			echo '<div class="container pt-4">';
			echo the_content();
			echo '</div>';
		}

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php

// echo the_content();
// get_sidebar();
get_footer();
