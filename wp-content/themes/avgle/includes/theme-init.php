<?php

//scripts
function av_enqueue_scripts() {
    global $av_site_version;
    $template_uri = get_template_directory_uri();
    $template = get_page_template_slug();
    //css
    wp_enqueue_style( 'bootstrap', $template_uri.'/lib/bootstrap-3.3.7/css/bootstrap.min.css');
    wp_enqueue_style( 'mycss', $template_uri."/css/style=$av_site_version=.css");

    //js
    wp_enqueue_script( 'jquery', $template_uri.'/lib/jquery/js/jquery-3.1.1.min.js', array(), NULL, false);
    wp_enqueue_script( 'bootstrap', $template_uri.'/lib/bootstrap-3.3.7/js/bootstrap.min.js', array(), NULL, false);
    
    // wp_enqueue_script( 'fs-util', $template_uri.'/js/av-util.js', array(), false, true);


    //page specific js
    //automatically load js with the same name as the template file
    $basename = '/js/'.basename($template,'.php');
    $file = $basename.'.js';

    if(file_exists(get_template_directory().$file)) {
        wp_enqueue_script( 'page-custom-js', $template_uri.$basename."=$av_site_version=.js", array(), NULL, false);
    }
}
add_action( 'wp_enqueue_scripts', 'av_enqueue_scripts' );
