<?php 
/*
 *  Footer style 6
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
	<!-- footer start here -->
    <footer class="footer_dyna">
        <div class="section footer-top-area home-v6">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly  == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php if ( is_active_sidebar( 'footer6-s6-w1' ) ) : ?>
                            <div class="subscribeform">
                                <?php dynamic_sidebar( 'footer6-s6-w1' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-2 hidden-sm hidden-xs"></div>
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <?php if ( is_active_sidebar( 'footer6-s6-w2' ) ) : ?>
                                    <div class="single-footer-menu">
                                        <?php dynamic_sidebar( 'footer6-s6-w2' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4 col-sm-6 col-xs-6">
                                <?php if ( is_active_sidebar( 'footer6-s6-w3' ) ) : ?>
                                    <div class="single-footer-menu">
                                        <?php dynamic_sidebar( 'footer6-s6-w3' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-2 hidden-sm hidden-xs"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area home-v6">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly  == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
                <div class="row">
                    <div class="col-sm-6">
                        <?php if ( is_active_sidebar( 'copyright-w5' ) ) : ?>
                            <div class="copyright">
                                <?php dynamic_sidebar( 'copyright-w5' ); ?>
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
        <!-- footer end here -->
    </footer>
