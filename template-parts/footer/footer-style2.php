<?php 
/*
 *  Footer style 2
 */

global $boutique;

$facebook   =   $boutique['boutique-facebook'];
$twitter    =   $boutique['boutique-twiiter'];
$pinterest  =   $boutique['boutique-pinterest'];
$googleplus =   $boutique['boutique-gplus'];
$instagram  =   $boutique['boutique-insta'];

$hg_layout  =   $boutique['boutique-select-header-layout'];
$ih_layout  =   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );

if( $ih_layout == '' ){
    $ghly    =   $hg_layout;
}

?>
<footer class="footer_dyna">
    <!-- footer start here -->
        <div class="section footer-top-area footer-two-style home-v2">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly  == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?> home-v2-pd">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="subscribeform">
                            <?php if ( is_active_sidebar( 'footer2-s2-w1' ) ) : ?>
                                <div id="widget">
                                    <?php dynamic_sidebar( 'footer2-s2-w1' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="widget">
                            <?php if ( is_active_sidebar( 'footer2-s2-w2' ) ) : ?>
                                <div class="payment-method">
                                    <?php dynamic_sidebar( 'footer2-s2-w2' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <?php if ( is_active_sidebar( 'footer2-s2-w3' ) ) : ?>
                            <div id="widget">
                                <?php dynamic_sidebar( 'footer2-s2-w3' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area home-v2">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly  == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?> home-v2-pd">
                <div class="row">
                    <div class="col-sm-6">
                        <?php if ( is_active_sidebar( 'footer2-s2-cpy' ) ) : ?>
                            <div class="copyright">
                                <?php dynamic_sidebar( 'footer2-s2-cpy' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 text-right">
                        <div class="social-media">
                        <ul>
                            <?php if( $facebook ){ ?>
                                <li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if( $twitter ){ ?>
                                <li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if( $googleplus ){ ?>
                                <li><a href="<?php echo $googleplus; ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if( $pinterest ){ ?>
                                <li><a href="<?php echo $pinterest; ?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if( $instagram ){ ?>
                                <li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <?php } ?>
                        </ul>
                            <p><?php echo __('thank you for visiting!','boutique'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</footer>        