 <?php 

  global $boutique;
  
  $topheader        =   $boutique['boutique-opt-show-header'];
  $sticky_header    =   $boutique['boutique-hdr-sticky'];
  $header_version   =   $boutique['header_version'];
  $transparenthdr   =   get_post_meta( get_queried_object_id(), 'boutique_transparenthdr', true );
  $mobile_menu      =   $boutique['boutique-menu_mobile'];
  $inpage_header_layout   =   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );

?>
 <div class="head_dyna header-area10 hd4 <?php if( $sticky_header == 1 ){ ?> header_sticky <?php } if( $tranhdr_optn == 1 ){ echo 'transparenthdr'; } if( $transparenthdr == 1 ){ echo 'pghdrtrans'; } if( $topheader == 1 ){ echo ' hdtr_tphdr '; } ?><?php if( $header_version == 0 ){ echo ' dark_version '; }elseif( $header_version == 1 ){ echo ' light_version '; } ?>">
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="site_logo visible-sm visible-xs">
                  <?php boutique_site_logo(); ?>
                </div>
                <?php if( $mobile_menu == true ){ ?>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <?php } ?>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="row">
                    <div class="col-md-1 pl-0">
                        <ul class="nav navbar-nav navbar-left">
                            <li class="btn-search-form-toggle" ><a href="javascript:;"><span class="flaticon-search"></span></a></li>
                        </ul>
                    </div>
                    <div class="col-md-10 text-center">
                      <?php boutique_site_logo(); ?>    
                    </div>
                    <div class="col-md-1 pr-0">
                        <ul class="nav navbar-nav navbar-right">
                            <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                                <?php if( is_shop() || is_product_category() || is_product() || is_cart() || is_checkout() || is_account_page() ) : ?>
                                  <?php if( $cart_btn == true ){ ?>

                                      <li class="cart-icon"><a href="javascript:;" class="shopping-cart" id="minicart"><i class="flaticon-business"></i> <span> <?php echo WC()->cart->get_cart_contents_count(); ?> </span> </a>
                                        <!-- minicart area section -->
                                          <div class="minicart-page-area" id="mode-mini-cart">
                                            <?php woocommerce_mini_cart(); ?>
                                          </div>
                                        <!-- minicart area End section -->
                                      </li>

                                  <?php } ?>
                                <?php endif; ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="row text-center visible-xs">
                  <?php
                      $args = array(
                         'theme_location' => 'mobile-nav',
                         'menu'           => 'mobile-nav',
                         'menu_class'     => 'nav navbar-nav',
                         'menu_id'        => 'primary-inner',
                         'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                         'container'      => 'div',
                         'container_class'=> '',
                         'container_id'   => 'boutique-main-menu',
                         'echo'           => true,
                         'walker'         => new Boutique_Menu_walker()
                      );
                      wp_nav_menu($args);
                  ?>
                </div>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>
</div>
