<?php


class Boutique_Menu_walker extends Walker_Nav_Menu {

  public $megaMenuID;
  public $count;

  public function __construct(){
      $this->megaMenuID = 0;
      $this->count = 0;
  }

  /**
   * Start Level
   *
   */
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat( "\t", $depth );
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output	.= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";

    if ($this->megaMenuID != 0 && $depth == 0) {
      $output .= "<li class=\"megamenu-column\"><ul>\n";
    }
  }

  /**
   * End Level
   *
   */

  public function end_lvl(&$output, $depth = 0, $args = array()) {
    if ($this->megaMenuID != 0 && $depth == 0) {
        $output .= "</ul></li>";
    }
    $output .= "</ul>";
  }

  /**
   * Start Element
   *
   */
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    $hasMegaMenu     = get_post_meta( $item->ID, 'menu-item-mm_megamenu', true );

    $indent         = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $li_attributes  = '';
    $class_names    = $value = '';
    //$hasMegaMenu    = is_active_sidebar( 'mega-menu-item-' . $item->ID );
    $isMegaMenu = 0;
    if($hasMegaMenu){
      $isMegaMenu    = is_active_sidebar( 'mega-menu-item-' . $item->ID );
    }
      
    if ($this->megaMenuID != 0 && $this->megaMenuID != intval($item->menu_item_parent) && $depth == 0) {
        $this->megaMenuID = 0;
    }   

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    // managing divider: add divider class to an element to get a divider before it.
    $divider_class_position = array_search('divider', $classes);

    if($divider_class_position !== false){
      $output .= "<li class=\"divider\"></li>\n";
      unset($classes[$divider_class_position]);
    }

    if ($hasMegaMenu && $depth == 0) {
        array_push($classes, 'mega-menu-parent');
        $this->megaMenuID = $item->ID;
    }

    $classes[] = ($args->has_children || $isMegaMenu) ? 'dropdown' : '';
    $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
    $classes[] = 'nav-item-' . $item->ID;
    if($depth && $args->has_children){
      $classes[] = 'dropdown-submenu';
    }

    $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = ' class="nav-item ' . esc_attr( $class_names ) . '"';

    $id = apply_filters( 'nav_menu_item_id', 'nav-item-'. $item->ID, $item, $args );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
    $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
    $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
    $attributes .= ($args->has_children || $isMegaMenu) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

    $item_output  = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= (($depth == 0 || 1) && ($args->has_children || $isMegaMenu)) ? ' <i class="fa fa-angle-down" aria-hidden="true"></i></a>' : '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    if ($isMegaMenu){
      $output .= "<ul id=\"mega-menu-{$item->ID}\" class=\"mega-menu-wrapper dropdown-menu depth_".$depth."\">";
        ob_start();
        dynamic_sidebar( 'mega-menu-item-' . $item->ID );
        $dynamicSidebar = ob_get_contents();
        ob_end_clean();
        $output .=  $dynamicSidebar;
      $output .= "</ul>";
    }
  }

  /**
   * Display Element
   *
   */
  public function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    //v($element);
    if ( !$element )
    return;

    $id_field = $this->db_fields['id'];

    //display this element
    if ( is_array( $args[0] ) )
    $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
    else if ( is_object( $args[0] ) )
    $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    $cb_args = array_merge( array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'start_el'), $cb_args);

    $id = $element->$id_field;

    // descend only when the depth is right and there are childrens for this element
    if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ){
      foreach( $children_elements[ $id ] as $child ){
        if ( !isset($newlevel) ){
          $newlevel = true;
          //start the child delimiter
          $cb_args = array_merge( array(&$output, $depth), $args);
          call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
        }

        $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
      }

      unset( $children_elements[ $id ] );
    }

    if ( isset($newlevel) && $newlevel ){
      //end the child delimiter
      $cb_args = array_merge( array(&$output, $depth), $args);
      call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
    }

    //end this element
    $cb_args = array_merge( array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'end_el'), $cb_args);
  }
}

