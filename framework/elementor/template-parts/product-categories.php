<!-- section -->
<div class="section category-one-area background-image" data-src="assets/images/category/1.png">
  <div class="container">

    <div class="row">
      <div id="isotop_sec">
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

        // echo "<pre>";
        //   print_r($terms);
        // echo "</pre>";

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
          echo '<div class="grid-sizer col-md-6 col-sm-6 col-xs-12"></div>';

            foreach ( $terms as $term ) {
              $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
              $image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
        ?>


        <div class="item col-sm-6">
          <div class="single-category">
            <div class="image">
              <a href="<?php echo get_term_link( $term ); ?>"><img src="<?php echo $image[0]; ?>" width="100%" alt="<?php echo $term->name; ?>"></a>
            </div>
            <div class="title">
              <h3><a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></h3>
            </div>
          </div>
        </div>

      <?php
      }
    }
      ?>

        <div class="item col-sm-6">
          <div class="single-category">
            <h2><?php echo $boutique_pcm['boutique_pcm_title']; ?></h2>
            <p><?php echo $boutique_pcm['boutique_pcm_shdesc']; ?></p>
            <div class="button">
              <?php
                $target   = $boutique_pcm['boutique_pcm_btnref']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $boutique_pcm['boutique_pcm_btnref']['nofollow'] ? ' rel="nofollow"' : '';
              ?>
              <a href="<?php echo $boutique_pcm['boutique_pcm_btnref']['url']; ?>" <?php echo $target. " " . $nofollow ; ?>>Shop Today <i class="fa fa-caret-right" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End section -->
