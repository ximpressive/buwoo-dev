<?php 
/*
 *  Footer style 3
 */

global $boutique;

$facebook   =   $boutique['boutique-facebook'];
$twitter    =   $boutique['boutique-twiiter'];
$pinterest  =   $boutique['boutique-pinterest'];
$googleplus =   $boutique['boutique-gplus'];
$instagram  =   $boutique['boutique-insta'];

$phnmber    =   $boutique['phonenumber'];

$hg_layout  =   $boutique['boutique-select-header-layout'];
$ih_layout  =   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );

if( $ih_layout == '' ){
    $ghly    =   $hg_layout;
}

?>

<footer class="footer_dyna">
    <!-- footer start here -->
        <div class="footer-three-top-area home-v3">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly  == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?>  home-v3-pd">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 text-left">
                        <div class="subscribeform">
                            <?php if ( is_active_sidebar( 'footer3-s3-w1' ) ) : ?>
                                <div id="widget">
                                    <?php dynamic_sidebar( 'footer3-s3-w1' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12 text-center">
                        <div class="widget">
                            <ul>
                            <?php if( $facebook ){ ?>
                                <li><a href="<?php echo $facebook; ?>" class="fbk" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if( $twitter ){ ?>
                                <li><a href="<?php echo $twitter; ?>" class="twt" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if( $googleplus ){ ?>
                                <li><a href="<?php echo $googleplus; ?>" class="gop" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if( $pinterest ){ ?>
                                <li><a href="<?php echo $pinterest; ?>" class="pin" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if( $instagram ){ ?>
                                <li><a href="<?php echo $instagram; ?>" class="ins" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <?php } ?>
                        </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 text-right">
                        <div class="widget">
                            <?php $tel = implode(array_filter(str_split($phnmber, 1), "is_numeric")); ?>
                            <?php if($phnmber){ ?>
                            <p><a href="tel:<?php echo $tel; ?>" class="ft-tel"><?php echo $phnmber; ?></a> <i class="flaticon-smartphone"></i><span class="clear"></span><br clear="all"></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-three-area">
            <div class="<?php if( $footer_layout == "full" || $ih_layout == 'header5' || $ghly  == 5 ){ echo 'container-fluid'; }else{ echo 'container'; } ?> home-v3-pd">
                <div class="row">
                    <div class="col-md-6">
                        <?php if ( is_active_sidebar( 'footer3-s3-left' ) ) : ?>
                            <div class="copyright">
                                <?php dynamic_sidebar( 'footer3-s3-left' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php if ( is_active_sidebar( 'footer3-s3-right' ) ) : ?>
                            <div class="payment-method">
                                <?php dynamic_sidebar( 'footer3-s3-right' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer end here -->
</footer>        