<?php 

global $boutique;

$hg_layout  =   $boutique['boutique-select-header-layout'];
$ih_layout  =   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );

if( $ih_layout == '' ){
    $ghly    =   $hg_layout;
}

?>

<footer class="footer_dyna">    
    <!-- footer start here -->
    <div class="section main-footer-area">
        <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly  == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
            <div class="row">
                <div class="col-sm-4">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <div id="widget">
                            <?php dynamic_sidebar( 'footer-1' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-2">
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <div class="widget link">
                            <?php dynamic_sidebar( 'footer-2' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-2">
                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <div class="widget link">
                            <?php dynamic_sidebar( 'footer-3' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-4">
                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <div class="widget link">
                            <?php dynamic_sidebar( 'footer-4' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- services end section -->
    <div class="help-faq-area">
        <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly  == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="inner-help">
                        <?php if ( is_active_sidebar( 'footer-box-widget' ) ) : ?>
                            <ul>
                                <?php dynamic_sidebar( 'footer-box-widget' ); ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>        <!-- service end section -->
    <div class="footer-bottom-area">
        <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly  == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
            <div class="row">
                <div class="col-sm-6">
                    <?php if ( is_active_sidebar( 'footer-5' ) ) : ?>
                        <div class="copyright">
                            <?php dynamic_sidebar( 'footer-5' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6">
                    <?php if ( is_active_sidebar( 'payment-boxes' ) ) : ?>
                        <div class="payment-method text-right">
                            <?php dynamic_sidebar( 'payment-boxes' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>        