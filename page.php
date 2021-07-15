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
					echo '<section class="page-section page-section--'.$page_section['acf_fc_layout'].'">';
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
