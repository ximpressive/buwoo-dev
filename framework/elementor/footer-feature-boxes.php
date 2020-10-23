<?php

namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)
class Boutique_Featured_Boxes extends Widget_Base {
 // Machine name or "handle" for the widget
 public function get_name() {
   return __( 'boutique_featured_boxes', 'boutique' );
 }
 public function get_title() {
   return __( 'Footer Featured boxes', 'boutique' );
 }
 public function get_icon() {
    return 'eicon-gallery-grid';
 }


 protected function _register_controls() {
   $this->start_controls_section(
     'footer_featur_boxes',
     [
       'label' => __( 'Footer Featured boxes', 'boutique' ),
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
         'flaticon-box-2',
         'flaticon-circular-arrow',
         'flaticon-help-round-button',
         'flaticon-edit',
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

   $this->add_control(
     'b_featuredboxes',
     [
       'label' => __( 'Featured Box', 'boutique' ),
       'type' => Controls_Manager::REPEATER,
       'fields' => $repeater->get_controls(),
       'default' => [
         [
             'bfb_icon' => 'fa fa-archive',
           'box_title' => 'Delivery Information',
         ],
         [
           'bfb_icon' => 'fa fa-exchange',
           'box_title' => 'Returns & Exchanges',
         ],
         [
           'bfb_icon' => 'fa fa-question-circle',
           'box_title' => 'Help & FAQ',
         ],
         [
           'bfb_icon' => 'fa fa-pencil',
           'box_title' => 'Contact Boutique',
         ],
       ],
       'title_field' => '<i class="{{ bfb_icon }}"></i> {{{ box_title }}}',
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
   //include( BOUTIQUE_FRAMEWORK . '/elementor/template-parts/social-icons.php' );
   ?>
   <div class="inner-help">
      <ul>
        <?php
        foreach ( $boutique_fboxes['b_featuredboxes'] as $index => $item ) {
        ?>
          <li>
              <div class="single-help">
                  <p><i class="<?php echo $item['bfb_icon']; ?>"></i> <?php echo $item['box_title']; ?></p>
              </div>
          </li>
        <?php } ?>
      </ul>
  </div>
   <?php
 }
 protected function _content_template() {
   ?>
   <div class="inner-help">
      <ul>
          <# _.each( settings.b_featuredboxes, function( item ) { #>
              <li>
                <div class="single-help">
                    <p><i class="{{ item.bfb_icon }}"></i> {{{ item.box_title }}}</p>
                </div>
              </li>
          <# } ); #>
        </ul>
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
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Boutique_Featured_Boxes() );
