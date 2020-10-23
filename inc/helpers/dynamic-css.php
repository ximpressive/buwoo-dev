<?php

$root	=	dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
header("Content-type: text/css; charset=utf-8");
require_once( $root.'/wp-load.php' );
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}


global $boutique; 

	$gn_custom_style	=	$boutique['custom_styles'];
	$hd_custom_style	=	$boutique['custom_styles_header'];
	$mob_custom_style	=	$boutique['custom_styles_mob_nav'];
	$tb_custom_style	=	$boutique['custom_title_bar_styles'];
	$shop_custom_style	=	$boutique['custom_shop_styles'];
	$ft_custom_style	=	$boutique['custom_footer_styles'];


if ( $gn_custom_style == 1 ) {
?>
/* general style */	
body{ 
	color: <?php echo $boutique['body_clr']; ?>; 
	background-color: <?php echo $boutique['body_bg_clr']; ?>; 
}
button, a{ 
	color: <?php echo $boutique['link_clr']; ?>; 
}
button:hover, a:hover{
	color: <?php echo $boutique['link_hover_clr']; ?>;
}
::-moz-selection {
	color: <?php echo $boutique['selection_text_clr']; ?>; 
	background-color: <?php echo $boutique['selection_bg_clr']; ?>;
}
::selection {
	color: <?php echo $boutique['selection_text_clr']; ?>; 
	background-color: <?php echo $boutique['selection_bg_clr']; ?>;
}

#scrollUp{
	color: <?php echo $boutique['scrolltotop_clr']; ?>; 
	background-color: <?php echo $boutique['scrolltotop_bg']; ?>;
}
#scrollUp:hover{
	color: <?php echo $boutique['scrolltotop_clr_hover']; ?>;
	background-color: <?php echo $boutique['scrolltotop_bg_hover']; ?>;
}


<?php } 

