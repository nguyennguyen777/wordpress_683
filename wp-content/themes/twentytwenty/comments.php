<?php
/**
 * The template file for displaying the comments and comment form for the
 * Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}

// Lấy danh sách comments
$comments = get_comments( array(
	'post_id' => get_the_ID(),
	'status'  => 'approve',
	'order'   => 'DESC',
) );

// Lấy ID tác giả bài viết
$post_author_id = get_the_author_meta( 'ID' );

$commenter          = wp_get_current_commenter();
$require_name_email = (bool) get_option( 'require_name_email' );
$aria_required_attr = $require_name_email ? ' aria-required="true" required' : '';
$required_indicator = $require_name_email ? ' <span class="required">*</span>' : '';

$comment_field_markup  = '<div class="comment-form-inner">';
$comment_field_markup .= '<div class="make-post-tab">Make a Post</div>';
$comment_field_markup .= '<div class="comment-textarea-wrapper">';
$comment_field_markup .= '<textarea id="comment" name="comment" placeholder="What are you thinking..." aria-required="true"></textarea>';
$comment_field_markup .= '<div class="form-submit-wrapper-inline"><input name="submit" type="submit" id="submit" class="submit share-btn" value="share" /></div>';
$comment_field_markup .= '</div>';

if ( ! is_user_logged_in() ) {
	$comment_field_markup .= '<div class="comment-extra-fields">';
	$comment_field_markup .= '<div class="comment-extra-field comment-form-author">';
	$comment_field_markup .= '<label for="author">' . esc_html__( 'Name', 'twentytwenty' ) . $required_indicator . '</label>';
	$comment_field_markup .= '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Your name', 'twentytwenty' ) . '"' . $aria_required_attr . ' />';
	$comment_field_markup .= '</div>';
	$comment_field_markup .= '<div class="comment-extra-field comment-form-email">';
	$comment_field_markup .= '<label for="email">' . esc_html__( 'Email', 'twentytwenty' ) . $required_indicator . '</label>';
	$comment_field_markup .= '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Your email', 'twentytwenty' ) . '"' . $aria_required_attr . ' />';
	$comment_field_markup .= '</div>';
	$comment_field_markup .= '</div>';
}

$comment_field_markup .= '</div>';

// Hiển thị danh sách comments
if ( ! empty( $comments ) ) {
	?>
	<div class="comments-feed" id="comments">
		<?php
		foreach ( $comments as $comment ) {
			$comment_author_id = $comment->user_id;
			$is_author = ( $comment_author_id && $comment_author_id == $post_author_id );
			
			// Format ngày tháng theo tiếng Việt
			$comment_timestamp = strtotime( $comment->comment_date );
			$day = date( 'j', $comment_timestamp );
			$month_num = date( 'n', $comment_timestamp );
			$year = date( 'Y', $comment_timestamp );
			$time = date_i18n( 'g:i a', $comment_timestamp );
			
			// Chuyển số tháng sang tiếng Việt
			$months_vi = array(
				1 => 'một', 2 => 'hai', 3 => 'ba', 4 => 'tư',
				5 => 'năm', 6 => 'sáu', 7 => 'bảy', 8 => 'tám',
				9 => 'chín', 10 => 'mười', 11 => 'mười một', 12 => 'mười hai'
			);
			$month_vi = isset( $months_vi[ $month_num ] ) ? $months_vi[ $month_num ] : $month_num;
			
			$comment_date = sprintf( '%d Tháng %s, %d vào lúc %s', $day, $month_vi, $year, $time );
			?>
			<div class="comment-item">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 64 ); ?>
				</div>
				<div class="comment-content">
					<div class="comment-author-name"><?php echo esc_html( get_comment_author( $comment ) ); ?></div>
					<div class="comment-date"><?php echo esc_html( $comment_date ); ?></div>
					<div class="comment-text"><?php echo esc_html( $comment->comment_content ); ?></div>
					<div class="comment-actions">
						<button class="comment-reply-btn">BÌNH LUẬN</button>
						<?php if ( $is_author && $comment_author_id ) : ?>
							<a href="<?php echo esc_url( get_author_posts_url( $comment_author_id ) ); ?>" class="comment-author-link">BỞI TÁC GIẢ</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php
}

// Hiển thị form comment
if ( comments_open() || pings_open() ) {
	?>
	<div class="comment-form-wrapper">
		<?php
		comment_form(
			array(
				'class_form'         => 'comment-form make-post-form',
				'title_reply'        => '',
				'title_reply_before' => '',
				'title_reply_after'  => '',
				'label_submit'       => 'share',
				'submit_button'      => '<input name="%1$s" type="submit" id="%2$s" class="%3$s share-btn" value="%4$s" />',
				'submit_field'       => '<div class="form-submit-wrapper" style="display:none;">%1$s %2$s</div>',
				'comment_field'      => $comment_field_markup,
				'fields'             => array(),
				'comment_notes_before' => '',
				'comment_notes_after'  => '',
				'logged_in_as'       => '',
			)
		);
		?>
	</div>
	<?php
} elseif ( is_single() ) {
	?>
	<div class="comment-respond" id="respond">
		<p class="comments-closed"><?php _e( 'Comments are closed.', 'twentytwenty' ); ?></p>
	</div>
	<?php
}
