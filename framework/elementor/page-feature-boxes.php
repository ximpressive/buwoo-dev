<?php

namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)
class Boutique_Featured_Boxes_Pages extends Widget_Base {
 // Machine name or "handle" for the widget
 public function get_name() {
   return __( 'boutique_featured_boxes_pages', 'boutique' );
 }
 public function get_title() {
   return __( 'Page Featured boxes', 'boutique' );
 }
 public function get_icon() {
    return 'eicon-gallery-grid';
 }


 protected function _register_controls() {
   $this->start_controls_section(
     'page_featur_boxes',
     [
       'label' => __( 'Page Featured boxes', 'boutique' ),
     ]
   );

   $repeater = new Repeater();

   $repeater->add_control(
     'bfb_icon',
     [
       'label' => __( 'Icon', 'boutique' ),
       'type' => Controls_Manager::ICON,
       'label_block' => true,
       'default' => 'flaticon-box-2',
       'include' => [
          'fa fa-truck',
          'fa fa-credit-card',
          'fa fa-headphones',
          'fa fa-undo',
          'fa fa-archive',
          'fa fa-exchange',
          'fa fa-question-circle',
          'fa fa-pencil'
       ],
     ]
   );
   $repeater->add_control(
      'box_title', [
        'label' => __( 'Title', 'boutique' ),
        'type' => Controls_Manager::TEXT,
        'placeholder' => __( 'Title' , 'boutique' ),
        'label_block' => true,
      ]
    );
   $repeater->add_control(
      'box_title_small', [
        'label' => __( 'Small title', 'boutique' ),
        'type' => Controls_Manager::TEXT,
        'placeholder' => __( 'Small title' , 'boutique' ),
        'label_block' => true,
      ]
    );

   $this->add_control(
     'b_featuredboxes',
     [
       'label' => __( 'Featured Box', 'boutique' ),
       'type' => Controls_Manager::REPEATER,
       'fields' => $repeater->get_controls(),
       'default' => [
         [
            'bfb_icon'        => 'fa fa-truck',
            'box_title'       => 'Free Delivery',
            'box_title_small' => 'from $100',
         ],
         [
            'bfb_icon'        => 'fa fa-credit-card',
            'box_title'       => 'Safe Payments',
            'box_title_small' => 'safe credit cards',
         ],
         [
            'bfb_icon'        => 'fa fa-headphones',
            'box_title'       => 'Customer Support',
            'box_title_small' => '24/4 feedback',
         ],
         [
            'bfb_icon'        => 'fa fa-undo',
            'box_title'       => 'Free Returns',
            'box_title_small' => 'dont like it ?',
         ],
       ],
       'title_field' => '<i class="{{ bfb_icon }}" aria-hidden="true"></i> {{{ box_title }}} {{{ box_title_small }}}' ,
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

 }


 protected function render() {

   $boutique_fboxes = $this->get_settings_for_display();
   ?>


<div class="features-area">
  <div class="slider-bottom">
    <div class="row row-normalize no-gutters">
      <?php
      foreach ( $boutique_fboxes['b_featuredboxes'] as $index => $item ) {
      ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="media">
            <div class="pull-left">
              <i class="<?php echo $item['bfb_icon']; ?>" aria-hidden="true"></i>
            </div>
            <div class="media-body">
              <h4><?php echo $item['box_title']; ?></h4>
              <span><?php echo $item['box_title_small']; ?></span>
            </div>
          </div> 
        </div>   
      <?php } ?>
    </div>
  </div>  
</div>  
   <?php
 }
 protected function _content_template() {
   ?>
  <div class="features-area">
    <div class="slider-bottom">
      <div class="row row-normalize no-gutters">
        <# _.each( settings.b_featuredboxes, function( item ) { #>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="media">
              <div class="pull-left">
                <i class="{{ item.bfb_icon }}"></i>
              </div>
              <div class="media-body">
                <h4>{{{ item.box_title }}}</h4>
                <span>{{{ item.box_title_small }}}</span>
              </div>
            </div> 
          </div>    
        <# } ); #>
      </div>
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
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Boutique_Featured_Boxes_Pages() );
