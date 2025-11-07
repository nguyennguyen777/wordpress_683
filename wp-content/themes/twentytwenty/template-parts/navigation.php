<?php
/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$next_post = get_next_post(true, '', 'category');
$prev_post = get_previous_post(true, '', 'category');

if ($next_post || $prev_post) : ?>
    <nav class="pagination-single section-inner" aria-label="<?php esc_attr_e('Post', 'twentytwenty'); ?>">
        <div class="pagination-simple-column">

            <?php if ($prev_post) : ?>
                <a class="nav-item" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                    <div class="nav-date">
                        <div class="date-inner">
                            <span class="day"><?php echo get_the_date('d', $prev_post->ID); ?></span>
                            <span class="divider" aria-hidden="true"></span>
                            <span class="month"><?php echo get_the_date('m', $prev_post->ID); ?></span>
                        </div>
                        <span class="year"><?php echo get_the_date('y', $prev_post->ID); ?></span>
                    </div>
                    <div class="nav-title"><?php echo wp_kses_post(get_the_title($prev_post->ID)); ?></div>
                </a>
            <?php endif; ?>

            <?php if ($next_post) : ?>
                <a class="nav-item" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                    <div class="nav-date">
                        <div class="date-inner">
                            <span class="day"><?php echo get_the_date('d', $next_post->ID); ?></span>
                            <span class="divider" aria-hidden="true"></span>
                            <span class="month"><?php echo get_the_date('m', $next_post->ID); ?></span>
                        </div>
                        <span class="year"><?php echo get_the_date('y', $next_post->ID); ?></span>
                    </div>
                    <div class="nav-title"><?php echo wp_kses_post(get_the_title($next_post->ID)); ?></div>
                </a>
            <?php endif; ?>

        </div>
    </nav>
<?php endif; ?>