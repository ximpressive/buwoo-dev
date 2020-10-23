<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<?php global $boutique;

  $responsiveness         =   $boutique['boutique-responsive'];
  $site_logo              =   $boutique['boutique-logo']['url'];
  $site_logo_retina       =   $boutique['boutique-logo_retina']['url'];
  $sticky_site_logo       =   $boutique['sticky_hdr_logo']['url'];    
  $favicon                =   $boutique['boutique-favicon']['url'];
  $lang_opt               =   $boutique['show_lang_sel'];
  $topheader              =   $boutique['boutique-opt-show-header'];
  $mobopt                 =   $boutique['boutique-opt-show-mobile'];
  $sticky_header          =   $boutique['boutique-hdr-sticky'];
  $header_gn_layout       =   $boutique['boutique-select-header-layout'];
  $inpage_header_layout   =   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );
  $display_header         =   get_post_meta( get_queried_object_id(), 'boutique_header', true );
  $facebook_social        =   $boutique['boutique-facebook'];
  $instagram_social       =   $boutique['boutique-insta'];
  $pintrest_social        =   $boutique['boutique-pinterest'];
  $twitter_social         =   $boutique['boutique-twiiter'];
  $linkedin_social        =   $boutique['boutique-linkedin'];
  $topbar_txt             =   $boutique['boutique-hdr-textarea'];
  $transparenthdr         =   get_post_meta( get_queried_object_id(), 'boutique_transparenthdr', true );
  $topwidth               =   $boutique['wide_box_opt'];
  $topbgcolor             =   $boutique['opt-header-bg-style'];
  $editorcss              =   $boutique['boutique-editor-css'];
  //$editorjs               =   $boutique['editor-head-js'];
  $cart_btn               =   $boutique['boutique-cart_opt'];
  $mobile_menu            =   $boutique['boutique-menu_mobile'];
  $preloader              =   $boutique['site_preloader'];
  $header_version         =   $boutique['header_version'];

?>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <meta name="description" content="desc">
  <meta name="author" content="Krocant.com">
    <?php
      if( $responsiveness == 1 ){ ?>
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0"/>
    <?php  }

        if($favicon !='') {
          echo  '<link rel="icon" rel="shortcut icon" type="image/gif" href="'. $favicon .'" sizes="16x16">';
       } else {
         echo  '<link rel="icon" rel="shortcut icon" type="image/gif" href="'. BOUTIQUE_IMAGES .'/favicon.png" sizes="16x16">';
       }
    ?>
    <?php // Apple Touch Icon ?>
    <!-- <link rel="apple-touch-icon" href="/custom_icon.png"> -->
    <?php if($editorcss){?>
      <style type="text/css">
        <?php echo $editorcss; ?>
      </style>
    <?php } ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( $preloader == 1 ) { ?>
  <div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>
<?php } ?>

<?php 
  if( $inpage_header_layout == '' ){  
    $gh_ly  =  $header_gn_layout; 

    if( !is_front_page() ){
      $gheadly  =  $header_gn_layout;
    }
  } 
  
?>


<div class="wrapper">
  <div class="pc-c<?php if ( $inpage_header_layout == 'header5' ) { echo ' leteral-in-nav'; } ?><?php if ( $gh_ly == 5 || $gheadly == 5 ) { echo ' leteral-gh-nav'; } ?>">
  
    <?php if( $topheader == 1 ){ ?>
        <div class="top_head_dyna header3-top-area home-v4 <?php if( $topbgcolor == 0 ){ echo 'header10-top-area'; }?> <?php if( $mobopt == false ){ echo 'hidden-xs'; } ?>">
          <div class="<?php if( $topwidth == 0 ){ echo 'container'; }else{ echo 'container-fluid p-0'; } ?>">
          
              <div class="row">
                  <div class="col-sm-6">
                    <div class="top_hh_r"> <?php echo $topbar_txt; ?> </div>
                  </div>
                  <div class="col-sm-6 text-right">
                    <div class="header-top-memu">
                        <?php
                          $args = array(
                           'theme_location' => 'top-head-nav',
                           'menu'           => 'primary',
                           'menu_class'     => 'nav navbar-nav navbar-right',
                           'menu_id'        => 'primary-inner',
                           'items_wrap'     => '<ul>%3$s</ul>',
                           'container'      => 'div',
                           'container_class'=> '',
                           'container_id'   => 'boutique-main-menu',
                           'echo'           => true,
                           'walker'         => new Boutique_Menu_walker()
                          );
                          wp_nav_menu($args);
                        ?>
                    </div>
                  </div>
              </div>
          </div>
      </div>

  <?php } ?>
  <div class="bwo-hcnt<?php if ( $inpage_header_layout == 'header5' ) { echo ' leteral-in-hd'; } ?><?php if ( $gh_ly == 5 || $gheadly == 5 ) { echo ' leteral-gh-hd'; } ?><?php if( $topheader == 1 ){ echo ' top1-hdr_space'; } ?> light-header">
    <!-- header area start here -->
    <?php boutique_theme_header(); ?>
    <!-- header area end here --><!-- section -->
  </div><!--/.bwo-hcnt-->
<div class="bwo-pcnt<?php if ( $inpage_header_layout == 'header5' ) { echo ' leteral-in-cnt clearfix'; } ?><?php if ( $gh_ly == 5 || $gheadly == 5 ) { echo ' leteral-gh-cnt clearfix'; } ?>">
