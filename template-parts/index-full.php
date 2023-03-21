<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package V4
 */
$padding_options_top_bottom = get_field('card_content_padding_padding_options_top_bottom', 'option');
$padding_options_left_right = get_field('card_content_padding_padding_options_left_right', 'option');
$color_div = false;
if ($overlay_color = null !== get_field('card_full_background_overlay_color', 'option')) {
    list($r, $g, $b) = sscanf(get_field('color_map_' . get_field('card_full_background_overlay_color', 'option')['color_names'], 'option')['color_selector'], "#%02x%02x%02x");

    $color_div = '<div class="color_overlay" style="background-color: rgba(' . $r . ',' . $g . ',' . $b . ',' . get_field('card_full_background_color_overlay_opacity', 'option') . ')"></div>';
}

$card_text_color = get_field('card_full_text_color', 'option');
$card_title = v4_heading_generator_default(get_the_ID());
$card_excerpt = v4_card_excerpt_generator_default(get_the_ID());

// var_dump(get_field());

?>

<a id="post-<?php the_ID(); ?>" <?php post_class(['text-' . $card_text_color['color_names']]); ?> href="<?php echo get_the_permalink(); ?>">

    <div class="full-card <?php echo $padding_options_top_bottom . ' ' . $padding_options_left_right; ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
        <div class="full-card__inner">
            <?php echo $card_title; ?>
            <div class="entry-meta">
                Written by <?php v4_posted_by_no_link(false); ?> | <?php echo 'Posted on ' . v4_posted_on_no_link(true); ?> <?php echo get_field('post_updated_date') ? ' | Updated on ' . get_field('post_updated_date') : ''; ?>
            </div><!-- .entry-meta -->
            <?php echo $card_excerpt; ?>


        </div>
        <?php

        if (null !== get_field('card_full_background_overlay_color', 'option')) {
            echo $color_div;
        }
        ?>
    </div>
</a><!-- #post-<?php the_ID(); ?> -->