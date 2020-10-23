<?php global $boutique; ?>
<div class="slder-bar">
  <a href="javascript:;" id="closeseemore"> x </a>
  <a href="javascript:;" id="seemore"> See More <i class="glyphicon glyphicon-play" aria-hidden="true"></i></a>
  <?php //woocommerce_mini_cart(); ?>
  <span class="shopicon"><img src="<?php echo BOUTIQUE_THEMEROOT; ?>/assets/images/restaurant.icon.png" alt="shop"></span>
</div><!-- End section -->
<?php
$quick_pro = $boutique['boutique-quick-category'];

if ( $quick_pro == '' ) {
  
  //$val = '22,24,26,29';
  $val = array();
  $get_terms_to_include =  get_terms(
      array(
          'fields'  => 'ids',
          'slug'    => array('capresem-darla','diana-korr-lay','lavie-rockwool','stellan-ricci'),
          'taxonomy' => 'product_cat',
      )
  );
  if( !is_wp_error( $get_terms_to_include ) && count($get_terms_to_include) > 0){
    $val = $get_terms_to_include; 
  }

}else{ 
  $val = str_replace("'", "", $quick_pro);
  $val = str_replace('"', "", $val);
}
 ?>
<div class="quick_cat">
  <div class="container-fluid">
    <div class="row">
      <?php
        $taxonomyName = "product_cat";
        $parent_terms = get_terms($taxonomyName, array('parent' => 0, 'order' => 'ASC', 'orderby' => 'slug', 'include' => $val,'number' => 4, 'hide_empty' => false));
        foreach ($parent_terms as $pterm) {
          $thumbnail_id = get_woocommerce_term_meta($pterm->term_id, 'thumbnail_id', true);
          $image = wp_get_attachment_image_src($thumbnail_id, 'topcatimg');
          //Get the Child terms
          // $terms = get_terms($taxonomyName, array('parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false));
          // foreach ($terms as $term) {
          //
          //   echo '<li><a href="' . get_term_link($term->name, $taxonomyName) . '">' . $term->name . '</a></li>';
          //   $thumbnail_id = get_woocommerce_term_meta($pterm->term_id, 'thumbnail_id', true);
          //   // get the image URL for child category
          //   $image = wp_get_attachment_url($thumbnail_id);
          //   // print the IMG HTML for child category
          //   echo "<img src='{$image}' alt='' width='400' height='400' />";
          // }
        ?>
      <div class="col-md-3 p-0 <?php echo $pterm->term_id ?>">
        <div class="q_cat">
          <div class="image">
            <img src="<?php echo $image[0]; ?>" alt="<?php echo $pterm->name; ?>">
          </div>
          <div class="content">
            <h3><?php echo $pterm->name; ?></h3>
            <p><?php echo $pterm->description; ?></p>
            <div class="button">
              <a href="<?php echo get_term_link($pterm->name, $taxonomyName); ?>">Shop Today <i class="fa fa-caret-right" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</div>
