<?php
/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
echo '<!-- Navigation loaded here -->';
$next_post = get_next_post(true, '', 'category');
$prev_post = get_previous_post(true, '', 'category');

if ($next_post || $prev_post) : ?>
    <nav class="pagination-single section-inner" aria-label="<?php esc_attr_e('Post', 'twentytwenty'); ?>">
        <div class="pagination-single-inner simple-prev-next">

            <?php if ($prev_post) : ?>
                <a class="previous-post simple-nav-item" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                    <div class="date-block">
                        <div class="day"><?php echo get_the_date('d', $prev_post->ID); ?></div>
                        <div class="month"><?php echo get_the_date('m', $prev_post->ID); ?></div>
                        <div class="year"><?php echo get_the_date('y', $prev_post->ID); ?></div>
                    </div>
                    <div class="title"><?php echo wp_kses_post(get_the_title($prev_post->ID)); ?></div>
                </a>
            <?php endif; ?>

            <?php if ($next_post) : ?>
                <a class="next-post simple-nav-item" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                    <div class="date-block">
                        <div class="day"><?php echo get_the_date('d', $next_post->ID); ?></div>
                        <div class="month"><?php echo get_the_date('m', $next_post->ID); ?></div>
                        <div class="year"><?php echo get_the_date('y', $next_post->ID); ?></div>
                    </div>
                    <div class="title"><?php echo wp_kses_post(get_the_title($next_post->ID)); ?></div>
                </a>
            <?php endif; ?>

        </div>
    </nav>
<?php endif; ?>
