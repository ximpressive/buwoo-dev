<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 3.0.0
 */

get_header(); 
global $boutique;


$displaybanner  = $boutique['boutique-bner404'];
$bgheaderimg    = $boutique['b404-banner']['url'];
$gn_layout      = $boutique['boutique-select-header-layout'];

?>
<?php if( $displaybanner == '1' ){ ?>
<div class="breadcumb-area background-image"  data-src="<?php echo $bgheaderimg; ?>">
    <div class="<?php if( $gn_layout == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2><?php _e( '404', 'boutique' ); ?></h2>
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
                <h2><?php _e( '404', 'boutique' ); ?></h2>
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


<div id="primary" class="section 404-page">
    <div class="<?php if( $gn_layout == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12 text-center">    
                <section class="error-404 not-found">
                    <div class="page-content">
                        <h4><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'boutique' ); ?></h4>
                        <div class="search-form">
                            <?php get_search_form(); ?>
                        </div>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </div> 
            <div class="col-md-4 col-sm-6 col-xs-12">
                <?php get_sidebar(); ?>
            </div>   
        </div>
    </div><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
