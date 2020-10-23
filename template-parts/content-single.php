<?php
/**
 * Template part for displaying posts
 */

?>
<?php setPostViews(get_the_ID()); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-list-blog">
		<div class="col-md-2 col-sm-3 col-xs-12">
            <div class="entry-meta text-center">
                <?php 
					$archive_year  = get_the_time( 'Y' ); 
					$archive_month = get_the_time( 'm' ); 
					$archive_day   = get_the_time( 'd' ); 
					//echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); 
				?>
	            <div class="post_date"><?php echo get_the_date('j M, Y'); ?></div>
	            <div class="post_avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></div>
	            <div class="post_author"><?php echo get_the_author_meta('display_name'); ?></div>
            </div>
        </div>
        <div class="col-md-10 col-sm-9 col-xs-12">
			<div class="post_content">
				<?php if(has_post_thumbnail()){ ?>
					<div class="images">
	                    <?php the_post_thumbnail('sn_img'); ?>
	                </div>
            	<?php } ?>
            	<h1><?php the_title(); ?></h1>
            	<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'boutique' ),
						get_the_title()
					) );
				?>
			</div>
			<div class="footer-meta single_blog">
                <div class="row">
                    <div class="col-md-5 col-sm-4 col-xs-12 post_tags">
                        <ul>
		                	<?php
		                		$posttags = get_the_tags();
								if ($posttags) {
								    foreach($posttags as $tag) {
								      echo '<li><i class="fa fa-tag" aria-hidden="true"></i> '.$tag->name . '</li>'; 
								    }
								}
		                	?>	
		                </ul>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="social-media text-center">
                            <h4>Share : </h4>
                            <ul>
                                <li><a href="javascript:;" onclick="popUp = window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400'); popUp.focus(); return false"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
		                        <li><a href="javascript:;" onclick="popUp = window.open('http://twitter.com/share?text=<?php the_title(); ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400'); popUp.focus(); return false"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
		                        <li><a href="javascript:;" onclick="popUp = window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400'); popUp.focus(); return false"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
		                        <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12 views_cmnts text-right">
                        <ul>
                            <li><i class="fa fa-eye" aria-hidden="true"></i> <?php echo getPostViews(get_the_ID()); ?></li>
                            <li><i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo get_comments_number($post->ID); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="post_nav">
                <div class="col-md-6 col-sm-6 col-xs-6 p-0">
                	<?php 
                	wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'boutique' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'boutique' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );


					?>
                    <div class="col-md-3">
                        <div class="btn_nav">
                            <a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="post_name">
                            <p>Previous Article</p>
                            <h4>How to Improve Performance of Your Sales Managers</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 p-0 text-right">
                    <div class="col-md-9">
                        <div class="post_name">
                            <p>Next Article</p>
                            <h4>How to Improve Performance of Your Sales Managers</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="btn_nav">
                            <a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <span class="clearfix"></span>
            </div>	
        </div>	
	</div>
	


</article><!-- #post-## -->
