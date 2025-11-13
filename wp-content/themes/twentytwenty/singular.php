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

            <!-- ✅ Giữ nguyên phần tiêu đề và ngày đăng -->
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
            </header>

            <!-- ✅ CHỈ PHẦN NỘI DUNG BÀI VIẾT DƯỚI DẠNG 3 CỘT -->
            <div class="post-layout-3col">
                
                <!-- Cột trái: Categories -->
                <aside class="post-sidebar-left">
                    <div class="category-box">
                        <h3 class="category-title">Categories</h3>
                        <ul class="category-list">
                            <?php
							$all_categories = get_categories(
								array(
									'hide_empty' => false,
								)
							);

							if ( ! empty( $all_categories ) && ! is_wp_error( $all_categories ) ) {
								$current_categories = wp_get_post_categories( get_the_ID() );

								foreach ( $all_categories as $category ) {
									$is_current = in_array( $category->term_id, $current_categories, true ) ? ' current-category' : '';

									echo '<li class="category-item' . esc_attr( $is_current ) . '"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
								}
							} else {
								echo '<li>' . esc_html__( 'No categories found.', 'twentytwenty' ) . '</li>';
							}
                            ?>
                        </ul>
                    </div>
                </aside>

                <!-- Cột giữa: Nội dung chính -->
                <div class="post-content-area">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->
                    </article><!-- .post -->

                    <footer class="entry-footer">
                        <p class="post-author"><?php echo '(Theo ' . get_the_author() . ')'; ?></p>
                    </footer>
                </div>

                <!-- ✅ CỘT PHẢI (TIN TỨC MỚI NHẤT) -->
                <aside class="post-sidebar-right">
                <div class="widget-box news-box">
                    <ul class="widget-list">
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 3, // hiển thị 3 bài
                            'post_status' => 'publish',
                            'exclude' => get_the_ID() // Loại trừ bài viết hiện tại
                        ));
                        foreach( $recent_posts as $post ) :
                        ?>
                            <li>
                                <div class="news-date">
                                    <div class="date-inner">
                                        <span class="day"><?php echo get_the_date('d', $post['ID']); ?></span>
                                        <span class="divider" aria-hidden="true"></span>
                                        <span class="month"><?php echo get_the_date('m', $post['ID']); ?></span>
                                    </div>
                                    <span class="year"><?php echo get_the_date('y', $post['ID']); ?></span>
                                </div>
                                <div class="news-title">
                                    <a href="<?php echo get_permalink($post['ID']); ?>">
                                        <?php echo esc_html($post['post_title']); ?>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach; wp_reset_query(); ?>
                    </ul>

                    <div class="news-more">
                        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">XEM TẤT CẢ TIN TỨC</a>
                    </div>
                </div>
                </aside>


            </div>
            <!-- ✅ HẾT PHẦN 3 CỘT -->

            <!-- ✅ Giữ nguyên phần Prev/Next & Bình luận -->
            <?php get_template_part( 'template-parts/navigation', 'single' ); ?>

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
