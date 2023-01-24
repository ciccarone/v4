<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package V4
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <a href="<?php echo get_the_permalink(); ?>">
        <h2><?php echo get_the_title(); ?></h2>
    </a>

    <div class="entry-meta">
        Written by <?php v4_posted_by(); ?> | <?php echo 'Posted on ' . v4_posted_on(true); ?> <?php echo get_field('post_updated_date') ? ' | Updated on ' . get_field('post_updated_date') : ''; ?>
    </div><!-- .entry-meta -->

    <?php v4_post_thumbnail(); ?>

    <p><?php echo get_the_excerpt(); ?></p>

    <a href="<?php echo get_the_permalink(); ?>" class="btn">Learn More</a>


</article><!-- #post-<?php the_ID(); ?> -->