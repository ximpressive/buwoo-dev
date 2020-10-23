<?php
/*
* @subpackage Footer Boxes Widgets
*/

add_action('widgets_init', 'footer_boxes_widgets');
function footer_boxes_widgets(){
    register_widget('FooterBoxes_Widgets');
}
class FooterBoxes_Widgets extends WP_Widget {
    public  function __construct(){
        $widget_ops = array('classname' => 'footerboxes', 'description' => 'The wigets for footer boxes.');
        parent::__construct( 'footerboxes_id', _x( 'Boutique: Footer Boxes', 'widget title', 'boutique' ), $widget_ops );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_32423' ) );
        add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts_3241' ), 9999 );
    }
    public function enqueue_scripts_32423( $hook_suffix ) {
        if ( 'widgets.php' !== $hook_suffix ) {
            return;
        }

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'underscore' );
    }

    public function print_scripts_3241() {
        ?>
        <script>
            ( function( $ ){
                function initColorPicker( widget ) {
                    widget.find( '.color-picker' ).wpColorPicker( {
                        change: _.throttle( function() { // For Customizer
                            $(this).trigger( 'change' );
                        }, 3000 )
                    });
                }

                function onFormUpdate( event, widget ) {
                    initColorPicker( widget );
                }

                $( document ).on( 'widget-added widget-updated', onFormUpdate );

                $( document ).ready( function() {
                    $( '#widgets-right .widget:has(.color-picker)' ).each( function () {
                        initColorPicker( $( this ) );
                    } );
                } );
            }( jQuery ) );
        </script>
        <?php
    }


    public function widget($args, $instance){
        
        extract($args);

            $title      =   $instance['title'];
            $icon       =   $instance['icon'];
            $bgcolor    =   $instance['bgcolor'];

        echo $before_widget;
    ?>
        <li style="background: <?php echo $bgcolor ?>;">
            <div class="single-help">
                <p><i class="<?php echo $icon; ?>"></i> <?php echo $title; ?></p>
            </div>
        </li>      

    <?php
        echo $after_widget;
    }

    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title']     =   strip_tags( $new_instance['title'] );
        $instance['icon']      =   strip_tags( $new_instance['icon'] );
        $instance['bgcolor']   =   strip_tags( $new_instance['bgcolor'] );
        return $instance;
    }
    public function form($instance){
?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title', 'boutique' ); ?>:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('icon') ); ?>"><?php esc_html_e( 'Select icon', 'boutique' ); ?>:</label>
            <select id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" class="widefat" style="width:100%;">
                <option <?php selected( $instalnce['icon'], 'flaticon-box-2'); ?> value="flaticon-box-2">Box</option>
                <option <?php selected( $instance['icon'], 'flaticon-circular-arrow'); ?> value="flaticon-circular-arrow">Circular Arrow icon</option>
                <option <?php selected( $instance['icon'], 'flaticon-help-round-button'); ?> value="flaticon-help-round-button">Help Round icon</option>
                <option <?php selected( $instance['icon'], 'flaticon-edit'); ?> value="flaticon-edit">Edit icon</option>
                <option <?php selected( $instance['icon'], 'flaticon-delivery-truck'); ?> value="flaticon-delivery-truck">Delivery Truck icon</option>
                <option <?php selected( $instance['icon'], 'fa fa-thumbs-up'); ?> value="fa fa-thumbs-up">Thumbs Up icon</option>
                <option <?php selected( $instance['icon'], 'fa fa-heart'); ?> value="fa fa-heart">Heart icon</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'bgcolor' ); ?>"><?php esc_html_e( 'Box background color:', 'boutique' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'bgcolor' ); ?>" class="color-picker" id="<?php echo $this->get_field_id( 'bgcolor' ); ?>" value="<?php echo $bgcolor; ?>" data-default-color="#252525" />
        </p>
<?php
    }
}
