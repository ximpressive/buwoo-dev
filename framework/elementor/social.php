<?php

namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)
class Boutique_Social extends Widget_Base {
 // Machine name or "handle" for the widget
 public function get_name() {
   return __( 'boutique_social', 'boutique' );
 }
 public function get_title() {
   return __( 'Boutique social icons', 'boutique' );
 }
 public function get_icon() {
    return 'eicon-social-icons';
 }
 public function get_keywords() {
   return [ 'social', 'icon', 'link' ];
 }


 protected function _register_controls() {
   $this->start_controls_section(
     'section_social_icon',
     [
       'label' => __( 'Social Icons', 'boutique' ),
     ]
   );

   $repeater = new Repeater();

   $repeater->add_control(
     'social',
     [
       'label' => __( 'Icon', 'boutique' ),
       'type' => Controls_Manager::ICON,
       'label_block' => true,
       'default' => 'fa fa-linkedin',
       'include' => [
         'fa fa-delicious',
         'fa fa-digg',
         'fa fa-dribbble',
         'fa fa-envelope',
         'fa fa-facebook',
         'fa fa-flickr',
         'fa fa-foursquare',
         'fa fa-github',
         'fa fa-google-plus',
         'fa fa-instagram',
         'fa fa-linkedin',
         'fa fa-odnoklassniki',
         'fa fa-meetup',
         'fa fa-pinterest',
         'fa fa-product-hunt',
         'fa fa-reddit',
         'fa fa-rss',
         'fa fa-shopping-cart',
         'fa fa-skype',
         'fa fa-slideshare',
         'fa fa-snapchat',
         'fa fa-soundcloud',
         'fa fa-spotify',
         'fa fa-stack-overflow',
         'fa fa-steam',
         'fa fa-stumbleupon',
         'fa fa-telegram',
         'fa fa-thumb-tack',
         'fa fa-tripadvisor',
         'fa fa-tumblr',
         'fa fa-twitch',
         'fa fa-twitter',
         'fa fa-vimeo',
         'fa fa-vk',
         'fa fa-weibo',
         'fa fa-weixin',
         'fa fa-whatsapp',
         'fa fa-wordpress',
         'fa fa-xing',
         'fa fa-yelp',
         'fa fa-youtube',
         'fa fa-500px',
       ],
     ]
   );

   $repeater->add_control(
     'link',
     [
       'label' => __( 'Link', 'boutique' ),
       'type' => Controls_Manager::URL,
       'label_block' => true,
       'default' => [
         'is_external' => 'true',
       ],
       'placeholder' => __( 'https://your-link.com', 'boutique' ),
     ]
   );

   $this->add_control(
     'social_icon_list',
     [
       'label' => __( 'Social Icons', 'boutique' ),
       'type' => Controls_Manager::REPEATER,
       'fields' => $repeater->get_controls(),
       'default' => [
         [
           'social' => 'fa fa-facebook',
         ],
         [
           'social' => 'fa fa-twitter',
         ],
         [
           'social' => 'fa fa-google-plus',
         ],
       ],
       'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'fa fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
     ]
   );

   $this->add_responsive_control(
     'align',
     [
       'label' => __( 'Alignment', 'boutique' ),
       'type' => Controls_Manager::CHOOSE,
       'options' => [
         'left'    => [
           'title' => __( 'Left', 'boutique' ),
           'icon' => 'fa fa-align-left',
         ],
         'center' => [
           'title' => __( 'Center', 'boutique' ),
           'icon' => 'fa fa-align-center',
         ],
         'right' => [
           'title' => __( 'Right', 'boutique' ),
           'icon' => 'fa fa-align-right',
         ],
       ],
       'default' => 'center',
       'selectors' => [
         '{{WRAPPER}}' => 'text-align: {{VALUE}};',
       ],
     ]
   );

   $this->add_control(
     'view',
     [
       'label' => __( 'View', 'boutique' ),
       'type' => Controls_Manager::HIDDEN,
       'default' => 'traditional',
     ]
   );

   $this->end_controls_section();

   $this->start_controls_section(
     'section_social_style',
     [
       'label' => __( 'Icon', 'boutique' ),
       'tab' => Controls_Manager::TAB_STYLE,
     ]
   );

   $this->add_control(
     'icon_color',
     [
       'label' => __( 'Color', 'boutique' ),
       'type' => Controls_Manager::SELECT,
       'default' => 'default',
       'options' => [
         'default' => __( 'Official Color', 'boutique' ),
         'custom' => __( 'Custom', 'boutique' ),
       ],
     ]
   );

   $this->add_control(
     'icon_primary_color',
     [
       'label' => __( 'Primary Color', 'boutique' ),
       'type' => Controls_Manager::COLOR,
       'condition' => [
         'icon_color' => 'custom',
       ],
       'selectors' => [
         '{{WRAPPER}} .elementor-social-icon' => 'background-color: {{VALUE}};',
       ],
     ]
   );

   $this->add_control(
     'icon_secondary_color',
     [
       'label' => __( 'Secondary Color', 'boutique' ),
       'type' => Controls_Manager::COLOR,
       'condition' => [
         'icon_color' => 'custom',
       ],
       'selectors' => [
         '{{WRAPPER}} .elementor-social-icon i' => 'color: {{VALUE}};',
       ],
     ]
   );

   $this->add_responsive_control(
     'icon_size',
     [
       'label' => __( 'Size', 'boutique' ),
       'type' => Controls_Manager::SLIDER,
       'range' => [
         'px' => [
           'min' => 6,
           'max' => 300,
         ],
       ],
       'selectors' => [
         '{{WRAPPER}} .elementor-social-icon' => 'font-size: {{SIZE}}{{UNIT}};',
       ],
     ]
   );

   $this->add_responsive_control(
     'icon_padding',
     [
       'label' => __( 'Padding', 'boutique' ),
       'type' => Controls_Manager::SLIDER,
       'selectors' => [
         '{{WRAPPER}} .elementor-social-icon' => 'padding: {{SIZE}}{{UNIT}};',
       ],
       'default' => [
         'unit' => 'em',
       ],
       'tablet_default' => [
         'unit' => 'em',
       ],
       'mobile_default' => [
         'unit' => 'em',
       ],
       'range' => [
         'em' => [
           'min' => 0,
           'max' => 5,
         ],
       ],
     ]
   );

   $icon_spacing = is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};';

