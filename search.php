<?php
/**
 * The template for displaying archive pages
 */

get_header(); 
global $boutique;


$displaybanner  = $boutique['boutique-banner-big'];
$bgheaderimg    = $boutique['archive-banner']['url'];
$gn_layout      = $boutique['boutique-select-header-layout'];

?>
<?php if( $displaybanner == '1' ){ ?>
<div class="breadcumb-area background-image"  data-src="<?php echo $bgheaderimg; ?>">
    <div class="<?php if( $gn_layout == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>Search</h2>
                <ul>
                	<?php boutique_breadcrumbs(); ?>
              	</ul>
            </div>
        </div>
    </div>
</div>

<?php }else{?>

<div class="breadcumb-area without-bg">
    <div class="<?php if( $gn_layout == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <h2>Search</h2>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 text-right">
            	<ul>
					      <?php boutique_breadcrumbs(); ?>
              </ul>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<div class="blog-list-area">
    <div class="<?php if( $gn_layout == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12 p-0">
              <?php if ( have_posts() ) : ?>

        				<div class="subtitle-page">
        					<h3 class="page-title"><?php printf( __( 'Search Results for: %s', 'boutique' ), get_search_query() ); ?></h3>
        				</div><!-- .page-header -->
    
				        <?php
                  /* Start the Loop */
                  while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', get_post_format() );

                  endwhile;
                ?>
              
                <div class="col-md-9 col-md-offset-3 col-xs-offset-0 col-xs-12 pr-0">
                    <nav aria-label="Page navigation">
                      <?php    
                        the_posts_pagination( array(
                          'mid_size'  =>  2,
                          'prev_text' =>  __( '<i class="fa fa-angle-left" aria-hidden="true"></i>', 'boutique' ),
                          'next_text' =>  __( '<i class="fa fa-angle-right" aria-hidden="true"></i>', 'boutique' )
                        ) );
                      ?>
                    </nav>
                  </div>
                <?php

                else :

                  get_template_part( 'template-parts/content', 'none' );

                endif;
              ?>

            </div>
            <!-- blog sidebar section start -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <?php 

                get_sidebar();

              ?>
          </div>            <!-- blog sidebar End section -->
        </div>
    </div>
</div>



<?php get_footer(); ?>