if ( $hd_custom_style == 1 ) {
?>	

/* top header */
.top_head_dyna{
	background-color: <?php echo $boutique['t_header_bg_clr']; ?>;
	color: <?php echo $boutique['t_header_txt_clr']; ?>;
}
.top_head_dyna a,
.header10-top-area .header-top-memu ul li a,
.top_head_dyna .header-top-memu ul li a,
.header3-top-area p{
	color: <?php echo $boutique['t_header_link_clr']; ?>;
}
.top_head_dyna a:hover,
.header10-top-area .header-top-memu ul li a:hover,
.top_head_dyna .header-top-memu ul li a:hover{
	color: <?php echo $boutique['t_header_lhover_clr']; ?>;
}


/* main header */
.head_dyna nav.navbar-default,
.head_dyna{
	background-color: <?php echo $boutique['header_bg_clr']; ?>;
	color: <?php echo $boutique['header_txt_clr']; ?>;
}
.head_dyna nav.navbar-default a,
.head_dyna a,
.head_dyna .navbar .navbar-nav > li > a{
	color: <?php echo $boutique['header_link_clr']; ?>;
}
.head_dyna .navbar-default .navbar-nav > li.active > a,
.head_dyna .navbar-default .navbar-nav > li > a:hover, 
.head_dyna .navbar-default .navbar-nav > li > a:focus,
.head_dyna a:hover{
	color: <?php echo $boutique['header_lhover_clr']; ?>;
	background-color: <?php echo $boutique['header_link_bg_hover_clr']; ?>;
}
.head_dyna .navbar .navbar-nav > li > a{
	text-transform: <?php echo $boutique['menu_text_transform']; ?>;
}
.head_dyna .dropdown-menu{ 
	background-color: <?php echo $boutique['sub_menu_bg_clr']; ?>;
}
.head_dyna .dropdown-menu > li > a{
	color: <?php echo $boutique['sub_menu_link_clr']; ?>;
}
.head_dyna .dropdown-menu > li > a:hover, 
.head_dyna .dropdown-menu > li > a:focus{
	color: <?php echo $boutique['sub_menu_lhover_clr']; ?>;
	background-color: <?php echo $boutique['sub_menu_bg_hover_clr']; ?>;
}

.head_dyna.header_sticky.sticky_bg nav.navbar-default{ background-color: transparent; }
.header_sticky.sticky_bg { background-color: <?php echo $boutique['sticky_bg_clr']['rgba']; ?>; }
.header_sticky.sticky_bg .navbar .navbar-nav > li > a{ color: <?php echo $boutique['sticky_link_clr']; ?>; }
.header_sticky.sticky_bg .navbar .navbar-nav > li > a:hover{ }
.header_sticky.sticky_bg .navbar-default .navbar-nav > .open > a, .header_sticky.sticky_bg .navbar-default .navbar-nav > .open > a:hover, .header_sticky.sticky_bg .navbar-default .navbar-nav > .open > a:focus{     color: <?php echo $boutique['sticky_lhover_clr']; ?>; }


@media (min-width: 1080px){

	.navbar-right .mega-menu-parent.dropdown .dropdown-menu,
	.navbar-left .mega-menu-parent.dropdown .dropdown-menu{
		background-color: <?php echo $boutique['mega_menu_bg_clr']; ?>;
	}
	.mega-menu-parent.dropdown .dropdown-menu li h2, 
	.mega-menu-parent.dropdown .dropdown-menu li h3{
		color: <?php echo $boutique['mega_menu_title_clr']; ?>;
	}
	.mega-menu-parent.dropdown .dropdown-menu li.widget ul li a{
		text-transform: <?php echo $boutique['mega_menu_text_transform']; ?>;
		color: <?php echo $boutique['mega_menu_link_clr']; ?>;
	}
	.mega-menu-parent.dropdown .dropdown-menu li.widget ul li a:hover{
		color: <?php echo $boutique['mega_menu_lhover_clr']; ?>;
	}
}

.navbar-default .navbar-toggle{
	background-color: <?php echo $boutique['hambarger_bg_clr']; ?>;
	border: 1px solid <?php echo $boutique['hambarger_link_clr']; ?>;
}
.navbar-default .navbar-toggle .icon-bar{
	background-color: <?php echo $boutique['hambarger_link_clr']; ?>;
}
.navbar-default .navbar-toggle:hover, 
.navbar-default .navbar-toggle:focus{
	background-color: <?php echo $boutique['hambarger_hover_bg_clr']; ?>;
	border-color: <?php echo $boutique['hambarger_link_hover_clr']; ?>;
}
.navbar-default .navbar-toggle:hover .icon-bar, 
.navbar-default .navbar-toggle:focus .icon-bar{
	background-color: <?php echo $boutique['hambarger_link_hover_clr']; ?>;
}

<?php } 

if ( $mob_custom_style == 1 ) {
?>
/* Mobile Menu */

@media (max-width: 1080px){
	.head_dyna nav.navbar-default, .head_dyna{
	    background-color: <?php echo $boutique['mob_headr_bg_clr']; ?>;
	}
	.navbar-default .navbar-collapse, 
	.navbar-default .navbar-form,
	.head_dyna .dropdown-menu{
		background-color: <?php echo $boutique['mob_menu_bg_clr']; ?>;
	}
	.head_dyna .navbar-default .navbar-nav > li > a{
		color: <?php echo $boutique['mob_menu_text_clr']; ?>;
	}
	.head_dyna .navbar-default .navbar-nav > li.active > a, 
	.head_dyna .navbar-default .navbar-nav > li > a:hover, 
	.head_dyna .navbar-default .navbar-nav > li > a:focus, 
	.head_dyna a:hover{
		color: <?php echo $boutique['mob_menu_lhover_clr']; ?>;
    	background-color: <?php echo $boutique['mob_menu_hover_bg_clr']; ?>;	
	}
}

<?php } 

