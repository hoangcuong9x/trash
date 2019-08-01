<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
	return;
}

if ( ! function_exists( 'wpazure_comments_template' ) ) :
	/**
	 * Custom list of comments for the theme.
	 */
	function wpazure_comments_template() {
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args     = array(
			'class_form'         => 'form',
			'title_reply_before' => '<div class="blog-heading m-t-10"><h3>',
			'comment_notes_before' => '',
			'title_reply_after'  => '</div></h3>',
			'must_log_in'        => '<p class="must-log-in">' .
									sprintf(
										wp_kses(
											/* translators: %s is Link to login */
											__( 'You must be <a href="%s">logged in</a> to post a comment.', 'wpazure' ), array(
												'a' => array(
													'href' => array(),
												),
											)
										), esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) )
									) . '</p>',
			
			'fields'             => apply_filters(
				'comment_form_default_fields', array(
					'author' => '<div class="row"><div class="col-sm-4 col-12"> <p> <label>' . esc_html__( 'Your Name', 'wpazure' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="author" name="author" class="form-control" placeholder="'.esc_attr__('Your Name','wpazure').'" type="text"' . $aria_req . ' /> </p> </div>',
					'email'  => '<div class="col-sm-4 col-12"> <p> <label>' . esc_html__( 'Email Address', 'wpazure' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="email" name="email" class="form-control" placeholder="'.esc_attr__('Email Address','wpazure').'" type="email"' . $aria_req . ' /> </p> </div>',
					'url'=> '<div class="col-sm-4 col-12"> <p> <label>' . esc_html__( 'Your Website', 'wpazure' ).'</label><input id="url" name="url" class="form-control" placeholder="'.esc_attr__('Your Website','wpazure').'" type="url" /> </p> </div></div>',
				)
			),
			
			'comment_field'      => '<div class="row"><div class="col-sm-12 col-12"> <p><label>' . esc_html__( 'Leave a comment', 'wpazure' ) . '</label><textarea id="comment" name="comment" placeholder="'.esc_attr__('Comment','wpazure').'"  ' . $aria_req . '></textarea></p> </div></div>',
			
			'submit_button' => '<div class="row"><div class="col-sm-12 col-12">
            <input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />
			</div></div>'
		
			);

		return $args;
	}
endif;

if ( ! function_exists( 'wpazure_comments_list' ) ) :

	function wpazure_comments_list($comment, $args, $depth )
	{
		global $comment_data;
		$date_format = get_option( 'date_format' );
		$time_format = get_option( 'time_format' );
		?>
		<!--Comment-->
		<div <?php comment_class('media comment-box'); ?> id="comment-<?php comment_ID(); ?>">
			<a class="pull-left-comment" href="<?php the_author_meta('user_url'); ?>">
			<?php echo get_avatar( $comment , $size = 70, '', '', array('class' => 'media-object mr-3')  ); ?>
			</a>
			<div class="media-body">
				<div class="comment-area">
					<div class="author-area">
						<h6 class="media-heading"><?php esc_html(comment_author()); ?>
						</h6>
						<abbr class="comment-date"><?php esc_html_e('Posted on ','wpazure'); ?><?php  echo esc_html(comment_time($time_format)); ?><?php echo " - "; echo esc_html(comment_date($date_format));?>
						</abbr>
					</div>
					<div class="reply-btn more-link">
						<?php comment_reply_link(array_merge( $args, array('reply_text' => sprintf( '<i class="fa fa-mail-reply"></i> %s', esc_html__( 'Reply', 'wpazure' ) ),'depth' => $depth, 'max_depth' => $args['max_depth'], 'per_page' => $args['per_page']))) ?>
					</div>
					<p><?php comment_text(); ?></p>
					<?php edit_comment_link( esc_html__( 'Edit','wpazure' ), '<p class="edit-link">', '</p>' ); ?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wpazure' ); ?></em><br/>
					<?php endif; ?>
				</div>
			</div>
		</div>      
	                
        <?php
	}
endif;

function wpazure_move_comment_field_to_bottoms( $fields ) {
if ( array_key_exists( 'comment', $fields ) ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;
		}

		if ( array_key_exists( 'cookies', $fields ) ) {
			$cookie_field = $fields['cookies'];
			unset( $fields['cookies'] );
			$fields['cookies'] = $cookie_field;
		}

		return $fields;
}
 
add_filter( 'comment_form_fields', 'wpazure_move_comment_field_to_bottoms' );


if ( have_comments() ) : ?>	
<div class="comment-section m-bottom-30" >
	<!-- Comment start -->
	<?php
		wp_list_comments( array( 'callback' => 'wpazure_comments_list' ) );
	
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below">
				<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'wpazure' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'wpazure' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'wpazure' ) ); ?></div>
			</nav>
		<?php endif; 
		
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments">
				<?php esc_html_e( 'Comments are closed.', 'wpazure' ); ?>
			</p>
			<?php
		endif; ?>
	
	<!-- Comment end -->
</div>
<?php endif; ?>
<?php 
if ( comments_open() )  :
?>
<div class="quote-form m-bottom-30 comment-respond" id="respond">
	<?php comment_form( wpazure_comments_template() ); ?>   
</div>
<?php endif;