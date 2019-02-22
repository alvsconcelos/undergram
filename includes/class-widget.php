<?php 

use InstagramScraper\Instagram;

class Undergram_Widget extends WP_Widget {

/**
 * Sets up the widgets name etc
 */
public function __construct() {
    $widget_ops = array(
        'classname' => 'undergram-box',
        'description' => 'Exibe as últimas fotos de qualquer perfil do Instagram.',
    );

    parent::__construct( 'undergram_widget', 'Instagram Box', $widget_ops );
}


/**
 * Outputs the content of the widget
 *
 * @param array $args
 * @param array $instance
 */
public function widget( $args, $instance ) {
    // return;

    if(!$instance['instagram_user'] || !$instance['posts_number']) return;
    echo $args['before_widget'];
    
    if ( ! empty( $instance['title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    } 

    printf('<div class="insta-content" id="content_%s" data-user="%s" data-postsnumber="%s"></div>',
    $args['widget_id'], $instance['instagram_user'], $instance['posts_number']);

    echo $args['after_widget'];
}

// public function widget($args, $instance) {
//     echo '<div id="instafeed">asdf</div>';
// }

/**
 * Outputs the options form on admin
 *
 * @param array $instance The widget options
 */
public function form( $instance ) {
    // outputs the options form on admin
    $title = ! empty( $instance['title'] ) ? $instance['title'] : "";
    $instagram_user = ! empty( $instance['instagram_user'] ) ? $instance['instagram_user'] : "beyonce";
    $posts_number = ! empty( $instance['posts_number'] ) ? $instance['posts_number'] : "3";
    ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Título' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'instagram_user' ); ?>"><?php _e( 'User do Instagram' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'instagram_user' ); ?>" name="<?php echo $this->get_field_name( 'instagram_user' ); ?>" type="text" value="<?php echo esc_attr( $instagram_user ); ?>">
        </p>        
        <p>
        <label for="<?php echo $this->get_field_id( 'posts_number' ); ?>"><?php _e( 'Quantos posts devem ser exibidos' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="tel" value="<?php echo esc_attr( $posts_number ); ?>">
        </p>        
    <?php
}


/**
 * Processing widget options on save
 *
 * @param array $new_instance The new options
 * @param array $old_instance The previous options
 */
public function update( $new_instance, $old_instance ) {
    // processes widget options to be saved
    foreach( $new_instance as $key => $value )
    {
        $updated_instance[$key] = sanitize_text_field($value);
    }

    return $updated_instance;
}

public function register() {
    register_widget( 'undergram_widget' );
}

}