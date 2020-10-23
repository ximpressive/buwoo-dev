<?php

/*
 * Display Subcribe Option Widget
 */

class executive_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
            'executive_widget',
            __('Boutique: Subscribe', 'boutique'),
            array( 'description' => __( 'Display Subcribe Option', 'boutique' ), )
        );
    }
 
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $text_two = apply_filters( 'widget_title', $instance['text_two'] );
        $link_text = apply_filters( 'widget_text_two', $instance['link_text'] );
 
        echo $args['before_widget'];
        echo '<div class="widget-wrapper widget">';
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        if ( ! empty( $text_two ) )
            echo '<p>' . $text_two . '</p>';
        if ( ! empty( $link_text ) )

            echo do_shortcode ("$link_text");
            
        echo '</div>';
        echo $args['after_widget'];
    }
 
    // Widget Backend
    public function form( $instance ) {
        
            $title      = $instance[ 'title' ];
            $text_two   = $instance[ 'text_two' ];
            $link_text  = $instance[ 'link_text' ];
 
        // Widget admin form
        ?>
        <p>     
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'boutique' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" placeholder="" value="<?php echo esc_attr( $title ); ?>" />
        </p>    
        <p> 
            <label for="<?php echo $this->get_field_id( 'text_two' ); ?>"><?php _e( 'Short Text:', 'boutique' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'text_two' ); ?>" name="<?php echo $this->get_field_name( 'text_two' ); ?>" type="text" value="<?php echo esc_attr( $text_two ); ?>" />
        </p>
        <p>               
            <label for="<?php echo $this->get_field_id( 'link_text' ); ?>"><?php _e( 'Enter Shortcode', 'boutique' ); ?></label>
           <input class="widefat" id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" type="text" placeholder="[shortcode]" value="<?php echo esc_attr( $link_text ); ?>" />
        </p>
    <?php
    }
 
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text_two'] = ( ! empty( $new_instance['text_two'] ) ) ? strip_tags( $new_instance['text_two'] ) : '';
        $instance['link_text'] = ( ! empty( $new_instance['link_text'] ) ) ? strip_tags( $new_instance['link_text'] ) : '';
        return $instance;
    }
}
 
function executive_load_widget() {
    register_widget( 'executive_widget' );
}
add_action( 'widgets_init', 'executive_load_widget' );