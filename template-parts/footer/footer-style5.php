<?php 
/*
 *  Footer style 5
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
        </div>
    <footer class="footer_dyna">    
        <div class="footer-five-middle-area">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
                <div class="row row-normalize">
                    <div class="col-sm-12">
                        <?php if ( is_active_sidebar( 'footer5-s5-w1' ) ) : ?>
                            <div class="subscribeform">
                                <?php dynamic_sidebar( 'footer5-s5-w1' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-five-middle-bottom-area">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img src="<?php echo BOUTIQUE_THEMEROOT; ?>/assets/images/icon.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php if ( is_active_sidebar( 'footer5-s5-w2' ) ) : ?>
                            <div class="row">
                                <?php dynamic_sidebar( 'footer5-s5-w2' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area home-v5">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>">
                <div class="row">
                    <div class="col-sm-6">
                        <?php if ( is_active_sidebar( 'copyright-right' ) ) : ?>
                            <div class="copyright">
                                <?php dynamic_sidebar( 'copyright-right' ); ?>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer end here -->
</footer>
