<!-- section -->
<div class="section category-one-area">
  <div class="container-fluid">

    <div class="row">
      <div class="loop_cat_products">
        <?php

        if ( 'byid' == $buwoo_pcm['buwoo_source'] ) {
          $attributes['ids'] = implode( ',', $buwoo_pcm['buwoo_categories'] );
        } elseif ( 'byparent' == $buwoo_pcm['buwoo_source'] ) {
          $attributes['parent'] = $buwoo_pcm['buwoo_parent'];
        }

        $args = array(
            'orderby'           => $buwoo_pcm['buwoo_orderby'],
            'order'             => $buwoo_pcm['buwoo_order'],
            'hide_empty'        => ( 'yes' == $buwoo_pcm['buwoo_hide_empty'] ) ? 1 : 0,
            'exclude'           => array(),
            'exclude_tree'      => array(),
            'include'           => $attributes['ids'],
            'number'            => $buwoo_pcm['buwoo_pcm_num'],
            'fields'            => 'all',
            'slug'              => '',
            'parent'            => $attributes['parent'],
        );

        $terms = get_terms('product_cat', $args);

        // echo "<pre>";
        //   print_r($terms);
        // echo "</pre>";

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {

                  //echo '<pre>: '. print_r($term , true ) .'</pre>';

        ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item" id="id-<?php echo $term->term_id; ?>">
              <div class="cat_products">
                <!-- <h2 class="text-center"><?php echo $term->name; ?></h2> -->
                <div class="catproducts owl-carousel owl-theme">
                  <?php
                    $args = array(
                      'post_type' => 'product',
                      'posts_per_page'  =>  '-1',
                      'tax_query' => array(
                        array(
                          'taxonomy' => 'product_cat',
                          'field'    => 'slug',
                          'terms'    => $term->slug,
                        ),
                      ),
                    );
                    $woo_query = new WP_Query( $args );

                    if( $woo_query->have_posts() ) :
                      while ( $woo_query->have_posts() ) : $woo_query->the_post();
                        global $product;
                        $product = get_product( get_the_ID() );
                  ?>
                    <!-- catproducts owl-carousel owl-theme -->

                    <div class="item" id="id-<?php the_ID(); ?>" >
                      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
                      <div class="itminner" style="background-image: url('<?php echo $image[0]; ?>');">
                        <div class="pd-thumb visible-xs">
                            <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                                echo get_the_post_thumbnail( get_the_ID(), 'pd_cro_thumb' );
                            } else {
                                echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                            } ?>
                        </div>
                        <div class="pd-info">
                          <h5><?php echo $term->name; ?></h5>
                          <h3><?php echo $product->get_title(); ?></h3>
                          <h4><?php echo $product->get_price_html(); ?></h4>
                          <?php $content  =  get_post(get_the_ID())->post_excerpt; ?>
                          <p><?php echo wp_trim_words( $content, 22, '...' ); ?></p>
                          <?php //print_excerpt(201); ?>
                          <div class="pdshp">
                            <div class="pd_qty">
                                <span class="num-decrement">&minus;</span>
                                <?php woocommerce_quantity_input(); ?>
                                <span class="num-increment">&plus;</span>
                              <?php //woocommerce_quantity_input(); ?></div>
                            <div class="pd_atc"><?php woocommerce_template_loop_add_to_cart(); ?></div>
                          </div>
                        </div>
                        <div class="pd-thumb desk hidden-xs">
                            <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                                echo get_the_post_thumbnail( get_the_ID(), 'pd_cro_thumb' );
                            } else {
                                echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                            } ?>
                        </div>
                        <span class="clearfix"></span>
                      </div>
                    </div>
                  <?php
                    endwhile;
                      wp_reset_postdata();
                      else: echo "<p class='not_found'>Sorry, The post you are looking is unavailable!</p>";
                    endif;
                    wp_reset_query();
                  ?>
                </div>
              </div>
            </div>
        <?php
          }
        }
      ?>
    </div>
    </div>
  </div>
</div>
<!-- End section -->
