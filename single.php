<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package V4
 */

get_header();

$single_post_padding = false;

$single_post_padding = get_field('single_post_full_layout_padding', 'option')['padding_options_top_bottom'] . ' ' . get_field('single_post_full_layout_padding', 'option')['padding_options_left_right'];


?>

<div class="v4-single <?php echo get_field('single_post_boxed_layout', 'option') ? 'boxed' : ''; ?> <?php echo $single_post_padding; ?>">
	<main id="primary" class="site-main">

		<?php
		while (have_posts()) :
			the_post();
		?>
			<header class="entry-header">
				<?php
				if (is_singular()) :
					the_title('<h1 class="entry-title">', '</h1>');
				else :
					the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
				endif;

				if ('post' === get_post_type()) :
				?>
					<div class="entry-meta">
						Written by <?php v4_posted_by(); ?> | <?php echo 'Posted on ' . v4_posted_on(true); ?> <?php echo get_field('post_updated_date') ? 'Updated on ' . get_field('post_updated_date') : '';
						echo '<br />';
						echo 'Category: ' . get_primary_category(get_the_category()); ?>

						<?php
						if ($reviewer = get_field('reviewer')) {
							echo '<br />';
							echo 'Reviewed by ' . '<a href="/author/' . $reviewer['user_nicename'] . '">' . $reviewer['display_name'] . '</a>';
							if ($cute_name = get_field('author_cute_name', 'user_' . $reviewer['ID'])) {
								echo ' / ' . $cute_name;
							}
						}
						if (get_field('product_name')) {
							if ($global_review_blurb = get_field('global_review_blurb', 'option')) {
								echo '<p id="global-review-blurb">' . $global_review_blurb . '</p>';
							}
							if ($global_affiliate_disclosure = get_field('global_affiliate_disclosure', 'option')) {
								echo '<div id="global-affiliate-disclosure" style="display:none;max-width:768px;">' . $global_affiliate_disclosure . '</div>';
							}
						}

						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		<?php

			if ($star_rating = get_field('star_rating')) {
				echo generate_star_rating($star_rating);
			}

			get_template_part('template-parts/content', get_post_type());

			if (get_field('post_updated_date') && (get_field('updated_by'))) {
				if ($update_text = get_field('update_text')) {
					echo '<div class="v4-update-box py-4">';
					
					$userdata = get_user_meta(get_field('updated_by')["ID"]);
					$user_text = (($update_text == 'bio') ? $userdata['description'][0] : get_field('update_custom_text'));
					$user_name = get_field('updated_by')["display_name"];

					$update_blurb = '<strong>Updated on ' . get_field('post_updated_date') . ', by ' . $user_name . ': </strong>' . $user_text;
					echo '<i>'.$update_blurb.'</i>';

					echo '</div>';
				}
			}


			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'v4') . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'v4') . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
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
