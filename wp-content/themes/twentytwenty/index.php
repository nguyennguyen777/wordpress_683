<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	if ( is_search() ) {
		/**
		 * @global WP_Query $wp_query WordPress Query object.
		 */
		global $wp_query;

		// $archive_title = sprintf(
		// 	'%1$s %2$s',
		// 	'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
		// 	'&ldquo;' . get_search_query() . '&rdquo;'
		// );

		if ( $wp_query->found_posts ) {
			// $archive_subtitle = sprintf(
			// 	/* translators: %s: Number of search results. */
			// 	// _n(
			// 	// 	'We found %s result for your search.',
			// 	// 	'We found %s results for your search.',
			// 	// 	$wp_query->found_posts,
			// 	// 	'twentytwenty'
			// 	// ),
			// 	number_format_i18n( $wp_query->found_posts )
			// );
		} else {
			$archive_title = sprintf(
		 	'%1$s %2$s',
		 	'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
		 	'&ldquo;' . get_search_query() . '&rdquo;'
			);

			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
		}
	} elseif ( is_archive() && ! have_posts() ) {
		$archive_title = __( 'Nothing Found', 'twentytwenty' );
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ( $archive_title || $archive_subtitle ) {
		?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ( $archive_title ) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php } ?>

				<?php if ( $archive_subtitle ) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
				<?php } ?>

			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

		<?php
	}

	// Module 4: Search Form - LUÔN hiển thị trên trang search (cả khi có và không có kết quả)
	if ( is_search() ) {
		?>
		<div class="search-form-module section-inner medium">
			<?php
			get_search_form(
				array(
					'aria_label' => __( 'Search', 'twentytwenty' ),
				)
			);
			?>
		</div><!-- .search-form-module -->
		<?php
	}

	if ( have_posts() ) {
		?>
		
		<div class="archive-layout-wrapper">
			<!-- Cột trái: Module 13 (Pages) cho trang search, Xem nhiều cho trang khác -->
			<aside class="archive-sidebar-left">
				<?php if ( is_search() && is_active_sidebar( 'sidebar-13' ) ) : ?>
					<!-- Hiển thị Module 13 (Pages widget) trên trang search -->
					<?php dynamic_sidebar( 'sidebar-13' ); ?>
				<?php else : ?>
					<!-- Hiển thị "Xem nhiều" cho các trang khác (archive, home) -->
					<div class="most-viewed-box">
						<h2 class="most-viewed-title">Xem nhiều</h2>
						<div class="most-viewed-content">
							<?php
							// Lấy 8 bài viết mới nhất (theo ngày tháng)
							$most_viewed = new WP_Query(array(
								'posts_per_page' => 8,
								'post_status' => 'publish',
								'orderby' => 'date', // Sắp xếp theo ngày đăng (bài viết mới nhất)
								'order' => 'DESC'
							));
							
							if ( $most_viewed->have_posts() ) {
								$post_count = 0;
								echo '<div class="most-viewed-columns">';
								echo '<div class="most-viewed-col-left">';
								
								while ( $most_viewed->have_posts() ) {
									$most_viewed->the_post();
									$post_count++;
									
									if ( $post_count == 5 ) {
										echo '</div><div class="most-viewed-divider"></div><div class="most-viewed-col-right">';
									}
									?>
									<div class="most-viewed-item">
										<span class="most-viewed-number"><?php echo $post_count; ?></span>
										<a href="<?php echo esc_url( get_permalink() ); ?>" class="most-viewed-link">
											<?php the_title(); ?>
										</a>
										<?php if ( get_comments_number() > 0 ) : ?>
											<span class="most-viewed-comments">
												<span class="comment-icon">💬</span>
												<?php echo get_comments_number(); ?>
											</span>
										<?php endif; ?>
									</div>
									<?php
								}
								
								echo '</div></div>';
								wp_reset_postdata();
							}
							?>
						</div>
					</div>
				<?php endif; ?>
			</aside>
			
			<!-- Cột giữa: Danh sách bài viết -->
			<div class="archive-posts-content">
				<?php
				$i = 0;

				while ( have_posts() ) {
					++$i;
					if ( $i > 1 ) {
						echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
					}
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

				}
				?>
			</div>
			
			<!-- Cột phải: Danh sách comment -->
			<aside class="archive-sidebar-right">
				<div class="comments-sidebar-box">
					<h2 class="comments-sidebar-title">Comments</h2>
					<ul class="comments-sidebar-list">
						<?php
						// Lấy 3 comments mới nhất
						$recent_comments = get_comments(array(
							'number' => 3,
							'status' => 'approve',
							'post_status' => 'publish',
							'orderby' => 'comment_date',
							'order' => 'DESC'
						));
						
						if ( ! empty( $recent_comments ) ) {
							foreach ( $recent_comments as $comment ) {
								$comment_text = wp_trim_words( $comment->comment_content, 10, '...' );
								$comment_link = get_comment_link( $comment );
								?>
								<li class="comments-sidebar-item">
									<a href="<?php echo esc_url( $comment_link ); ?>" class="comments-sidebar-link">
										<?php echo esc_html( $comment_text ); ?>
									</a>
								</li>
								<?php
							}
						} else {
							echo '<li class="comments-sidebar-item">Chưa có bình luận nào.</li>';
						}
						?>
					</ul>
				</div>
			</aside>
		</div>
		
		<?php
		// Module 15: Hiển thị dưới layout 3 cột khi search có kết quả
		if ( is_search() && is_active_sidebar( 'sidebar-15' ) ) {
			?>
			<div class="search-module-15 section-inner medium">
				<?php dynamic_sidebar( 'sidebar-15' ); ?>
			</div><!-- .search-module-15 -->
			<?php
		}
		?>
		
		<?php
	} elseif ( is_search() ) {
		// Khi search không có kết quả, chỉ hiển thị thông báo (Module 4 đã hiển thị ở trên)
		?>
		<div class="no-search-results-message section-inner thin">
			<p><?php _e( '', 'twentytwenty' ); ?></p>
		</div><!-- .no-search-results-message -->
		<?php
	}
	?>

	<?php get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
