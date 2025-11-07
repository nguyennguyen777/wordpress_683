<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" class="single-post-page">

    <?php
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            ?>

            <!-- Title and Date Wrapper -->
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>

                <div class="post-date">
                    <div class="date-circle">
                        <div class="date-inner">
                            <span class="day"><?php echo get_the_date('d'); ?></span>
                            <span class="divider" aria-hidden="true"></span>
                            <span class="month"><?php echo get_the_date('m'); ?></span>
                        </div>
                        <span class="year"><?php echo get_the_date('y'); ?></span>
                    </div>
                </div>
            </header><!-- .entry-header -->

            <!-- Content -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->
            </article><!-- .post -->

            <!-- Author -->
            <footer class="entry-footer">
                <p class="post-author"><?php echo '(Theo ' . get_the_author() . ')'; ?></p>
            </footer>

            

            <!-- ✅ Phần bài trước / bài sau (chỉ cùng chuyên mục) -->
            <?php
            $next_post = get_next_post( true, '', 'category' );
            $prev_post = get_previous_post( true, '', 'category' );

            if ( $next_post || $prev_post ) :
            ?>
                <nav class="pagination-single section-inner" aria-label="<?php esc_attr_e( 'Post', 'twentytwenty' ); ?>">
                    <hr class="styled-separator is-style-wide" aria-hidden="true" />
                    <div class="pagination-single-inner">
                        <?php if ( $prev_post ) : ?>
                            <a class="previous-post" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                                <span class="arrow" aria-hidden="true">&larr;</span>
                                <span class="title"><span class="title-inner"><?php echo wp_kses_post( get_the_title( $prev_post->ID ) ); ?></span></span>
                            </a>
                        <?php endif; ?>

                        <?php if ( $next_post ) : ?>
                            <a class="next-post" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                                <span class="arrow" aria-hidden="true">&rarr;</span>
                                <span class="title"><span class="title-inner"><?php echo wp_kses_post( get_the_title( $next_post->ID ) ); ?></span></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <hr class="styled-separator is-style-wide" aria-hidden="true" />
                </nav>
            <?php endif; ?>

			<!-- ✅ Phần bình luận -->
            <?php
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
            ?>
            <?php
        } // end while
    } // end if
    ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
