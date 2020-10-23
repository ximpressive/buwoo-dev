<?php 
/*
 *  Footer style 4
 */

global $boutique;

$phnmber    =   $boutique['phonenumber'];

$hg_layout  =   $boutique['boutique-select-header-layout'];
$ih_layout  =   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );

if( $ih_layout == '' ){
    $ghly    =   $hg_layout;
}


?>
<footer class="footer_dyna">
	<!-- footer start here -->
        <div class="footer-four-top-area">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
                <div class="row">
                    <div class="col-md-8">
                        <?php if ( is_active_sidebar( 'footer4-s4-w1' ) ) : ?>
                            <div class="subscribeform">
                                <?php dynamic_sidebar( 'footer4-s4-w1' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <div class="widget">
                            <h2 class="widget-title">Do you need help?</h2>
                            <div class="phone-number">
                                <?php $tel = implode(array_filter(str_split($phnmber, 1), "is_numeric")); ?>
                                <?php if($phnmber){ ?>
                                <h4><i class="fa fa-phone" aria-hidden="true"></i>  <a href="tel:<?php echo $tel; ?>" class="phn"><?php echo $phnmber; ?></a></h4>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-four-area">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
                <div class="row">
                    <div class="col-md-6">
                        <?php if ( is_active_sidebar( 'footer4-s4-left' ) ) : ?>
                            <div class="payment-method">
                                <?php dynamic_sidebar( 'footer4-s4-left' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php if ( is_active_sidebar( 'footer4-s4-right' ) ) : ?>
                            <div class="app_info copyright">
                                <?php dynamic_sidebar( 'footer4-s4-right' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer end here -->
</footer>        