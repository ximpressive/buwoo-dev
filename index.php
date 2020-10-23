<?php 

/**
 * The template for Blog
 */


get_header(); 

$displaybanner  = get_post_meta( get_queried_object_id(), 'boutique_hdrbnnr', true );
$bgheaderimg    = get_post_meta( get_queried_object_id(), 'boutique_hbg_image', true );
$layout         = get_post_meta( get_queried_object_id(), 'boutique_page_custom_layout', true );

$gn_layout      = $boutique['boutique-select-header-layout'];
$in_layout      = get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );

if( $in_layout == '' || $in_layout == 'default' ){ 
  $gh_ly  =  $gn_layout;
}

?>
<?php if( $displaybanner == '1' ){ ?>
<div class="breadcumb-area background-image"  data-src="<?php echo $bgheaderimg; ?>">
    <div class="<?php if( $in_layout == 'header5' || $gh_ly == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2><?php echo get_the_title( get_option('page_for_posts', true) ); ?></h2>
                <ul>
                  <?php 
                    $args = array(
                     'delimiter'   =>  '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                     'wrap_before'   =>  '<li>',
                     'wrap_after'  =>  '</li>',
                    ); 
                    //woocommerce_breadcrumb($args); 
                    boutique_breadcrumbs(); 
                  ?>
              </ul>
            </div>
        </div>
    </div>
</div>

<?php }else{?>

<div class="breadcumb-area without-bg">
    <div class="<?php if( $in_layout == 'header5' || $gh_ly == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <h2><?php echo get_the_title( get_option('page_for_posts', true) ); ?></h2>
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
    <div class="<?php if( $in_layout == 'header5' || $gh_ly == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <?php if( $layout == 'sidebar-left' ){ ?>
              <div class="col-md-4 col-sm-5 col-xs-12">
                <?php get_sidebar(); ?>
              </div>
            <?php } ?>
            
            <div class="<?php if( $layout != 'default' ){ echo 'col-md-8 col-sm-7 col-xs-12 p-0'; }else { echo 'col-md-12 col-sm-12 col-xs-12'; } ?>">
              <?php
                if ( have_posts() ) :
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
            <?php if( $layout == 'sidebar-right' ){ ?>  
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div> 
</div>



<?php get_footer(); ?>
