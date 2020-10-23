<?php

/******************************/
/******* Logo versions ********/
/******************************/
if ( !function_exists( 'boutique_site_logo' ) ) {
	function boutique_site_logo(){
		global $boutique;

		$pg_logoversion		=	get_post_meta( get_queried_object_id(), 'boutique_pg_logoversionz', true );
		$header_version   	=   $boutique['header_version'];
		$site_logo      	=   $boutique['boutique-logo']['url'];
	  	$site_logo_retina   =   $boutique['boutique-logo_retina']['url'];
	  	$light_site_logo    =   $boutique['logo_light']['url'];
	  	$retina_l_logo      =   $boutique['logo_lretina']['url'];
	  	$sticky_site_logo   =   $boutique['sticky_hdr_logo']['url'];


		// echo $pg_logoversion. " inFunction page <br>";
		//echo $header_version. " inFunction theme";
		

		if( $pg_logoversion == 'default' ){

			if ( $header_version == 0 ) {
				
				if( $light_site_logo ):
	              echo  '<a class="navbar-brand" href="'. site_url().'">'.
	                '<img src="'. $light_site_logo .'" data-rjs="'. $retina_l_logo . '" alt="'. get_bloginfo( 'name' ) . '" class="bwo_logo lightlogo">
					<img src="'. $sticky_site_logo .'" alt="'. get_bloginfo( 'name' ) . '" class="sticky_logo"></a>';
	            else :
	              echo '<img src="'.BOUTIQUE_THEMEROOT.'/assets/images/logo2.png" alt="">';
	            endif;
	       	
	        }else{

	            if( $site_logo ):
				echo  '<a class="navbar-brand" href="'. site_url().'">'.
				'<img src="'. $site_logo .'" data-rjs="'. $site_logo_retina . '" alt="'. get_bloginfo( 'name' ) . '" class="bwo_logo darklogo">
				<img src="'. $sticky_site_logo .'" alt="'. get_bloginfo( 'name' ) . '" class="sticky_logo">
				</a>';
				else :
					echo '<img src="'.BOUTIQUE_THEMEROOT.'/assets/images/logo2.png" alt="">';
				endif;

	        }

	    }elseif( $pg_logoversion == 'dark' ){ 
	                         
	        if( $site_logo ):
					echo  '<a class="navbar-brand" href="'. site_url().'">'.
					'<img src="'. $site_logo .'" data-rjs="'. $site_logo_retina . '" alt="'. get_bloginfo( 'name' ) . '" class="bwo_logo darklogo">
					<img src="'. $sticky_site_logo .'" alt="'. get_bloginfo( 'name' ) . '" class="sticky_logo"></a>';
			else :
					echo '<img src="'.BOUTIQUE_THEMEROOT.'/assets/images/logo2.png" alt="">';
			endif;

	    }elseif( $pg_logoversion == 'light' ){ 
	                
		    if( $light_site_logo ):
            	echo  '<a class="navbar-brand" href="'. site_url().'">'.
                '<img src="'. $light_site_logo .'" data-rjs="'. $retina_l_logo . '" alt="'. get_bloginfo( 'name' ) . '" class="bwo_logo lightlogo">
				<img src="'. $sticky_site_logo .'" alt="'. get_bloginfo( 'name' ) . '" class="sticky_logo"></a>';
            else :
              echo '<img src="'.BOUTIQUE_THEMEROOT.'/assets/images/logo2.png" alt="">';
            endif;
	    }else{
	    	if ( $header_version == 0 ) {
				
				if( $light_site_logo ):
	              echo  '<a class="navbar-brand" href="'. site_url().'">'.
	                '<img src="'. $light_site_logo .'" data-rjs="'. $retina_l_logo . '" alt="'. get_bloginfo( 'name' ) . '" class="bwo_logo lightlogo">
					<img src="'. $sticky_site_logo .'" alt="'. get_bloginfo( 'name' ) . '" class="sticky_logo"></a>';
	            else :
	              echo '<img src="'.BOUTIQUE_THEMEROOT.'/assets/images/logo2.png" alt="">';
	            endif;
	       	
	        }else{
	        	
	            if( $site_logo ):
				echo  '<a class="navbar-brand" href="'. site_url().'">'.
				'<img src="'. $site_logo .'" data-rjs="'. $site_logo_retina . '" alt="'. get_bloginfo( 'name' ) . '" class="bwo_logo darklogo">
				<img src="'. $sticky_site_logo .'" alt="'. get_bloginfo( 'name' ) . '" class="sticky_logo">
				</a>';
				else :
					echo '<img src="'.BOUTIQUE_THEMEROOT.'/assets/images/logo2.png" alt="">';
				endif;

	        }
	    } 

	}
}
/*********************************/
/******* Theme Header style ******/
/*********************************/
if ( !function_exists( 'boutique_theme_header' ) ) {
	function boutique_theme_header(){

		global $boutique;

		if ( class_exists( 'WooCommerce' ) ) {
		    $shop     =  is_shop();
		    $product  =  is_product();
		    $woo_cat  =  is_product_category();
		}

		$header_gn_layout       =   $boutique['boutique-select-header-layout'];
		$inpage_header_layout   =   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );
		$display_header         =   get_post_meta( get_queried_object_id(), 'boutique_header', true );
		$transparenthdr         =   get_post_meta( get_queried_object_id(), 'boutique_transparenthdr', true );

		if( $display_header == 1  ){
	      if( $inpage_header_layout == '' ) {
	        switch ($header_gn_layout){
				case 'default':
					get_template_part( 'template-parts/header/default', 'header' );
				break;
				case 1:
					get_template_part( 'template-parts/header/header', 'style1' );
				break;
				case 2:
					get_template_part( 'template-parts/header/header', 'style2' );
				break;
				case 3:
					get_template_part( 'template-parts/header/header', 'style3' );
				break;
				case 4:
					get_template_part( 'template-parts/header/header', 'style4' );
				break;
				case 5:
					get_template_part( 'template-parts/header/header', 'style5' );
				break;
				case 6:
					get_template_part( 'template-parts/header/header', 'style6' );
				break;
				default:  get_template_part( 'template-parts/header/default', 'header' );
	        }// Switch statement
	      }else{
	        switch ($inpage_header_layout){
				case 'default':
					get_template_part( 'template-parts/header/default', 'header' );
				break;
				case 'header1':
					get_template_part( 'template-parts/header/header', 'style1' );
				break;
				case 'header2':
					get_template_part( 'template-parts/header/header', 'style2' );
				break;
				case 'header3':
					get_template_part( 'template-parts/header/header', 'style3' );
				break;
				case 'header4':
					get_template_part( 'template-parts/header/header', 'style4' );
				break;
				case 'header5':
					get_template_part( 'template-parts/header/header', 'style5' );
				break;
				case 'header6':
					get_template_part( 'template-parts/header/header', 'style6' );
				break;
	        }// Switch statement
	      }

	    }elseif( $shop || is_home() || is_single() || $product || is_404() || is_search() || $woo_cat  ){
	        switch ($header_gn_layout){
	        	case 'default':
					get_template_part( 'template-parts/header/default', 'header' );
				break;
				case 1:
					get_template_part( 'template-parts/header/header', 'style1' );
				break;
				case 2:
					get_template_part( 'template-parts/header/header', 'style2' );
				break;
				case 3:
					get_template_part( 'template-parts/header/header', 'style3' );
				break;
				case 4:
					get_template_part( 'template-parts/header/header', 'style4' );
				break;
				case 5:
					get_template_part( 'template-parts/header/header', 'style5' );
				break;
				case 6:
					get_template_part( 'template-parts/header/header', 'style6' );
				break;
				default:  get_template_part( 'template-parts/header/default', 'header' );
	        }// Switch statement
	    }
	}
}	
/*********************************/
/******* Theme Footer style ******/
/*********************************/
if ( !function_exists( 'boutique_theme_footer' ) ) {

	function boutique_theme_footer(){

		global $boutique;
		$inpage_footer_layout   =   get_post_meta( get_queried_object_id(), 'boutique_pg_footer_style', true );
		$footer_display         =   get_post_meta( get_queried_object_id(), 'boutique_footer_sh', true );
		$footer_gn_layout       =   $boutique['boutique-footer-style'];
		$footer_layout          =   $boutique['footer-layout'];

		if ( class_exists( 'WooCommerce' ) ) {
		    $shop     =  is_shop();
		    $product  =  is_product();
		    $woo_cat  =  is_product_category();
		}

		if( $footer_display == 1  ){
	      if( $inpage_footer_layout == '' ) {
	        switch ($footer_gn_layout ){
	          case 'footer1':
	            get_template_part( 'template-parts/footer/footer', 'style1' );
	            break;
	          case 'footer2':
	            get_template_part( 'template-parts/footer/footer', 'style2' );
	            break;
	          case  'footer3':
	            get_template_part( 'template-parts/footer/footer', 'style3' );
	            break;
	          case  'footer4':
	            get_template_part( 'template-parts/footer/footer', 'style4' );
	            break;
	          case  'footer5':
	            get_template_part( 'template-parts/footer/footer', 'style5' );
	            break;
	          case  'footer6':
	            get_template_part( 'template-parts/footer/footer', 'style6' );
	            break;
	          default:  get_template_part( 'template-parts/footer/footer', 'style1' );
	        }// Switch statement
	      }else{
	        switch ($inpage_footer_layout){
	          case 'footer1':
	            get_template_part( 'template-parts/footer/footer', 'style1' );
	            break;
	          case 'footer2':
	            get_template_part( 'template-parts/footer/footer', 'style2' );
	            break;
	          case  'footer3':
	            get_template_part( 'template-parts/footer/footer', 'style3' );
	            break;
	          case  'footer4':
	            get_template_part( 'template-parts/footer/footer', 'style4' );
	            break;
	          case  'footer5':
	            get_template_part( 'template-parts/footer/footer', 'style5' );
	            break;
	          case  'footer6':
	            get_template_part( 'template-parts/footer/footer', 'style6' );
	            break;
	          default:  get_template_part( 'template-parts/footer/footer', 'style1' );
	        }// Switch statement
	      }

	  }elseif( $shop || is_home() || is_single() || $product || is_404() || is_search() || $woo_cat  ){
	        switch ($footer_gn_layout){
	          case 'footer1':
	            get_template_part( 'template-parts/footer/footer', 'style1' );
	            break;
	          case 'footer2':
	            get_template_part( 'template-parts/footer/footer', 'style2' );
	            break;
	          case  'footer3':
	            get_template_part( 'template-parts/footer/footer', 'style3' );
	            break;
	          case  'footer4':
	            get_template_part( 'template-parts/footer/footer', 'style4' );
	            break;
	          case  'footer5':
	            get_template_part( 'template-parts/footer/footer', 'style5' );
	            break;
	          case  'footer6':
	            get_template_part( 'template-parts/footer/footer', 'style6' );
	            break;
	          default:  get_template_part( 'template-parts/footer/footer', 'style1' );
	        }// Switch statement
	    }

	}
}