if ( $tb_custom_style == 1 ) {
?>
/* Title bar */

.breadcumb-area{ 
	background-color: <?php echo $boutique['title_bg_clr']; ?>;
	position: relative;
}
.breadcumb-area:before{
	content: "";
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background-color: <?php echo $boutique['title_overlay_bg_clr']; ?>;
    opacity: <?php echo $boutique['title_overlay_opacity']; ?>;
}
.breadcumb-area.without-bg{
	background-image: url('<?php echo $boutique['title_bg_img']['url']; ?>');
}
.breadcumb-area h2,
.breadcumb-area ul li,
.breadcumb-area ul li a{ 
	color: <?php echo $boutique['title_text_clr']; ?>;
}

.breadcumb-area.spp_breadcumb { background-color: <?php echo $boutique['breadcumb_bg_clr']; ?>; }
.breadcumb-area.spp_breadcumb ul li a, 
.breadcumb-area.spp_breadcumb ul li{ color: <?php echo $boutique['breadcumb_text_clr']; ?>; }


<?php } 

if ( $ft_custom_style == 1 ) {
?>	

.footer_dyna .main-footer-area,
.footer_dyna .footer-top-area,
.footer_dyna .section.footer-top-area.home-v6,
.footer_dyna .footer-five-middle-area,
.footer_dyna .footer-five-middle-bottom-area,
.footer_dyna .footer-three-top-area,
.footer_dyna .footer-four-top-area{
	background-color: <?php echo $boutique['ft_bg_clr']; ?>;
}
.footer_dyna .widget h2.widget-title,
.footer_dyna .widget h3.widget-title,
.footer_dyna h3,
.footer_dyna h2{
	color: <?php echo $boutique['ft_title_clr']; ?>;
}
.footer_dyna .widget p,
.footer_dyna p{
	color: <?php echo $boutique['ft_text_clr']; ?>;
}
.footer_dyna a,
.footer_dyna .footer-top-area.home-v6 .single-footer-menu li a,
.footer_dyna .footer-five-middle-bottom-area .single-footer-menu li a,
.footer_dyna .footer-four-top-area .phone-number h4 i,
.footer_dyna .footer-three-top-area i.flaticon-smartphone,
.footer_dyna .main-footer-area .widget.link ul li a, 
.footer_dyna .main-footer-area ul li a{
	color: <?php echo $boutique['ft_link_clr']; ?>;
}
.footer_dyna a:hover,
.footer_dyna .footer-top-area.home-v6 .single-footer-menu li a:hover,
.footer_dyna .footer-five-middle-bottom-area .single-footer-menu li a:hover,
.footer_dyna .footer_dyna .main-footer-area ul li a:hover{
	color: <?php echo $boutique['ft_link_hover_clr']; ?>;
}

.footer_dyna .footer-bottom-area,
.footer_dyna .footer-bottom-three-area,
.footer_dyna .footer-bottom-four-area{
	background-color: <?php echo $boutique['cp_bg_clr']; ?>;
}
.footer_dyna .footer-bottom-area p,
.footer_dyna .footer-bottom-three-area p,
.footer_dyna .footer-bottom-four-area p{
	color: <?php echo $boutique['cp_text_clr']; ?>;
}
.footer_dyna .footer-bottom-area a,
.footer_dyna .footer-bottom-three-area a,
.footer_dyna .footer-bottom-four-area a,
.footer-bottom-area .social-media ul li a{
	color: <?php echo $boutique['cp_link_clr']; ?>;
}
.footer_dyna .footer-bottom-area a:hover,
.footer_dyna .footer-bottom-three-area a:hover,
.footer_dyna .footer-bottom-four-area a:hover{
	color: <?php echo $boutique['cp_link_hover_clr']; ?>;
}
<?php } 

