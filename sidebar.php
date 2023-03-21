<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package V4
 */

if (!is_active_sidebar('sidebar-1') || !get_field('show_sidebar_globally', 'option')) {
	return;
}

$sidebar_padding_top_bottom = get_field('sidebar_padding_padding_options_top_bottom', 'option');
$sidebar_padding_left_right = get_field('sidebar_padding_padding_options_left_right', 'option');
$sidebar_text_color = get_field('sidebar_text_color', 'option')['color_names'];
?>



<aside id="secondary" class="text-<?php echo $sidebar_text_color;?> widget-area <?php echo $sidebar_padding_top_bottom; ?>  <?php echo $sidebar_padding_left_right; ?> ">

	<?php v4_adplace('before_sidebar_widgets'); ?>

	<?php
	if (get_field('show_product_summary')) {
		echo '<div class="product-summary">';
		if ($what_we_like = get_field('what_we_like')) {
			echo '<strong>' . __("What We Like") . '</strong>';
			echo $what_we_like;
		}
		if ($what_we_dont_like = get_field('what_we_dont_like')) {
			echo '<strong>' . __("What We Don't Like") . '</strong>';
			echo $what_we_dont_like;
		}
		if ($bottom_line = get_field('bottom_line')) {
			echo '<strong>' . __("Bottom Line") . '</strong>';
			echo $bottom_line;
		}
		if (get_field('show_lasso')) {
			echo do_shortcode('[lasso ref="amazon" id="6121" link_id="129"]');
		}

		echo '</div>';
	}
	?>
	<?php dynamic_sidebar('sidebar-1'); ?>

	<?php v4_adplace('after_sidebar_widgets'); ?>
</aside><!-- #secondary -->