function fields_list() {
  return array(
    'mm_megamenu' => __( 'Activate MegaMenu', 'boutique' ),
    // 'column-divider' => __( 'Column Divider', 'boutique' ),
  );
}

// Setup fields
function megamenu_fields( $id, $item, $depth, $args ) {

  $fields = fields_list();

  foreach ( $fields as $_key => $label ) :
    $key   = sprintf( 'menu-item-%s', $_key );
    $id    = sprintf( 'edit-%s-%s', $key, $item->ID );
    $name  = sprintf( '%s[%s]', $key, $item->ID );
    $value = get_post_meta( $item->ID, $key, true );
    $class = sprintf( 'field-%s', $_key );
    ?>
    <?php if ($depth == 0) { ?>
    <p class="description description-wide <?php echo esc_attr( $class ) ?>">
      <label for="<?php echo esc_attr( $id ); ?>"><input type="checkbox" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" value="1" <?php echo ( $value == 1 ) ? 'checked="checked"' : ''; ?> /><?php echo esc_attr( $label ); ?>
      <p class="description">You can manage mega menu under <a href="widgets.php" target="_blank">Widgets Section</a>.</p>
      </label>
    </p>
    <?php
  }
  endforeach;
}
add_action( 'wp_nav_menu_item_custom_fields', 'megamenu_fields', 10, 4 );

// Create Columns
function megamenu_columns( $columns ) {

  $fields = fields_list();
  $columns = array_merge( $columns, $fields );
  return $columns;

}
add_filter( 'manage_nav-menus_columns', 'megamenu_columns', 99 );


// Save fields
function megamenu_save( $menu_id, $menu_item_db_id, $menu_item_args ) {
  if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
    return;
  }

  check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

  $fields = fields_list();

  foreach ( $fields as $_key => $label ) {
    $key = sprintf( 'menu-item-%s', $_key );

    // Sanitize.
    if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
      // Do some checks here...
      $value = $_POST[ $key ][ $menu_item_db_id ];
    } else {
      $value = null;
    }

    // Update.
    if ( ! is_null( $value ) ) {
      update_post_meta( $menu_item_db_id, $key, $value );
      //echo "key:$key<br />";
    } else {
      delete_post_meta( $menu_item_db_id, $key );
    }
  }
}
add_action( 'wp_update_nav_menu_item', 'megamenu_save', 10, 3 );

function megamenu_filter_walker( $walker ) {
    $walker = 'MegaMenu_Walker_Edit';
    if ( ! class_exists( $walker ) ) {
        require_once dirname( __FILE__ ) . '/helpers/walker-nav-menu-edit.php';
    }
    return $walker;
}
add_filter( 'wp_edit_nav_menu_walker', 'megamenu_filter_walker', 99 );

// 

class Boutique_Nav_walker extends Walker_Nav_Menu {

  public function start_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      $class = $html = '';

      //if ($depth == 0):
      $class = 'dropdown-menu';
      //endif;

      $output .= "\n$indent<ul class=\"$class\">\n$html";
      $this->custom_elements = array();
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
      global $wp_query;
      $selected_ancher_class = '';
      $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

      $class_names = $value = '';
      $classes = empty($item->classes) ? array() : (array) $item->classes;

      if ($depth < 1):
          array_push($classes, 'dropdown');
      elseif ($args->walker->has_children):
          array_push($classes, 'dropdown-submenu');
      endif;


      $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
      $class_names = ' class="' . esc_attr($class_names) . '"';

      $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
      if (preg_match('/current-menu-item/', $class_names)) {
          $selected_ancher_class = ' class="active dropdown-toggle" ';
      }

      $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
      $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
      $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
      $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

      $item_output .= $args->before;
      $attr_class = ($args->walker->has_children)?' data-toggle="dropdown" class="dropdown-toggle" ':'';
      $item_output .= '<a' . $selected_ancher_class.$attr_class.$attributes. '>';
      $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
      $item_output .= ($args->walker->has_children)?'<i class="fa fa-angle-down" aria-hidden="true"></i>':'';
      $item_output .= '</a>';


      $item_output .= $args->after;

      $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
