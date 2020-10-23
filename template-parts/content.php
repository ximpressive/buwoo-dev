<?php
/**
 * Template part for displaying posts
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-list-blog'); ?>>

    <div class="col-md-3 col-sm-3 col-xs-4">
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
    <div class="col-md-9 col-sm-9 col-xs-8 <?php if ( has_post_format( 'quote' )) { echo 'quote-format'; } ?> ">

    	<?php if( has_post_thumbnail() ) : ?>
            <div class="images">
                <?php the_post_thumbnail('blog_thumb'); ?>
                <div class="overley">
                    <div class="fund">
                        <a href="#"><span class="fa fa-share-alt-square" aria-hidden="true"></span></a>
                    </div>
                    <div class="arrow">
                        <a href="javascript:;" onclick="popUp = window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400'); popUp.focus(); return false"><span class="fa fa-facebook" aria-hidden="true"></span></a>
                        <a href="javascript:;" onclick="popUp = window.open('http://twitter.com/share?text=<?php the_title(); ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400'); popUp.focus(); return false"><span class="fa fa-twitter" aria-hidden="true"></span></a>
                        <a href="javascript:;" onclick="popUp = window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400'); popUp.focus(); return false"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
                        <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" target="_blank"><span class="fa fa-google-plus" aria-hidden="true"></span></a>
                    </div>
                </div>
            </div>
    	<?php endif; ?>

    	<?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
        <p><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></p>
        <div class="footer-meta">
            <div class="col-md-8 col-xs-6 post_tags pl-0">
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
            <div class="col-md-4 col-xs-6 views_cmnts pr-0 text-right">
                <ul>
                    <li><i class="fa fa-eye" aria-hidden="true"></i> <?php echo getPostViews(get_the_ID()); ?></li>
                    <li><i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo get_comments_number($post->ID); ?></li>
                </ul>
            </div>
        </div>
    </div>
		
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

</article><!-- #post-## -->


				
