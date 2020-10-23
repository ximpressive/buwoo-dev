<?php

namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)
class Buwoo_Masonry_Categories extends Widget_Base {
 // Machine name or "handle" for the widget
 public function get_name() {
   return __( 'buwoo_masoney_cat', 'boutique' );
 }

 public function get_title() {
   return __( 'Woo - Masonry Categories', 'boutique' );
 }

 public function get_icon() {
    return 'eicon-woocommerce';
 }
 /**
 * You register the widget controls (data fields) in this function.
 * A controls reference is available at: https://github.com/pojome/elementor/blob/master/docs/content/controls/reference.
 */
 protected function _register_controls() {
   /*
    * Creates a section called 'section_schedule' inside the Content tab. The editing interface for each Elementor widget
    * is organized into three tabs: Content, Style, and Advanced. Inside each tab, you can define sections, which can be collapsed by the user.
    */

   $this->start_controls_section(
     'boutique_section_filter',
     [
       'label' => __( 'Query', 'boutique' ),
       'tab' => Controls_Manager::TAB_CONTENT,
     ]
   );

   $this->add_control(
     'boutique_pcm_num', // Control key
     [
      'label' => __( 'Categories Count', 'boutique' ), // Control label
      'type' => Controls_Manager::NUMBER, // Type of control
      'min' => 1,
      'mix' => 10,
      'default' => 5,
     ]
   );

   $this->add_control(
     'boutique_source',
     [
       'label' => __( 'Source', 'boutique' ),
       'type' => Controls_Manager::SELECT,
       'options' => [
         ''         => __( 'Show All', 'boutique' ),
         'byid'     => __( 'Manual Selection', 'boutique' ),
         'byparent' => __( 'By Parent', 'boutique' ),
       ],
       'label_block' => true,
     ]
   );

   $categories = get_terms( 'product_cat' );

   $options = [];
   foreach ( $categories as $category ) {
     $options[ $category->term_id ] = $category->name;
   }

   $this->add_control(
     'boutique_categories',
     [
       'label' => __( 'Categories', 'boutique' ),
       'type' => Controls_Manager::SELECT2,
       'options' => $options,
       'default' => [],
       'label_block' => true,
       'multiple' => true,
       'condition' => [
         'boutique_source' => 'byid',
       ],
     ]
   );

   $parent_options = [ '0' => __( 'Only Top Level', 'boutique' ) ] + $options;
   $this->add_control(
     'boutique_parent',
     [
       'label' => __( 'Parent', 'boutique' ),
       'type' => Controls_Manager::SELECT,
       'default' => '0',
       'options' => $parent_options,
       'condition' => [
         'boutique_source' => 'byparent',
       ],
     ]
   );

   $this->add_control(
     'boutique_hide_empty',
     [
       'label' => __( 'Hide Empty', 'boutique' ),
       'type' => Controls_Manager::SWITCHER,
       'default' => '',
       'label_on' => 'Hide',
       'label_off' => 'Show',
     ]
   );

   $this->add_control(
     'boutique_orderby',
     [
       'label' => __( 'Order By', 'boutique' ),
       'type' => Controls_Manager::SELECT,
       'default' => 'name',
       'options' => [
         'name'         => __( 'Name', 'boutique' ),
         'slug'         => __( 'Slug', 'boutique' ),
         'description'  => __( 'Description', 'boutique' ),
         'count'        => __( 'Count', 'boutique' ),
       ],
     ]
   );

   $this->add_control(
     'boutique_order',
     [
       'label' => __( 'Order', 'boutique' ),
       'type' => Controls_Manager::SELECT,
       'default' => 'desc',
       'options' => [
         'asc' => __( 'ASC', 'boutique' ),
         'desc' => __( 'DESC', 'boutique' ),
       ],
     ]
   );

   $this->end_controls_section();

   $this->start_controls_section(
     'boutique_pcm_shopref', // Section key
     [
       'label' => __( 'Shop Reference', 'boutique' ), // Section display name
       'type' => Controls_Manager::SECTION,
       'tab' => Controls_Manager::TAB_CONTENT, // Which tab to display the section in.
     ]
   );

   $this->add_control(
     'boutique_pcm_title', // Control key
     [
      'label' => __( 'Title', 'boutique' ), // Control label
      'type' => Controls_Manager::TEXT, // Type of control
      'default' => __( 'Get yourself ready for summer', 'boutique' ),
			'placeholder' => __( 'Type your title here', 'boutique' ),
     ]
   );
   $this->add_control(
     'boutique_pcm_shdesc', // Control key
     [
      'label' => __( 'Short description', 'boutique' ), // Control label
      'type' => Controls_Manager::TEXTAREA, // Type of control
      'rows' => 4,
      'default' => __( 'Find backless or low back dresses for any occasion.', 'boutique' ),
			'placeholder' => __( 'Type your description here', 'boutique' ),
     ]
   );
   $this->add_control(
     'boutique_pcm_btnref', // Control key
     [
      'label'         => __( 'Shop link', 'boutique' ), // Control label
      'type'          => Controls_Manager::URL, // Type of control
      'placeholder'   => __( 'https://your-link.com', 'boutique' ),
			'show_external' => true,
			'default'       => [
    			'url'         => '',
    			'is_external' => false,
          'nofollow'    => false,
			],
     ]
   );
   // Ends the controls section
   $this->end_controls_section();


 }

 protected function render() {

   $boutique_pcm = $this->get_settings();
   include( BOUTIQUE_FRAMEWORK . '/elementor/template-parts/product-categories.php' );

 }

 /**
  * This function controls what category the widget is filed under in the All Widgets toolbar.
  */
 public function get_categories() {
   return [ 'boutique' ];
 }
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Buwoo_Masonry_Categories() );