if ( $shop_custom_style == 1 ) {
?>

/* Shop Page style */

.woocommerce ul.products li.product .woocommerce-loop-category__title, 
.woocommerce ul.products li.product .woocommerce-loop-product__title, 
.woocommerce ul.products li.product h3{
	color: <?php echo $boutique['title_pd_clr']; ?>;
}
.woocommerce .single-products .newsn_pd span ins span{
	color: <?php echo $boutique['price_txt_clr']; ?>;
}

.woocommerce .single-products .button, 
.woocommerce .single-products .added_to_cart{
	color: <?php echo $boutique['atc_button_text_clr']; ?>;
	background-color: <?php echo $boutique['atc_button_bg_clr']; ?>;
	border-radius: <?php echo $boutique['btn_radius'].'px'; ?>;
}
.woocommerce .single-products:hover .button:hover,
.woocommerce .single-products:hover .added_to_cart:hover{ 
	color: <?php echo $boutique['atc_button_text_hover_clr']; ?>;
	background-color: <?php echo $boutique['atc_button_bg_hover_clr']; ?>;
}
.woocommerce .single-products .newsn_pd span.onsale{
	background-color: <?php echo $boutique['label_sale_clr']; ?>;
	color: <?php echo $boutique['atc_button_text_clr']; ?>;
}
.woocommerce .single-products .newsn_pd span.soldout{
	background-color: <?php echo $boutique['label_soldout_clr']; ?>;
}
.woocommerce div.product form.cart .single_add_to_cart_button,
.single-products .button, .single-products .added_to_cart{ 
	border-radius: <?php echo $boutique['btn_radius'].'px'; ?>;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-range{
	background-color: <?php echo $boutique['price_slide_clr']; ?> !important;
}
.shop-sidebar-area .widget h2, 
.shop-sidebar-area .widget h3{ 
	color: <?php echo $boutique['sidebar_title_clr']; ?>;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{
	border-color: <?php echo $boutique['price_slide_clr']; ?>;
}
.widget_product_categories ul li a, 
.shop-sidebar-area .woocommerce-widget-layered-nav-list li a{
	color: <?php echo $boutique['attributes_item_clr']; ?>;
}
.shop-sidebar-area .woocommerce.widget_product_categories ul li:hover a,
.shop-sidebar-area .woocommerce-widget-layered-nav-list li:hover a{ 
	color: <?php echo $boutique['attributes_itemhover_clr']; ?>; 
}
.shop-sidebar-area .woocommerce.widget_product_categories li:hover span.count,
.shop-sidebar-area .woocommerce-widget-layered-nav-list li:hover span.count{ 
	background-color: <?php echo $boutique['attributes_itemhover_clr']; ?>; 
}

/* Shop Single Page style */

.single-product-area .product-details h3, 
.single-product-area .product-details h1,
.related.products .single-products h2.woocommerce-loop-product__title{
	color: <?php echo $boutique['sp_title_clr']; ?>;
}
.single-product-area .product-details span, 
.woocommerce div.product p.price, 
.woocommerce div.product span.price,
.single-product-area .product-details span.posted_in a,
.single-product-area .panel-default > .panel-heading .panel-title a span{
	color: <?php echo $boutique['sp_price_clr']; ?>;
}
.single-products .newsn_pd span.onsale, 
.single-product-area span.onsale{
	background-color: <?php echo $boutique['label_sale_clr']; ?>;
	color: <?php echo $boutique['atc_button_text_clr']; ?>;
}
.woocommerce div.product form.cart .single_add_to_cart_button, 
.single-products .button, .single-products .added_to_cart{
	background: <?php echo $boutique['sp_button_bg_clr']; ?>;
	color: <?php echo $boutique['sp_button_text_clr']; ?>;
}
.woocommerce div.product form.cart .single_add_to_cart_button:hover{
	background: <?php echo $boutique['sp_button_bg_hover_clr']; ?>;
	color: <?php echo $boutique['sp_button_texthover_clr']; ?>;	
}
.woocommerce .widget_price_filter .price_slider_amount .button:hover{
	background: <?php echo $boutique['sp_button_bg_hover_clr']; ?>;
}

<?php } ?>




