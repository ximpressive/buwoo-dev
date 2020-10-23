<?php

namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)
class Bourique_Blog_Posts extends Widget_Base {

	// Machine name or "handle" for the widget
	 public function get_name() {
	   return __( 'boutique-blog-posts', 'boutique' );
	 }
	 public function get_title() {
	   return __( 'Blog Posts', 'boutique' );
	 }
	 public function get_icon() {
	    return 'eicon-featured-image';
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
				'default' => 'post',
			]
		);

		$this->add_control(
			'cat-ids',
			[
				'label' => __( 'Category ID', 'boutique' ),
				'type' => Controls_Manager::TEXT,
				'description'	=>	__( 'Separete with comma.', 'boutique' )
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
					'author' 		=> __( 'Author', 'boutique' ),
					'comment_count' => __( 'Number of comments', 'boutique' ),
					'type' 			=> __( 'Post Type', 'boutique' ),
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

		$tmid	=	$settings['cat-ids']; //$settings['cat-ids'];
		$args 	=	array( 'include' => $tmid );

		$postquery_args	=	array(
			'post_type' 			=>	$settings['post_type'],
			'posts_per_page'		=>	$settings['posts_per_page'],
			'orderby'				=>	$settings['orderby'],
			'order'					=>	$settings['order'],
		    'tax_query' => array(
							array(
								'taxonomy' =>	'category',
								'terms'    =>	explode(",",$tmid),	
							),
						),
		    'post_status'   		=> 'publish',
		);
		if ( empty($settings['cat-ids'])) {
			    unset($postquery_args["tax_query"]);
		}

		/** @var \WP_Query $query */
		$thequery = new \WP_Query( $postquery_args );

		if ( ! $thequery->have_posts() ) {
			return;
		}

		echo '<div class="journal-area">';
			while ( $thequery->have_posts() ) : $thequery->the_post();
				$c = get_the_category();
				echo '<div class="col-md-'. $settings['columns'] .' col-sm-6 col-xs-12">';
					echo '<div class="single-journal">';
						echo '<div class="image">';
								echo '<a href="'. get_the_permalink() .'">';
									if( has_post_thumbnail() ){
										 the_post_thumbnail( 'blockthumb' );
									} 	
								echo '</a>';
						echo '</div>';
						echo '<span class="postcat_ele">'. $c[0]->cat_name .'</span>';
						echo '<h3 class="posttitle_ele"><a href="'. get_the_permalink() .'">'.get_the_title().'</a></h3>';
					echo '</div>';
				echo '</div>';			
			endwhile;
			wp_reset_postdata();
			echo '<br clear="all">';
		echo '</div>';
	}

 /**
  * This function controls what category the widget is filed under in the All Widgets toolbar.
  */
 public function get_categories() {
   return [ 'boutique' ];
 }


}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Bourique_Blog_Posts() );
