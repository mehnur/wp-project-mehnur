<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

//widgets_init hook is used to register the new widgets.

add_action( 'widgets_init', 'registerProductWidgets');
function registerProductWidgets()
{
    register_widget( 'MehnurWidget' );
}	

/**
 * Adds MehnurWidget widget.
 */
class MehnurWidget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'MehnurWidget', // Base ID is important
            __('Mehnur Widget', 'cp-lang'), // Name of the widget displayed in the backend.
            array( 'description' => __( 'My first widget and I am Mehnur !', 'cp-lang' ), ) // Args and description of the widget in the backend section
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];

            //echo $instance['title'];
        }

        $count = $instance['count'];

        $args = array(
            'post_type'=>'product',
            'post_status'=>'publish',
            'posts_per_page'=> $count
        );

        $query = new WP_Query($args);
        $products = $query->posts;
        foreach($products as $key => $product){
            $ptitle = $product->post_title;
            $id = $product->ID;
            $price = get_post_meta($id,'price',true);
            echo '<h3>' . $ptitle . ' PRICE '  . $price . '</h3><br />';
        }

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Mehnur Widget', 'cp-lang' );
        }

        if ( isset( $instance[ 'count' ] ) ) {
            $count = $instance[ 'count' ];
        }
        else {
            $count = 5;
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of products to show:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';

        return $instance;
    }

} // class MehnurWidget