<?php

namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)
class Buwoo_Isotope_Category extends Widget_Base {

	// Machine name or "handle" for the widget
	 public function get_name() {
	   return __( 'buwoo-isotope-category', 'boutique' );
	 }
	 public function get_title() {
	   return __( 'Woo - Isotope Products', 'boutique' );
	 }
	 public function get_icon() {
	    return 'eicon-woocommerce';
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
			'layout_style_isotop',
			[
				'label' => __( 'Select Style', 'boutique' ),
				'type' => Controls_Manager::SELECT,
				'options' 	=> [
					'classic' 	=> __( 'Classic', 'boutique' ),
					'modern' 	=> __( 'Modern', 'boutique' ),
				],
				'default' => 'modern',
			]
		);
	    $this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'boutique' ),
				'type' => Controls_Manager::SELECT,
				'options' 	=> [
					'12' 	=> __( '1', 'boutique' ),
					'6' 	=> __( '2', 'boutique' ),
					'4' 	=> __( '3', 'boutique' ),
					'3' 	=> __( '4', 'boutique' ),
				],
				'default' => '3',
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
			'posts_per_page',
			[
				'label' => __( 'Products Count', 'boutique' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '9',
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
		     'cat-ids',
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

		$this->end_controls_section();
	}
	
  	public function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['layout_style_isotop'] == 'modern' ) {
			$modern = "modern_style";
		}
?>


		<div class="category-product-area">
			<div class="category-menu">
		        <ul id="filters" class="nav nav-tabs <?php echo $modern; ?>">
		        	<li><a href="#" data-filter="*" class="selected">All</a></li>
		            <?php 
		            	//$tmid	=	$settings['cat-ids'];
    					$attributes = $settings['cat-ids'];
    					$attributes['ids'] = $settings['cat-ids'];
						$args 	=	array( 'include' => $attributes );
						$terms 	=	get_terms("product_cat", $args); 
						$count 	=	count($terms);						
						if ( $count > 0 ){ 
							foreach ( $terms as $term ) {
								echo "<li><a href='#' data-filter='.".$term->slug."'>" . $term->name . "</a></li>\n";
							}
						} 
					?>
		        </ul>
		    </div>

		    <div class="filter-content">
				<?php 
					$tmid	=	$attributes;
					$arg = array(
							'post_type' 		=>	'product', 
							'posts_per_page'	=>	$settings['posts_per_page'],
							'tax_query' => array(
								array(
									'taxonomy' =>	'product_cat',
									'terms'    =>	$attributes,	
								),
							),

						);
					if ( empty($settings['cat-ids'])) {
					    unset($arg["tax_query"]);
					}

					$the_query = new \WP_Query( $arg ); 
					if ( $the_query->have_posts() ) : 
				?>
				    <div id="isotope-list" class="isotope-list woocommerce">
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
							$termsArray = get_the_terms( $post->ID, "product_cat" );  
							$termsString = "";
							foreach ( $termsArray as $term ) { 
								$termsString .= $term->slug.' ';
							}
						?> 
						
						<div class="<?php echo $termsString; ?> item col-md-<?php echo $settings['columns']; ?> single-products"> 
							<?php get_template_part( 'woocommerce/content', 'product' ); ?>
						</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div> 
				<?php endif; ?>
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
Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Buwoo_Isotope_Category() );