/******************************/
/****** Post View Counter *****/
/******************************/

if ( ! function_exists( 'getPostViews' ) ) {

	function getPostViews($postID){
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return "0 View";
	    }
	    return $count;
	}

}
if ( ! function_exists( 'setPostViews' ) ) {
	function setPostViews($postID) {
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }else{
	        $count++;
	        update_post_meta($postID, $count_key, $count);
	    }
	}
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/******************************/
/******* Social Share ******/
/******************************/

if (!function_exists('buwoo_social_share')) :

    function buwoo_social_share($title = '', $url = '') {
        ?>
			<h4>Share : </h4>
	        <ul>
	            <li><a href="javascript:;" onclick="popUp = window.open('http://www.facebook.com/sharer.php?u=<?php echo $url; ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400'); popUp.focus(); return false"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	            <li><a href="javascript:;" onclick="popUp = window.open('http://twitter.com/share?text=<?php echo $title; ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400'); popUp.focus(); return false"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	            <li><a href="#" onclick="popUp = window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400'); popUp.focus(); return false"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
	            <li><a href="https://plus.google.com/share?url=<?php echo $url; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
	        </ul>
        <?php
    }

endif;





/******************************/
/******* Comment section ******/
/******************************/


function wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

if ( ! function_exists( 'format_comment' ) ) {

	function format_comment($comment, $args, $depth) {
	    if ( 'div' === $args['style'] ) {
	        $tag       = 'div';
	        $add_below = 'comment';
	    } else {
	        $tag       = 'li';
	        $add_below = 'div-comment';
	    }?>
	    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
	    if ( 'div' != $args['style'] ) { ?>
	        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	    <?php } ?>

			<div class="media">
		        <div class="pull-left">
		            <?php 
						if ( $args['avatar_size'] != 0 ) {
			                echo get_avatar( $comment, $args['avatar_size'] ); 
			            } 
					?>
		        </div>
		        <div class="media-body">
		            <h4><?php printf( __( '%s', 'boutique' ), get_comment_author_link() ); ?> <span class="cmt-date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
			                /* translators: 1: date, 2: time */
			                printf( 
			                    __('%1$s'), 
			                    get_comment_date('j M, Y')
			                ); ?>
			            </a></span></h4>
		            <?php edit_comment_link( __( '(Edit)', 'boutique' ), '  ', '' ); ?>
	            	<?php comment_text(); ?>
		            <?php 
		                comment_reply_link( 
		                    array_merge( 
		                        $args, 
		                        array(
		                        	'reply_text'=> __('<span class="flaticon-return-arrow"></span> Reply', 'boutique') ,
		                            'add_below' => $add_below, 
		                            'depth'     => $depth, 
		                            'max_depth' => $args['max_depth'] 
		                        ) 
		                    ) 
		                ); 
			        ?>
			        <?php 
			        if ( $comment->comment_approved == '0' ) { ?>
			            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
			        } ?>
		        </div>
		    </div>
	<?php 
	    if ( 'div' != $args['style'] ) : ?>
	        </div><?php 
	    endif;
	}
}

