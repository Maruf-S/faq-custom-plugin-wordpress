<?php
/**
 * Plugin Name:     FAQs
 * Description:     Frequently Asked Question by 360 Ground.
 * Version:         1.0.0
 * Author:          Team 360 Ground
 * License:         Commercial
 * Text Domain:     faq
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'FAQS_PATH', realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR );
define( 'FAQS_URL', plugin_dir_url( __FILE__ ) );
define( 'FAQS_VERSION', '1.0.0' );

require_once FAQS_PATH . 'faq-category-tax.php';
require_once FAQS_PATH . 'faq-cpt.php';

wp_enqueue_style('faq-main-css', FAQS_URL . '/public/css/main.css', array(), FAQS_VERSION);
wp_enqueue_script('faq-main-js', FAQS_URL . '/public/js/main.js', array('jquery'), FAQS_VERSION);

wp_localize_script( 'ajax-script', 'ajax_object',
    array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );

function faqs_template( $template ) {
    if ( is_post_type_archive('faq') ) {
        $theme_files = array('archive-faqs.php', 'faqs/archive-faqs.php');
        $exists_in_theme = locate_template($theme_files, false);
        if ( $exists_in_theme != '' ) {
            return $exists_in_theme;
        } else {
            return plugin_dir_path(__FILE__) . '/templates/archive-faqs.php';
        }
    }

    if ( is_tax('faq_category') ) {
        $theme_files = array('archive-faqs.php', 'faqs/archive-faqs.php');
        $exists_in_theme = locate_template($theme_files, false);
        if ( $exists_in_theme != '' ) {
            return $exists_in_theme;
        } else {
            return plugin_dir_path(__FILE__) . '/templates/archive-faqs.php';
        }
    }
    return $template;
}

add_filter('template_include', 'faqs_template');

function faq_category_posts() {
    global $wpdb;
    $category = intval( $_POST['category'] );
    $description = $_POST['description'];

    $category_faqs_query = new WP_Query(array(
        'post_type' => 'faq',
        'tax_query' => array(
            array(
                'taxonomy' => 'faq_category',
                'field' => 'term_id',
                'terms' => $category,
            ),
        )
    ));

    echo '<div class="">';

    echo '<h2>Browse: ' . $description . '</h2>';

    while($category_faqs_query->have_posts()) {
        $category_faqs_query->the_post();
        include FAQS_PATH . 'templates/faq-loop.php';
    }

    echo '</div>';

    wp_die();
};

add_action( 'wp_ajax_faq_category_posts', 'faq_category_posts' );
add_action( 'wp_ajax_nopriv_faq_category_posts', 'faq_category_posts' );