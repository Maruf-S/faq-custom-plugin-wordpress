<?php

class FAQCategoryWidget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'faq_category_widget',
            __('FAQ Categories', 'faq'),
            array('description' => __('A widget to show a hierarchical FAQ categories menu.', 'faq'),)
        );
    }
    public function widget($args, $instance) {
        $title = apply_filters( 'widget_title', $instance['title'] );



        global $post;
        $current_faq_categories = get_the_terms($post->ID, 'faq_category');

        //get the first term
        $current_faq_category = array_shift($current_faq_categories);

        if( $term ) {
            $filter_args['tax_query'] = array(
                array(
                    'taxonomy' => get_query_var( 'taxonomy' ),
                    'field' => 'slug',
                    'terms' => array(get_query_var( 'term' )),
                    'operation' => 'IN'
                )
            );
        }

        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        include FAQS_PATH . '/templates/faq-categories-widget.php';

        echo $args['after_widget'];


    }

    public function form($instance) {
        $defaults = array( 'title' => __( '', 'faq' ));
        $instance = wp_parse_args( ( array ) $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}

function faq_category_load_widgets()
{
    register_widget('FAQCategoryWidget');
}

add_action('widgets_init', 'faq_category_load_widgets');