<?php
/**
 * The template for displaying all single posts
 */
global $boutique;

	$display_featured_img	=   get_post_meta( get_the_ID(), 'boutique_featured_img', true );
	$display_bg_img			=   get_post_meta( get_the_ID(), 'boutique_hd_bg_img', true );
	$display_bg_video   	=   get_post_meta( get_the_ID(), 'boutique_hd_bg_vid', true );
	$displaybanner  		=	get_post_meta( get_the_ID(), 'boutique_hdrbnnr', true );
	$bgheaderimg    		=	get_post_meta( get_the_ID(), 'boutique_hd_bg_img', true );
	$recent_post			=	$boutique['boutique-recent-post'];
	$layout					=	$boutique['boutique-single_layout'];
	$gn_layout      		=	$boutique['boutique-select-header-layout'];
	// count post viewers
	setPostViews(get_the_ID());


get_header(); ?>
	
<?php if( $displaybanner == '1' ){ ?>
	<?php 
		if( $display_featured_img == 1 ){ 
			$post_id = get_queried_object_id();
			if ( has_post_thumbnail( $post_id ) ) :
			    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
			    $image = $image_array[0];
			else:
			    $image = get_template_directory_uri() . '/assets/images/breadcumb/default-background.jpg';
			endif;
		}elseif( !empty($display_bg_img)  ){
				$image = $bgheaderimg;
		}else{ 
			$image = get_template_directory_uri() . '/assets/images/breadcumb/default-background.jpg';
		}
	?>

	<div class="breadcumb-area background-image"  data-src="<?php echo $image; ?>">
	    <div class="<?php if( $gn_layout == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
	        <div class="row">
	            <div class="col-sm-12 text-center">
	                <h2><?php echo get_the_title( get_option('page_for_posts', true) ); ?></h2>
	                <ul>
	                	<?php  boutique_breadcrumbs(); ?>
	              	</ul>
	            </div>
	        </div>
	    </div>
	</div>

<?php } ?>

<div class="section single-blog-area">
    <div class="<?php if( $gn_layout == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
        	<?php if( $layout == 'left-sidebar' ){ ?>
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
            <div class="<?php if( $layout != 'full-width' ){ echo 'col-md-8 col-sm-7 col-xs-12'; }else { echo 'col-md-12 col-sm-12 col-xs-12'; } ?>">
            	<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

				?>		

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
					                            <?php buwoo_social_share(get_the_title(), get_permalink());?>
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
									<?php 
										the_post_navigation(
											array(
											'next_text' => '<div class="col-md-6 col-sm-6 col-xs-6 p-0 text-right"><div class="col-md-9"><div class="post_name"><p>' . __( 'Next Article', 'boutique' ) . '</p><h4 class="post-title">%title</h4></div></div><div class="col-md-3"><span class="meta-nav postnv" aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span></div></div>',

											'prev_text' => '<div class="col-md-6 col-sm-6 col-xs-6 p-0"><div class="col-md-3"><span class="meta-nav postnv" aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span></div><div class="col-md-9"><div class="post_name"><p>' . __( 'Previous Article', 'boutique' ) . '</p><h4 class="post-title">%title</h4></div></div></div>',
											)
										);
									?>					            	
					                <span class="clearfix"></span>
					            </div>
					            <!-- comments section start -->
					            <div class="Commentsec">
					            		
					            		<?php
										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											comments_template();
										endif;

										?>

					            </div>
					        </div>
					    </div>    
					</article>			
				<?php endwhile; ?>
			</div>
			<?php if( $layout == 'right-sidebar' ){ ?>  
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
		</div>
	</div>
</div>			



<?php get_footer(); 
