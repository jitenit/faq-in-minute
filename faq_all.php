<?php

/*
 * Plugin Name: faq in minute
 * Plugin URI: twitter.com/jitendra_popat
 * Description: Create your Faq in just minute. active plugin.go to admin. add new FAQ. and just simple paste this [showallfaq] in your page or in post. use [showallfaq] or [faq-in-minute] to display list of all FAQ. FAQ with modern Design. And for category base [showallfaq category="categoryname"]
 * Version: 1.1
 * Author: Jiten IT - Jitendra
 * Author URI: twitter.com/jitendra_popat
 */

if (!function_exists('faq_details')) {

// Register Custom Post Type
    function faq_in_minute_cat() {

        $labels = array(
            'name' => _x('FAQ', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('FAQ', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Faq in minute', 'text_domain'),
            'name_admin_bar' => __('Faq in minute', 'text_domain'),
            'parent_item_colon' => __('Parent Item:', 'text_domain'),
            'all_items' => __('All Items', 'text_domain'),
            'add_new_item' => __('Add New Item', 'text_domain'),
            'add_new' => __('Add New', 'text_domain'),
            'new_item' => __('New Item', 'text_domain'),
            'edit_item' => __('Edit Item', 'text_domain'),
            'update_item' => __('Update Item', 'text_domain'),
            'view_item' => __('View Item', 'text_domain'),
            'search_items' => __('Search Item', 'text_domain'),
            'not_found' => __('Not found', 'text_domain'),
            'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        );
        $args = array(
            'label' => __('faq_in_minute_cat', 'text_domain'),
            'description' => __('Create Your FAQ in Minute With Best Desing', 'text_domain'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats',),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-heart',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        register_post_type('faq_in_minute_cat', $args);

        $labels = array(
            'name' => _x('faqcategory', 'taxonomy general name'),
            'singular_name' => _x('faqcategory', 'taxonomy singular name'),
            'search_items' => __('Search faqcategory'),
            'all_items' => __('All faqcategory'),
            'parent_item' => __('Parent faqcategory'),
            'parent_item_colon' => __('Parent faqcategory:'),
            'edit_item' => __('Edit faqcategory'),
            'update_item' => __('Update faqcategory'),
            'add_new_item' => __('Add New faqcategory'),
            'new_item_name' => __('New faqcategory Name'),
            'menu_name' => __('faqcategory'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'faqcategory'),
        );

        register_taxonomy('faqcategory', array('faq_in_minute_cat'), $args);
    }

// Hook into the 'init' action
    add_action('init', 'faq_in_minute_cat', 0);
}

function faq_in_minute_shortcut($atts) {

    //print_r($atts); die();
    $_SESSION['path'] = ABSPATH;


    extract(shortcode_atts(array(
        "limit" => '',
        "category" => '',
        "order"=> '',
                    ), $atts));

    // Define limit
    if ($limit) {
        $posts_per_page = $limit;
    } else {
        $posts_per_page = '-1';
    }
    // Define limit
    if ($category) {
        $cat = $category;
    } else {
        $cat = '';
    }

     if ($order) {
        $ord = $order;
    } else {
        $ord = 'DESC';
    }


    include('faq.php');
}

add_shortcode('showallfaq', 'faq_in_minute_shortcut');

add_shortcode('faq-in-minute', 'faq_in_minute_shortcut');

function faq_im_scripts() {


    wp_register_style('bootstrapmin', plugin_dir_url(__FILE__) . 'css/bootstrapmin.css');

    wp_enqueue_style('bootstrapmin');

    wp_enqueue_script('myjs', plugins_url( 'js/bootstrap.min.js' , __FILE__), array( 'jquery' ) , true);
}

add_action('wp_enqueue_scripts', 'faq_im_scripts');

function faq_in_minute_script() {
    ?>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        $j(document).on('click', '.panel div.clickable', function(e) {
            var $jthis = $j(this);
            if (!$jthis.hasClass('panel-collapsed')) {
                $jthis.parents('.panel').find('.panel-body').slideUp();
                $jthis.addClass('panel-collapsed');
                $jthis.find('i').removeClass('fa-minus-circle').addClass('fa-plus-circle');
            } else {
                $jthis.parents('.panel').find('.panel-body').slideDown();
                $jthis.removeClass('panel-collapsed');
                $jthis.find('i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
            }
        });
        $j(document).ready(function() {
            $j('.panel-heading span.clickable').click();
            $j('.panel div.clickable').click();
        });
    </script>
    <?php

}

add_action('wp_footer', 'faq_in_minute_script');
