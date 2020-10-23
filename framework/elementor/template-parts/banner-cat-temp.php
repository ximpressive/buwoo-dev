<!-- section -->
<div class="cat_bnnr">
  <div class="">

      <div id="grid" class="grid">
        <?php

        if ( 'byid' === $boutique_pcm['boutique_source'] ) {
    			$attributes['ids'] = implode( ',', $boutique_pcm['boutique_categories'] );
    		} elseif ( 'byparent' === $boutique_pcm['boutique_source'] ) {
    			$attributes['parent'] = $boutique_pcm['boutique_parent'];
    		}

        $args = array(
            'orderby'           => $boutique_pcm['boutique_orderby'],
            'order'             => $boutique_pcm['boutique_order'],
            'hide_empty'        => ( 'yes' === $boutique_pcm['boutique_hide_empty'] ) ? 1 : 0,
            'exclude'           => array(),
            'exclude_tree'      => array(),
            'include'           => $attributes['ids'],
            'number'            => $boutique_pcm['boutique_pcm_num'],
            'fields'            => 'all',
            'slug'              => '',
            'parent'            => $attributes['parent'],
        );

        $terms = get_terms('product_cat', $args);

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
          foreach (array_chunk($terms, 4) as $row){
            $i = 0;
            foreach ( $row as $term ) {
              if ($i%4 == 0){
                echo '<div class="itm-cat col-lg-6 col-md-6 col-sm-6 col-xs-12">';
              }elseif ($i%4 == 1){
                echo '<div class="itm-cat col-lg-6 col-md-6 col-sm-6 col-xs-12">';
              }elseif ($i%4 == 2){
                echo '<div class="itm-cat col-lg-4 col-md-4 col-sm-4 col-xs-12">';
              }elseif ($i%4 == 3){
                echo '<div class="itm-cat col-lg-8 col-md-8 col-sm-8 col-xs-12">';
              }
              $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
              $image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
        ?>
                <a href="<?php echo get_term_link( $term ); ?>" class="griditem" style="background-image: url('<?php echo $image[0]; ?>');">
                    <h3><?php echo $term->name; ?></h3>
                </a>
              </div><!--/.col-*-->
        <?php
              $i++;
            }// foreach-inner
          }// foreach-outer      
        }
      ?>
      </div>
  </div>
</div>
<!-- End section -->