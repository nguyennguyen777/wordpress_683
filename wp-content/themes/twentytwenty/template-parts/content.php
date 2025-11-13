<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
//////////////////////
// $class = '';
// if (!is_single()) {
// 	$class = 'danh-sach';
// }
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <?php if ( is_singular() ) : ?>

    <?php
    get_template_part( 'template-parts/entry-header' );

    if ( ! is_search() ) {
        get_template_part( 'template-parts/featured-image' );
    }
    ?>

    <div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

        <div class="entry-content">

            <?php
            if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
                the_excerpt();
            } else {
                the_content( __( 'Continue reading', 'twentytwenty' ) );
            }
            ?>

        </div><!-- .entry-content -->
    </div><!-- .post-inner -->

	<!--Prev/Next Post-->
	<div class="post-navigation-wrapper">
		<?php get_template_part( 'template-parts/navigation' );?>
	</div>

    <?php else : ?>

    <div class="post-list-row">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('medium'); ?>
				</a>
			</div>
		<?php endif; ?>
        <div class="post-date-badge">
            <div class="post-date-day"><?php echo get_the_date( 'd' ); ?></div>
            <div class="post-date-month">THÁNG <?php echo get_the_date( 'm' ); ?></div>
        </div>
        <div class="post-list-content">
            <h2 class="entry-title heading-size-1"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
            <?php
			$excerpt = get_the_excerpt();
			$excerpt = mb_substr( $excerpt, 0, 100 ) . '[...]'; // chỉ lấy 120 ký tự đầu
			?>
			<div class="entry-excerpt"><?php echo wp_kses_post( wpautop( $excerpt ) ); ?></div>


        </div>
    </div>

    <?php endif; ?>

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		/* removed edit post link under each post list item */

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/*
	 * Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