/*
*	CMB2
*/
function cbfunc( $field ) {
    if( $field == "shop" ) {
	    return false;
	}
}


/*****************************************/
/*********** WPML lang function **********/
/*****************************************/


function buwoo_language_selector_func(){

	
		global $boutique;

		$show_lang_sel 			=	$boutique['show_lang_sel'];
		$lang_display_style 	=	$boutique['wpml_lang_style'];
		$lang_list_style		=	$boutique['language_style'];
		$skip_missing_lang 		= 	$boutique['skip_missing_lang'];

		if( $show_lang_sel == 1 ){

    		$languages = icl_get_languages('skip_missing=0&orderby=code&order=desc');
			
			$lang_count = count($languages);
			$count = 1;

			if(1 < $lang_count){
				$trans_status = esc_html__('translated', 'boutique' );			
			}else{
				$trans_status = esc_html__('not-translated', 'boutique' );
			}

		    if(!empty($languages)){
				echo '<div id="lang-list" class="lang-'. $lang_display_style .' '. $lang_list_style .' '. $trans_status .'" >';
				if($lang_display_style == 'dropdown'){
						//Check If Drop-down Add Current
						if($lang_display_style == 'dropdown'){

							echo '<div id="lang-dropdown-btn">';
								foreach($languages as $l){
									if($l['active']){
										if($lang_list_style == 'lang_code'){
											echo '<span class="langname">'.esc_html( $l['language_code'] ). '</span>';
										}elseif ($lang_list_style == 'lang_name') {
											echo  '<span class="langname">'.icl_disp_language( $l['native_name'], $l['translated_name'] ). '</span>';
										}elseif ($lang_list_style == 'flag') {
											if($l['country_flag_url']){
												echo '<img src="'. esc_url( $l['country_flag_url'] ) .'" height="12" alt="'. esc_attr( $l['language_code'] ).'" width="18" />';
											}
										}elseif ($lang_list_style == 'flag_with_name'){
											if($l['country_flag_url']){
												echo '<img src="'. esc_url( $l['country_flag_url'] ) .'" height="12" alt="'.esc_attr( $l['language_code'] ) .'" width="18" />';
												echo '<span class="langname">' . icl_disp_language($l['native_name'], $l['translated_name']).'</span>';
											}
										}else{
											if($l['country_flag_url']){
												echo '<img src="'. esc_url( $l['country_flag_url'] ) .'" height="12" alt="'.esc_attr( $l['language_code'] ) .'" width="18" />';
												echo '<span class="langname">' . icl_disp_language($l['language_code']).'</span>';
											}
										}
										break;
									}
								}
							if(1 < $lang_count){	
								echo '<i class="fa fa-angle-down" aria-hidden="true"></i></div>';
							}
							else{
								echo '<span class="already-liked">'. esc_html__('Not Translated','boutique' ) .'</span></div>';
							}
						}

					echo '<div class="lang-dropdown-inner">';
				}

				foreach($languages as $l){

					if($l['active']){
						$active_class = ' class="active"';
					}else{
						$active_class = '';
					}
					// lang_code(en / fr / ta)
					if($lang_list_style == 'lang_code'){

						echo '<a href="'.esc_url($l['url']).'"'. $active_class .'><span class="langname">';
						echo esc_html( $l['language_code'] );
						echo '</span></a>';

						if($count != $lang_count && $lang_display_style != 'dropdown'){
							echo '<span class="slash"> /</span>';
						}

					}
					 // lang_name (english, tamil, french)
					elseif ($lang_list_style == 'lang_name') {

						echo '<a href="'.esc_url($l['url']).'"'. $active_class .'><span class="langname">';
						echo icl_disp_language($l['native_name'], $l['translated_name']);
						echo '</span></a>';

						if($count != $lang_count && $lang_display_style != 'dropdown'){
							echo '<span class="slash"> /</span>';
						}
					}
					// display flag
					elseif ($lang_list_style == 'flag'){

						if($l['country_flag_url']){
							echo '<a href="'.esc_url($l['url']).'"'. $active_class .'>';
							echo '<img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'. esc_attr( $l['language_code'] ) .'" width="18" />';
							echo '</a>';
						}
					}
					// flag with name
					elseif($lang_list_style == 'flag_with_name'){
						
						if($l['country_flag_url']){
							echo '<a href="'.esc_url($l['url']).'"'. $active_class .'>';
							echo '<img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'. esc_attr( $l['language_code'] ) .'" width="18" />';
							echo '<span class="langname">' . icl_disp_language($l['native_name']);
							echo '</span></a>';
						}
				
					}elseif($lang_list_style == 'flag_with_code'){

						if($l['country_flag_url']){
							echo '<a href="'.esc_url($l['url']).'"'. $active_class .'>';
							echo '<img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'. esc_attr( $l['language_code'] ) .'" width="18" />';
							echo '<span class="langname">' . icl_disp_language($l['language_code']);
							echo '</span></a>';
						}

					}	
					$count++;
				}

				if($lang_display_style == 'dropdown'){
					echo '</div>';
				}
				echo '</div>';
			}

       	} // active option
       	
}
/*********************************/
/******* Theme Footer style ******/
/*********************************/
function buwoo_page_header_inner_style(){

$pg_inr_header_style		=   get_post_meta( get_queried_object_id(), 'boutique_pg_logoversionz', true );
$pg_inr_header_bg_clr		=   get_post_meta( get_queried_object_id(), 'boutique_pg_hdbg', true );
$pg_inr_header_link_clr		=   get_post_meta( get_queried_object_id(), 'boutique_pg_navitemclr', true );
$pg_inr_header_linkh_clr	=   get_post_meta( get_queried_object_id(), 'boutique_pg_navitemhclr', true );
$pg_inr_header_linkhbg_clr	=   get_post_meta( get_queried_object_id(), 'boutique_pg_navitembghclr', true );

	if ( $pg_inr_header_style != 'default' ) {
	?>
		<style type="text/css">
			/* Header page style through inner page */
	
			.head_dyna,
			.head_dyna nav.navbar-default{
				<?php if ($pg_inr_header_bg_clr): ?>
					background-color: <?php echo $pg_inr_header_bg_clr; ?>;
				<?php endif ?>
				<?php if ($pg_inr_header_link_clr): ?>
					color: <?php echo $pg_inr_header_link_clr; ?>;
				<?php endif ?>
			}
			.head_dyna a,
			.head_dyna nav.navbar-default a,
			.head_dyna .navbar .navbar-nav > li > a{
				<?php if ($pg_inr_header_link_clr): ?>
					color: <?php echo $pg_inr_header_link_clr; ?>;
				<?php endif ?>
			}
			.head_dyna .navbar-default .navbar-nav > li.active > a, 
			.head_dyna .navbar-default .navbar-nav > li > a:hover, 
			.head_dyna .navbar-default .navbar-nav > li > a:focus, 
			.head_dyna a:hover{
				<?php if ($pg_inr_header_linkh_clr): ?>
					color: <?php echo $pg_inr_header_linkh_clr; ?>;
				<?php endif ?>
				<?php if ($pg_inr_header_linkhbg_clr): ?>
					background-color: <?php echo $pg_inr_header_linkhbg_clr; ?>;
				<?php endif ?>
			}
		</style>
	<?php
	}
}
function buwoo_put_style_inheader(){
 	buwoo_page_header_inner_style();
}
add_action('wp_head','buwoo_put_style_inheader');