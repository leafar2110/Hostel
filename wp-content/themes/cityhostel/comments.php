<?php
/**
 * The template to display the Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;



// Callback for output single comment layout
if (!function_exists('cityhostel_output_single_comment')) {
	function cityhostel_output_single_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) {
			case 'pingback' :
				?>
				<li class="trackback"><?php esc_html_e( 'Trackback:', 'cityhostel' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'cityhostel' ), '<span class="edit-link">', '<span>' ); ?>
				<?php
				break;
			case 'trackback' :
				?>
				<li class="pingback"><?php esc_html_e( 'Pingback:', 'cityhostel' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'cityhostel' ), '<span class="edit-link">', '<span>' ); ?>
				<?php
				break;
			default :
				$author_id = $comment->user_id;
				$author_link = get_author_posts_url( $author_id );
				$mult = cityhostel_get_retina_multiplier();
				?>
				<li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment_item'); ?>>
					<div class="comment_author_avatar"><?php echo get_avatar( $comment, 84*$mult ); ?></div>
					<div class="comment_content">
						<div class="comment_info">
							<h6 class="comment_author"><?php echo (!empty($author_id) ? '<a href="'.esc_url($author_link).'">' : '') . comment_author() . (!empty($author_id) ? '</a>' : ''); ?></h6>
							<div class="comment_posted">
								<span class="comment_posted_label"><?php esc_html_e('Posted', 'cityhostel'); ?></span>
								<span class="comment_date"><?php
									echo cityhostel_get_date(get_comment_date('U'));	//get_comment_date(get_option('date_format'));
								?></span>
								<span class="comment_time"><?php
									echo get_comment_date(get_option('time_format'));
								?></span>
								<?php if ( $comment->comment_approved == 1 ) { ?>
								<span class="comment_counters"><?php cityhostel_show_comment_counters(); ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="comment_text_wrap">
							<?php if ( $comment->comment_approved == 0 ) { ?>
							<div class="comment_not_approved"><?php esc_html_e( 'Your comment is awaiting moderation.', 'cityhostel' ); ?></div>
							<?php } ?>
							<div class="comment_text"><?php comment_text(); ?></div>
						</div>
						<?php if ($depth < $args['max_depth']) { ?>
							<div class="comment_reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
						<?php } ?>
					</div>
				<?php
				break;
		}
	}
}





// Output comments list
if ( have_comments() || comments_open() ) {
	?>
	<section class="comments_wrap">
	<?php
	if ( have_comments() ) {
	?>
		<div id="comments" class="comments_list_wrap">
			<h3 class="section_title comments_list_title"><?php $cityhostel_post_comments = get_comments_number(); echo esc_html($cityhostel_post_comments); ?> <?php echo (1==$cityhostel_post_comments ? esc_html__('Comment', 'cityhostel') : esc_html__('Comments', 'cityhostel')); ?></h3>
			<ul class="comments_list">
				<?php
				wp_list_comments( array('callback'=>'cityhostel_output_single_comment') );
				?>
			</ul><!-- .comments_list -->
			<?php if ( !comments_open() && get_comments_number()!=0 && post_type_supports( get_post_type(), 'comments' ) ) { ?>
				<p class="comments_closed"><?php esc_html_e( 'Comments are closed.', 'cityhostel' ); ?></p>
			<?php }	?>
			<div class="comments_pagination"><?php paginate_comments_links(); ?></div>
		</div><!-- .comments_list_wrap -->
	<?php 
	}

	if ( comments_open() ) {
		?>
		<div class="comments_form_wrap">
			<div class="comments_form">
				<?php
				$cityhostel_form_style = esc_attr(cityhostel_get_theme_option('input_hover'));
				if (empty($cityhostel_form_style) || cityhostel_is_inherit($cityhostel_form_style)) $cityhostel_form_style = 'default';
				$cityhostel_commenter = wp_get_current_commenter();
				$cityhostel_req = get_option( 'require_name_email' );
				$cityhostel_comments_args = array(
						// class of the 'form' tag
						'class_form' => 'comment-form ' . ($cityhostel_form_style != 'default' ? 'sc_input_hover_' . esc_attr($cityhostel_form_style) : ''),
						// change the id of send button 
						'id_submit' => 'send_comment',
						// change the title of send button 
						'label_submit' => esc_html__('Post comment', 'cityhostel'),
						// change the title of the reply section
						'title_reply' => esc_html__('Add a comment', 'cityhostel'),
						'title_reply_before' => '<h3 class="section_title comments_form_title">',
						'title_reply_after' => '</h3>',

						// remove "Logged in as"
						'logged_in_as' => '',
						// remove text before textarea
						'comment_notes_before' => '',
						// remove text after textarea
						'comment_notes_after' => '',
						// redefine your own textarea (the comment body)
						'comment_field' => cityhostel_single_comments_field(array(
												'form_style' => $cityhostel_form_style,
												'field_type' => 'textarea',
												'field_req' => true,
												'field_icon' => 'icon-feather',
												'field_value' => '',
												'field_name' => 'comment',
												'field_title' => esc_html__('Comment', 'cityhostel'),
												'field_placeholder' => esc_html__( 'Your Comment', 'cityhostel' )
											)),
						'fields' => apply_filters( 'cityhostel_filter_comment_form_default_fields', array(
							'author' => cityhostel_single_comments_field(array(
												'form_style' => $cityhostel_form_style,
												'field_type' => 'text',
												'field_req' => $cityhostel_req,
												'field_icon' => 'icon-user',
												'field_value' => isset($cityhostel_commenter['comment_author']) ? $cityhostel_commenter['comment_author'] : '',
												'field_name' => 'author',
												'field_title' => esc_html__('Name', 'cityhostel'),
												'field_placeholder' => esc_html__( 'Your Name', 'cityhostel' )
											)),
							'email' => cityhostel_single_comments_field(array(
												'form_style' => $cityhostel_form_style,
												'field_type' => 'text',
												'field_req' => $cityhostel_req,
												'field_icon' => 'icon-mail',
												'field_value' => isset($cityhostel_commenter['comment_author_email']) ? $cityhostel_commenter['comment_author_email'] : '',
												'field_name' => 'email',
												'field_title' => esc_html__('E-mail', 'cityhostel'),
												'field_placeholder' => esc_html__( 'Your E-mail', 'cityhostel' )
											))
						) )
				);
			
				comment_form($cityhostel_comments_args);
				?>
			</div>
		</div><!-- /.comments_form_wrap -->
		<?php 
	}
	?>
	</section><!-- /.comments_wrap -->
<?php 
}
?>