<?php

namespace Elementor; 

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class BuWoo_Category_Carousel extends Widget_Base {
 // Machine name or "handle" for the widget
 public function get_name() {
   return __( 'buwoo_cat_carousel', 'boutique' );
 }

 public function get_title() {
   return __( 'BuWoo - Category Carousel', 'boutique' );
 }

 public function get_icon() {
    return 'eicon-woocommerce';
 }
 public function get_categories() {
   return [ 'boutique' ];
 }

 protected function _register_controls() {
   /*
    * Creates a section called 'section_schedule' inside the Content tab. The editing interface for each Elementor widget
    * is organized into three tabs: Content, Style, and Advanced. Inside each tab, you can define sections, which can be collapsed by the user.
    */

   $this->start_controls_section(
     'buwoo_section_filter',
     [
       'label' => __( 'Query', 'boutique' ),
       'tab' => Controls_Manager::TAB_CONTENT,
     ]
   );

   $this->add_control(
     'buwoo_pcm_num', // Control key
     [
      'label' => __( 'Categories Count', 'boutique' ), // Control label
      'type' => Controls_Manager::NUMBER, // Type of control
      'min' => 1,
      'mix' => 10,
      'default' => 5,
     ]
   );

   $this->add_control(
     'buwoo_source',
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
     'buwoo_categories',
     [
       'label' => __( 'Categories', 'boutique' ),
       'type' => Controls_Manager::SELECT2,
       'options' => $options,
       'default' => [],
       'label_block' => true,
       'multiple' => true,
       'condition' => [
         'buwoo_source' => 'byid',
       ],
     ]
   );

   $parent_options = [ '0' => __( 'Only Top Level', 'boutique' ) ] + $options;
   $this->add_control(
     'buwoo_parent',
     [
       'label' => __( 'Parent', 'boutique' ),
       'type' => Controls_Manager::SELECT,
       'default' => '0',
       'options' => $parent_options,
       'condition' => [
         'buwoo_source' => 'byparent',
       ],
     ]
   );

   $this->add_control(
     'buwoo_hide_empty',
     [
       'label' => __( 'Hide Empty', 'boutique' ),
       'type' => Controls_Manager::SWITCHER,
       'default' => '',
       'label_on' => 'Hide',
       'label_off' => 'Show',
     ]
   );

   $this->add_control(
     'buwoo_orderby',
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
     'buwoo_order',
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

/*******************************/
/******** Styling Tab **********/
/*******************************/ 
    /*************************/
    $this->start_controls_section(
      'main_section',
      [
        'label' =>  __( 'Section', 'boutique' ),
        'tab'   =>  Controls_Manager::TAB_STYLE,
      ]
    );
      $this->add_control(
        'section_bg_color',
        [
          'label' => __( 'Background Color', 'boutique' ),
          'type' => Controls_Manager::COLOR,
          'default' => '#424242',
          'selectors' => [
            '{{WRAPPER}} .catproducts .itminner' => 'background-color: {{VALUE}}',
            '{{WRAPPER}} .loop_cat_products .catproducts .owl-nav' => 'background-color: {{VALUE}}',
            '{{WRAPPER}} .catproducts .itminner .pd-info' => 'background-color: {{VALUE}}',
           ], 
        ]
      );
    $this->end_controls_section();
    $this->start_controls_section(
      'title_section',
      [
        'label' =>  __( 'Title', 'boutique' ),
        'tab'   =>  Controls_Manager::TAB_STYLE,
      ]
    );
      $this->add_group_control(
        Group_Control_Typography::get_type(),
          [
            'name'      => 'title_typography',
            'label'     =>  __( 'Title Typography', 'boutique' ),
            'selector'  => '{{WRAPPER}} .pd-info h3',
          ]
      );
      $this->add_control(
        'title_color',
        [
          'label' => __( 'Title Color', 'boutique' ),
          'type' => Controls_Manager::COLOR,
          'default' => '#ffffff',
          'selectors' => [
            '{{WRAPPER}} .pd-info h3' => 'color: {{VALUE}}',
           ],
        ]
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
          [
            'name'      => 'cat_typography',
            'label'     =>  __( 'Category Typography', 'boutique' ),
            'selector'  => '{{WRAPPER}} .pd-info h5',
          ]
      );
      $this->add_control(
        'cat_title_color',
        [
          'label' => __( 'Category Color', 'boutique' ),
          'type' => Controls_Manager::COLOR,
          'default' => '#919191',
          'selectors' => [
            '{{WRAPPER}} .pd-info h5' => 'color: {{VALUE}}',
          ],
        ]
      );
    $this->end_controls_section(); 

    /**************/
    $this->start_controls_section(
      'content_section',
      [
        'label' =>  __( 'Content', 'boutique' ),
        'tab'   =>  Controls_Manager::TAB_STYLE,
      ]
    );
      $this->add_group_control(
          Group_Control_Typography::get_type(),
            [
              'name'      => 'price_typography',
              'label'     =>  __( 'Price Typography', 'boutique' ),
              'selector'  => '{{WRAPPER}} .loop_cat_products .catproducts .pd-info h4 span, {{WRAPPER}} .loop_cat_products .catproducts .pd-info h4, {{WRAPPER}} .loop_cat_products .catproducts .pd-info h4 del',
            ]
        );
      $this->add_control(
          'price_color',
          [
            'label' => __( 'Price Color', 'boutique' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffb701',
            'selectors' => [
              '{{WRAPPER}} .loop_cat_products .catproducts .pd-info h4' => 'color: {{VALUE}}',
              '{{WRAPPER}} .loop_cat_products .catproducts .pd-info h4 span' => 'color: {{VALUE}}',
              '{{WRAPPER}} .loop_cat_products .catproducts .pd-info h4 del' => 'color: {{VALUE}}',
            ],
          ]
      );
      $this->add_group_control(
          Group_Control_Typography::get_type(),
            [
              'name'      => 'content_typography',
              'label'     =>  __( 'Content Typography', 'boutique' ),
              'selector'  => '{{WRAPPER}} .loop_cat_products .catproducts .pd-info p',
            ]
        );
      $this->add_control(
          'content_color',
          [
            'label' => __( 'Content Color', 'boutique' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#929292',
            'selectors' => [
              '{{WRAPPER}} .loop_cat_products .catproducts .pd-info p' => 'color: {{VALUE}}',
            ],
          ]
      );
      
    $this->end_controls_section(); 

    /**************/
    $this->start_controls_section(
      'button_section',
      [
        'label' =>  __( 'Button Style', 'boutique' ),
        'tab'   =>  Controls_Manager::TAB_STYLE,
      ]
    ); 

      $this->add_group_control(
        Group_Control_Typography::get_type(),
          [
            'name'      => 'btn_text_typography',
            'selector'  => '{{WRAPPER}} .loop_cat_products .catproducts .pd-info .pdshp .pd_atc .button',
          ]
      );

      $this->start_controls_tabs(
        'style_tabs_btn'
      );

        $this->start_controls_tab(
          'style_normal_tab-btn',
          [
            'label' => __( 'Normal', 'boutique' ),
          ]
        );

          $this->add_group_control(
            Group_Control_Border::get_type(),
            [
              'name' => 'atc_border',
              'label' => __( 'Border Type', 'boutique' ),
              'selector' => '{{WRAPPER}} .loop_cat_products .catproducts .pd-info .pdshp .pd_atc .button',
            ]
          );
          $this->add_control(
              'btn_text_color',
              [
                'label' => __( 'Text Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#252525',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .catproducts .pd-info .pdshp .pd_atc .button' => 'color: {{VALUE}}',
                ],
              ]
          );
          $this->add_control(
              'btn_bg_color',
              [
                'label' => __( 'Background Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffb701',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .catproducts .pd-info .pdshp .pd_atc .button' => 'background-color: {{VALUE}}',
                ],
              ]
          );
        $this->end_controls_tab();/* endNormal */

        $this->start_controls_tab(
          'style_hover_tab',
          [
            'label' => __( 'Hover', 'boutique' ),
          ]
        );

          $this->add_group_control(
            Group_Control_Border::get_type(),
            [
              'name' => 'atc_hover_border',
              'label' => __( 'Border Type', 'boutique' ),
              'selector' => '{{WRAPPER}} .loop_cat_products .catproducts .pd-info .pdshp .pd_atc .button:hover',
            ]
          );
          $this->add_control(
              'btn_hover_color',
              [
                'label' => __( 'Text Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#252525',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .catproducts .pd-info .pdshp .pd_atc .button:hover' => 'background-color: {{VALUE}}',
                ],
              ]
          );
          $this->add_control(
              'btn_bg_hover_color',
              [
                'label' => __( 'Background Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffc940',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .catproducts .pd-info .pdshp .pd_atc .button:hover' => 'background-color: {{VALUE}}',
                ],
              ]
          );

        $this->end_controls_tab();/* endhover */

      $this->end_controls_tabs();

    $this->end_controls_section(); 
    /**************/
    $this->start_controls_section(
      'slider_style_section',
      [
        'label' =>  __( 'Slider Style', 'boutique' ),
        'tab'   =>  Controls_Manager::TAB_STYLE,
      ]
    );
      $this->start_controls_tabs(
        'slider_style_tabs'
      );

        $this->start_controls_tab(
          'slider_style_normal_tab',
          [
            'label' => __( 'Normal', 'boutique' ),
          ]
        );

            
            $this->add_control(
              'arrow_text_color',
              [
                'label' => __( 'Navigation Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#d3d3d3',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .catproducts .owl-nav [class*="owl-"]' => 'color: {{VALUE}}',
                ],
              ]
            );
            $this->add_control(
              'arrow_bg_color',
              [
                'label' => __( 'Navigation Background Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#797979',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .catproducts .owl-nav [class*="owl-"]' => 'background-color: {{VALUE}}',
                ],
              ]
            );
            $this->add_control(
              'dots_bg_color',
              [
                'label' => __( 'Dots Background Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#797979',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .slick-dots li button' => 'background-color: {{VALUE}}',
                ],
              ]
            );

        $this->end_controls_tab();

        $this->start_controls_tab(
          'slider_style_hover_tab',
          [
            'label' => __( 'Hover', 'boutique' ),
          ]
        );

          $this->add_control(
              'arrow_text_hover_color',
              [
                'label' => __( 'Navigation Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#d3d3d3',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .catproducts .owl-nav [class*="owl-"]:hover' => 'color: {{VALUE}}',
                ],
              ]
            );
            $this->add_control(
              'arrow_bg_hover_color',
              [
                'label' => __( 'Navigation Background Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffb701',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .catproducts .owl-nav [class*="owl-"]:hover' => 'background-color: {{VALUE}}',
                ],
              ]
            );
            $this->add_control(
              'dots_bg_hover_color',
              [
                'label' => __( 'Dots Background Color', 'boutique' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffb701',
                'selectors' => [
                  '{{WRAPPER}} .loop_cat_products .slick-dots li.slick-active button' => 'background-color: {{VALUE}}',
                  '{{WRAPPER}} .loop_cat_products .slick-dots li:hover button' => 'background-color: {{VALUE}}',
                  '{{WRAPPER}} .loop_cat_products .slick-dots li:focus button' => 'background-color: {{VALUE}}',
                ],
              ]
            );
        $this->end_controls_tab();

      $this->end_controls_tabs();

    $this->end_controls_section(); 

}

  protected function render() {

    $buwoo_pcm = $this->get_settings();
    include( BOUTIQUE_FRAMEWORK . '/elementor/template-parts/product-category-carousel.php' );

  }
  protected function _content_template() {

    //include( BOUTIQUE_FRAMEWORK . '/elementor/template-parts/product-category-carousel_js.php' );

  } 

}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\BuWoo_Category_Carousel() );