   $this->add_responsive_control(
     'icon_spacing',
     [
       'label' => __( 'Spacing', 'boutique' ),
       'type' => Controls_Manager::SLIDER,
       'range' => [
         'px' => [
           'min' => 0,
           'max' => 100,
         ],
       ],
       'selectors' => [
         '{{WRAPPER}} .elementor-social-icon:not(:last-child)' => $icon_spacing,
       ],
     ]
   );

   $this->add_group_control(
     Group_Control_Border::get_type(),
     [
       'name' => 'image_border', // We know this mistake - TODO: 'icon_border' (for hover control condition also)
       'selector' => '{{WRAPPER}} .elementor-social-icon',
       'separator' => 'before',
     ]
   );

   $this->add_control(
     'border_radius',
     [
       'label' => __( 'Border Radius', 'boutique' ),
       'type' => Controls_Manager::DIMENSIONS,
       'size_units' => [ 'px', '%' ],
       'selectors' => [
         '{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
       ],
     ]
   );

   $this->end_controls_section();

   $this->start_controls_section(
     'section_social_hover',
     [
       'label' => __( 'Icon Hover', 'boutique' ),
       'tab' => Controls_Manager::TAB_STYLE,
     ]
   );

   $this->add_control(
     'hover_primary_color',
     [
       'label' => __( 'Primary Color', 'boutique' ),
       'type' => Controls_Manager::COLOR,
       'default' => '',
       'condition' => [
         'icon_color' => 'custom',
       ],
       'selectors' => [
         '{{WRAPPER}} .elementor-social-icon:hover' => 'background-color: {{VALUE}};',
       ],
     ]
   );

   $this->add_control(
     'hover_secondary_color',
     [
       'label' => __( 'Secondary Color', 'boutique' ),
       'type' => Controls_Manager::COLOR,
       'default' => '',
       'condition' => [
         'icon_color' => 'custom',
       ],
       'selectors' => [
         '{{WRAPPER}} .elementor-social-icon:hover i' => 'color: {{VALUE}};',
       ],
     ]
   );

   $this->add_control(
     'hover_border_color',
     [
       'label' => __( 'Border Color', 'boutique' ),
       'type' => Controls_Manager::COLOR,
       'default' => '',
       'condition' => [
         'image_border_border!' => '',
       ],
       'selectors' => [
         '{{WRAPPER}} .elementor-social-icon:hover' => 'border-color: {{VALUE}};',
       ],
     ]
   );

   $this->add_control(
     'hover_animation',
     [
       'label' => __( 'Hover Animation', 'boutique' ),
       'type' => Controls_Manager::HOVER_ANIMATION,
     ]
   );

   $this->end_controls_section();

 }


 protected function render() {

   $boutique_social = $this->get_settings_for_display();
   //include( BOUTIQUE_FRAMEWORK . '/elementor/template-parts/social-icons.php' );
   $class_animation = '';

   if ( ! empty( $boutique_social['hover_animation'] ) ) {
     $class_animation = ' elementor-animation-' . $boutique_social['hover_animation'];
   }

   ?>
   <div class="footer-social-media">
       <div class="container-fluid acurate">
           <ul>
             <?php
             foreach ( $boutique_social['social_icon_list'] as $index => $item ) {
               $social = str_replace( 'fa fa-', '', $item['social'] );

               $link_key = 'link_' . $index;

               $this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

               if ( $item['link']['is_external'] ) {
                 $this->add_render_attribute( $link_key, 'target', '_blank' );
               }

               if ( $item['link']['nofollow'] ) {
                 $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
               }
             ?>
               <li><a class="elementor-icon elementor-social-icon elementor-social-icon-<?php echo $social . $class_animation; ?>" <?php echo $this->get_render_attribute_string( $link_key ); ?>>
                 <span class="elementor-screen-only"><?php echo ucwords( $social ); ?></span>
                 <i class="<?php echo $item['social']; ?>"></i>
               </a></li>
             <?php } ?>
           </ul>
       </div>
   </div>
   <?php
 }
 protected function _content_template() {
   ?>
    <div class="footer-social-media">
      <div class="container-fluid acurate">
        <ul>
          <# _.each( settings.social_icon_list, function( item ) {
            var link = item.link ? item.link.url : '',
              social = item.social.replace( 'fa fa-', '' ); #>
              <li><a class="elementor-icon elementor-social-icon elementor-social-icon-{{ social }} elementor-animation-{{ settings.hover_animation }}" href="{{ link }}">
                <span class="elementor-screen-only">{{{ social }}}</span>
                <i class="{{ item.social }}"></i></a>
              </li>
          <# } ); #>
        </ul>
      </div>
    </div>
   <?php
 }


 /**
  * This function controls what category the widget is filed under in the All Widgets toolbar.
  */
 public function get_categories() {
   return [ 'boutique' ];
 }


}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Boutique_Social() );
