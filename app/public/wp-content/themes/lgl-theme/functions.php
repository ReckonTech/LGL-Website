<?php 

function enqueue_front_page_css() {
    if (is_front_page()) {
        wp_enqueue_style('front-page-style', get_template_directory_uri() . '/css/front-page.scss');
    }
}
function custom_single_template($single_template) {
    if (in_category('blog')) {
        // For posts in the "Blog" category, use single-blog.php
        return locate_template('single-blog.php');
    } elseif (in_category('product')) {
        // For posts in the "Product" category, use single-product.php
        return locate_template('single-product.php');
    } elseif (in_category('software')) {
        // For posts in the "Product" category, use single-product.php
        return locate_template('single-software.php');
    }
    return $single_template; // For other posts, use the default single.php
}

function enqueue_specific_css() {
    if (is_page('products-page')) {
        wp_enqueue_style('products-style', get_template_directory_uri() . '/CSS/products.scss');
    } elseif (is_page('blogs-page')) {
        wp_enqueue_style('blogs-styles', get_template_directory_uri() . '/CSS/blog.scss');
    } elseif (is_page('software-page')) {
        wp_enqueue_style('software-styles', get_template_directory_uri() . '/CSS/software.scss');
    } elseif (is_page('contact-us-page')) {
        wp_enqueue_style('contact-us-styles', get_template_directory_uri() . '/CSS/contact-us.scss');
    }
    // Add more conditions for other pages as needed
}


add_filter('single_template', 'custom_single_template');
add_action('wp_enqueue_scripts', 'enqueue_specific_css');