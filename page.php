<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 */

get_header(); 

$displaybanner	=	get_post_meta( get_queried_object_id(), 'boutique_hdrbnnr', true );
$bgheaderimg	=	get_post_meta( get_queried_object_id(), 'boutique_hbg_image', true );
$layout         =   get_post_meta( get_queried_object_id(), 'boutique_page_custom_layout', true );
$breadcumb_pg   =   get_post_meta( get_queried_object_id(), 'boutique_breadcumb', true );
$page_title     =   get_post_meta( get_queried_object_id(), 'boutique_page_title', true );
$sidebars       =   get_post_meta( get_queried_object_id(), 'boutique_sidebar_sl', true );

$gn_layout   =   $boutique['boutique-select-header-layout'];
$in_layout   =   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );
 
if( $in_layout == '' || $in_layout == 'default'  ){  
    $gh_ly  =  $gn_layout; 
} 

?>

<?php if( !is_front_page() ): ?>

<?php if( $displaybanner == '1' ){ ?>
<div class="breadcumb-area background-image"  data-src="<?php echo $bgheaderimg; ?>">
    <div class="<?php if ( $in_layout == 'header5' || $gh_ly == 5 ) { echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2><?php the_title(); ?></h2>
                <?php if( $breadcumb_pg == 1 ): ?>
                    <ul>
    	                <?php boutique_breadcrumbs(); ?>
                	</ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php }elseif( $page_title == 1 ){?>

<div class="breadcumb-area without-bg">
    <div class="<?php if ( $in_layout == 'header5' || $gh_ly == 5 ) { echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <h2><?php the_title(); ?></h2>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 text-right">
            	<?php if( $breadcumb_pg == 1 ): ?>
                    <ul>
                        <?php boutique_breadcrumbs(); ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php }elseif ( $page_title == 0 && $displaybanner == 0 ) { ?>

<div class="breadcumb-area spp_breadcumb">
    <div class="<?php if ( $in_layout == 'header5' || $gh_ly == 5 ) { echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul>
                    <?php boutique_breadcrumbs(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
    
<?php } ?>




<?php endif; ?>

<div class="content-sec <?php if( !is_front_page() ){ echo 'section'; } ?>">
    <div class="<?php if ( $in_layout == 'header5' || $gh_ly == 5 ) { echo 'container-fluid'; }else{ echo 'container'; } ?>" role="main">
        <div class="row">
            <?php if( $layout == 'sidebar-left' ){ ?>
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <?php 
                        if( $sidebars != 'shop_sidebar' ){
                            get_sidebar();
                        }else{
                            if ( class_exists( 'WooCommerce' ) ) { 
                                get_sidebar('shop'); 
                            } 
                        }
                    ?>
                </div>
            <?php } ?>

            <div class="<?php if( $layout != 'default' ){ echo 'col-md-8 col-sm-7 col-xs-12'; }else { echo 'col-md-12 col-sm-12 col-xs-12'; } ?>">
                <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', 'page' );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                ?>
            </div>

            <?php if( $layout == 'sidebar-right' ){ ?>  
                <div class="col-md-4 col-sm-5 col-xs-12">
                    <?php 
                        if( $sidebars != 'shop' ){
                            get_sidebar(); 
                        }else{
                            if ( class_exists( 'WooCommerce' ) ) { get_sidebar('shop'); } 
                        }
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
