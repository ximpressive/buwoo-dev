<?php

namespace Elementor; 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)
class Bourique_Products extends Widget_Base {

	// Machine name or "handle" for the widget
	public function get_name() {
		return __( 'boutique-products', 'boutique' );
	}
	public function get_title() {
		return __( 'Woo - Products', 'boutique' );
	}
	public function get_icon() {
		return 'eicon-woocommerce';
	}
	public function get_categories() {
		return [ 'boutique' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'boutique' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
	    $this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'boutique' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'12' => '1',
					'6' => '2',
					'4' => '3',
					'3' => '4',
					'2' => '6',
				],
				'default' => '4',
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Products Count', 'boutique' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '4',
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
			'filter_by',
			[
				'label' => __( 'Filter By', 'boutique' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'None',
				'options' => [
					'' 			=> __( 'None', 'boutique' ),
					'_featured' => __( 'Featured', 'boutique' ),
					'_sale' 	=> __( 'Sale', 'boutique' ),
					'_category' => __( 'Category', 'boutique' ),
				],
			]
		);

		$categories = get_terms( 'product_cat' );

		   $options = [];
		   foreach ( $categories as $category ) {
		     $options[ $category->term_id ] = $category->name;
		   }

		$this->add_control(
			'productcategories',
			[
				'label' => __( 'Categories', 'boutique' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $options,
				'default' => [],
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'filter_by' => '_category',
				],
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
		    //'meta_query'  	=>	$meta_query,
		    'post_status'   		=> 'publish',
		);
		if ( '_featured' === $settings['filter_by'] ) {
			$query_args['tax_query'][] = [
				'taxonomy' 	=> 'product_visibility',
				'field' 	=> 'name',
				'terms'		=> 'featured',
			];
		}

		if ( '_sale' === $settings['filter_by'] ) {
			// From WooCommerce `sale_products` shortcode
			$query_args['post__in'] = array_merge( [ 0 ], wc_get_product_ids_on_sale() );
		}

		if ( '_category' === $settings['filter_by'] ) {

			$query_args['tax_query'][] = [
				'taxonomy' 	=>	'product_cat',
				'field' 	=>	'term_id',
				'terms'		=>	$settings['productcategories'],
			];
		}
		/** @var \WP_Query $query */
		$query = new \WP_Query( $query_args );

		if ( ! $query->have_posts() ) {
			return;
		}

		global $woocommerce_loop;

		$woocommerce_loop['columns'] = (int) $settings['columns'];

		//Module::instance()->add_products_post_class_filter();
		echo '<div class="woocommerce pdct">';
			while ( $query->have_posts() ) : $query->the_post();
				echo '<div class="col-md-' . $woocommerce_loop['columns'] . ' single-products">';
				 	get_template_part( 'woocommerce/content', 'product' );
				 	//echo '<br clear="all">';
				echo '</div>';
			endwhile;
			wp_reset_postdata();
		echo '</div><br clear="all">';
		//Module::instance()->remove_products_post_class_filter();
	}

}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Bourique_Products() );
