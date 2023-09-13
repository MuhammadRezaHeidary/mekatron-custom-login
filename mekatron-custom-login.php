<?php

/*
Plugin Name: Mekatron Custom Login
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Custom Login Form
Version: 1.0
Author: Muhammmad Reza Heidary
Author URI: https://mekatronik.ir/
License: MIT
*/

defined('ABSPATH') || exit;

define('MEKATRON_CUSTOM_LOGIN_ASSETS_URL', plugin_dir_url(__FILE__).'assets/');
const MEKATRON_CUSTOM_LOGIN_CSS_URL = MEKATRON_CUSTOM_LOGIN_ASSETS_URL . 'css/';
const MEKATRON_CUSTOM_LOGIN_JS_URL = MEKATRON_CUSTOM_LOGIN_ASSETS_URL . 'js/';
const MEKATRON_CUSTOM_LOGIN_IMAGES_URL = MEKATRON_CUSTOM_LOGIN_ASSETS_URL . 'images/';
const MEKATRON_CUSTOM_LOGIN_VER = '1.0.0';

/*Method 3 for importing CSS: GOOD*/
/*
 * function wp_enqueue_style( $handle, $src = '', $deps = array(), $ver = false, $media = 'all' )
 * $handle -> unique name as id for stylesheet
 * $src -> css url
 * $deps -> dependencies that we need like jquery, bootstrap, w3css and etc.
 * $ver -> version for updating cache automatically after any update (we can use sth constant like 4.3.11 or variable like time())
 * $media -> media in css (all, screen, print, etc.)
 */
add_action('login_enqueue_scripts', function (){
    wp_enqueue_style(
        'mekatron-custom-login-style-css',
        MEKATRON_CUSTOM_LOGIN_CSS_URL.'login.css',
        //        array('bootstrap'),
        [],
//        '1.0.0',
//        time(),
        WP_DEBUG ? time() : MEKATRON_CUSTOM_LOGIN_VER,
//        'screen and (max-width: 600px)',
    'all'
    );

    $mekatron_login_background_image = MEKATRON_CUSTOM_LOGIN_IMAGES_URL . 'login-back.jpg';
    $mekatron_login_logo_image = MEKATRON_CUSTOM_LOGIN_IMAGES_URL . 'mekalogo3 - pwa.png';
    $mekatron_login_form_section_color = '#FFFFFF3F';
    $mekatron_login_form_color = '#FFFFFFAA';

    wp_add_inline_style(
        'mekatron-custom-login-style-css',
        "
        body {
            background: url('$mekatron_login_background_image');
        }
        #login {
            background-color: $mekatron_login_form_section_color;
        }
        .login form {
            background-color: $mekatron_login_form_color;
        }
        .login h1 a {
            background-image: url('$mekatron_login_logo_image');
        }
        "
    );

    // Enqueue script
    wp_enqueue_script(
        'mekatron-custom-login-script-js',
        MEKATRON_CUSTOM_LOGIN_JS_URL.'login.js',
        [],
        WP_DEBUG ? time() : MEKATRON_CUSTOM_LOGIN_VER,
        [
            'strategy'      => 'defer',
            'in_footer'     => true
        ]
    );

});


/*Method 1 for importing CSS: BAD*/
//add_action('login_head', function () {
//    echo '<link rel="stylesheet" type="text/css" href="'.MEKATRON_CUSTOM_LOGIN_CSS_URL.'login.css'.'"/>';
//});

/*Method 2 for importing CSS: BAD*/
//add_action('login_head', function () {
//    echo '<style>';
//    echo file_get_contents(MEKATRON_CUSTOM_LOGIN_CSS_URL.'login.css');
//    echo '</style>';
//});







