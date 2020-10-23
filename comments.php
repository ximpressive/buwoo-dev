<?php

/**
 * The template for displaying Comments
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'boutique' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'boutique'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h3>
		<div class="comment-list">
			<ul>
				<?php
					wp_list_comments( array(
						'style'       	=>	'ul',
						'short_ping'  	=>	true,
						'avatar_size'	=>	80,
						'format'        =>	'html5',
						'callback'      =>	'format_comment'
					) );
				?>
			</ul>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav class="navigation comment-navigation" role="navigation">
					<h3 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'digency' ); ?></h3>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'digency' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'digency' ) ); ?></div>
				</nav>
			<?php endif; ?>
			<?php if ( ! comments_open() && get_comments_number() ) : ?>
				<p class="no-comments"><?php _e( 'Comments are closed.' , 'digency' ); ?></p>
			<?php endif; ?>
		</div>	
	<?php endif;?>
</div>
<div class="comments-form">
    <div class="row">
        <div class="col-sm-12">
            <div class="form">
            	<div class="row">
				<?php 
					$commenter = wp_get_current_commenter();
					$req = get_option( 'require_name_email' );
					$aria_req = ( $req ? " aria-required='true'" : '' );

				    $args = array(
				    	'title_reply'		=>	__( 'Leave a comment', 'boutique' ),	
				    	'label_submit'      =>	__( 'Post Comment', 'boutique' ),
				    	'class_submit'		=>	'btn btn-default send',
				    	'submit_field'		=>	'<div class="col-lg-4 col-md-4 col-sm-4">%1$s %2$s</div>',
				    	'submit_button'		=>	'<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s <i class="fa fa-caret-right" aria-hidden="true"></i></button> ',
				    	'comment_field' 	=>	'<div class="col-md-12 col-sm-12 col-xs-12"><label for="comment">Comment*</label><textarea id="comment" name="comment" cols="45" rows="8" class="form-control" aria-required="true">' . '</textarea></div>',

				        'fields' => array(
					        'author' => '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><label for="name">Name*</label>' .
					                        '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
					        'email'  => '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><label for="email">Email* <span>(Will not be published)</span></label>' .
					                        '<input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
					        'url'    => '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><label for="subject">Web</label>' .
					                        '<input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
				        )
				    );
				    comment_form( $args );
				?>
				</div>
            </div>
        </div>
    </div>
</div>
