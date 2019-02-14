<?php 

use InstagramScraper\Instagram;

class Undergram_Widget extends WP_Widget {

/**
 * Sets up the widgets name etc
 */
public function __construct() {
    $widget_ops = array(
        'classname' => 'undergram',
        'description' => '',
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
    // outputs the content of the widget
    // echo $args['before_widget'];
    // if ( ! empty( $instance['title'] ) ) {
    //     echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    // }
    // echo __( 'Hello, World!', 'text_domain' );
    // echo $args['after_widget'];

    echo $args['before_widget'];

    $user = 'youngthegiant';
    $instagram = new Instagram();
    $account = $instagram->getAccount($user);
    $avatar = $account->getProfilePicUrl();
    $medias = $instagram->getMedias($user, 3);
    $photos = "";

    foreach ($medias as $index => $media) {
        $url = $media->getLink();
        $img = $media->getsquareImages()[0];
        $photo = sprintf('
            <div class="col">
                <a href="%s">
                    <div class="pt-100" style="background:url(%s);"></div>
                </a>
            </div>
        ', $url, $img);
        if(($index + 1)%2 == 0) $photo .= '</div><div class="row no-gutters">';
        $photos .= $photo;
    }
    printf('
    <div class="instagram-gallery">
        <div class="row no-gutters">
            %1$s
            <div class="col d-flex justify-content-center align-items-center" style="background: #E6E2CC;">
                <a class="full-link" href="https://instagram.com/%3$s"></a>
                <div class="follow-box">
                    <div class="content">
                        <img src="%2$s" class="avatar" alt="%3$s">
                        <p class="name">@%3$s</p>
                        <p class="follow">Seguir</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ', $photos, $avatar, $user);    

    echo $args['after_widget'];
}


/**
 * Outputs the options form on admin
 *
 * @param array $instance The widget options
 */
public function form( $instance ) {
    // outputs the options form on admin
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
    ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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