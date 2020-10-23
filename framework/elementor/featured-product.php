<?php

namespace Elementor; 

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */
class BuWoo_Featured_Product extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return __( 'buwoo-featured-products', 'boutique' );
	}

		/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Woo - Featured Products', 'boutique' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-woocommerce';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'boutique' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

	protected function _register_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'boutique' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style_fproducts',
			[
				'label' => __( 'Style', 'boutique' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fp_slider' => __( 'Slider', 'boutique' ),
					'fp_grid' 	=> __( 'Grid', 'boutique' ),
				],
				'default' => 'fp_slider',
			]
		);
		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'boutique' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'slider' => '1',
					'6' => '2',
					'4' => '3',
					'3' => '4',
					'2' => '6',
				],
				'default' => '4',
				'condition' => [
					'style_fproducts' => 'fp_grid',
				],
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Products Count', 'boutique' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '-1',
				'description' => __('Put "-1" to display all posts','boutique'),
				'condition' => [
					'style_fproducts' => 'fp_grid',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter',
			[
				'label' => __( 'Query', 'boutique' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_type',
			[
				'label' =>  __( 'Post Type', 'boutique' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'product',
			]
		);

		$this->add_control(
			'advanced',
			[
				'label' => __( 'Advanced', 'boutique' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'boutique' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' 			=> __( 'Date', 'boutique' ),
					'title' 		=> __( 'Title', 'boutique' ),
					'price' 		=> __( 'Price', 'boutique' ),
					'popularity' 	=> __( 'Popularity', 'boutique' ),
					'rating' 		=> __( 'Rating', 'boutique' ),
					'rand' 			=> __( 'Random', 'boutique' ),
					'menu_order' 	=> __( 'Menu Order', 'boutique' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'boutique' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => __( 'ASC', 'boutique' ),
					'desc' => __( 'DESC', 'boutique' ),
				],
			]
		);

		$this->end_controls_section();
	}
	

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	public function render() {
		$settings = $this->get_settings();

		// Default ordering args
		$ordering_args = WC()->query->get_catalog_ordering_args( $settings['orderby'], $settings['order'] );

		$query_args	=	array(
			'post_type' 			=>	$settings['post_type'],
			'posts_per_page'		=>	$settings['posts_per_page'],
			'orderby'				=>	$ordering_args['orderby'],
			'order'					=>	$ordering_args['order'],
			'ignore_sticky_posts' 	=>	1,
		    'post_status'   		=> 'publish',
		    'tax_query' => array(
				array(
					'taxonomy' 	=> 'product_visibility',
					'field' 	=> 'name',
					'terms'		=> 'featured',
				),
			),
		);
		/** @var \WP_Query $query */
		$query = new \WP_Query( $query_args );

		if ( ! $query->have_posts() ) {
			return;
		}

		global $woocommerce_loop;

		$woocommerce_loop['columns'] = (int) $settings['columns'];

		if( $settings['style_fproducts'] == 'fp_slider' ){
			$p_sl_class	=	"fproduct_slider owl-carousel owl-theme";
			$i_sl_class	=	"single-products item";
		}else{
			$i_sl_class		=	'col-md-' . $woocommerce_loop['columns'] . ' single-products';
		}

		echo '<div class="woocommerce pdct '.$p_sl_class.'">';
			while ( $query->have_posts() ) : $query->the_post();
				echo '<div class="'.$i_sl_class.'">';
				 	get_template_part( 'woocommerce/content', 'product' );
				 	echo '<br clear="all">';
				echo '</div>';
			endwhile;
			wp_reset_postdata();
		echo '</div><br clear="all">';
	}

	

}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\BuWoo_Featured_Product() );
