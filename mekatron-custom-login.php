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
define('MEKATRON_CUSTOM_LOGIN_ADMIN_PATH', plugin_dir_path(__FILE__).'admin/');
define('MEKATRON_CUSTOM_LOGIN_VIEW_PATH', plugin_dir_path(__FILE__).'view/');

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

    /* ############################# Register style ############################# */
    wp_register_style(
        'bootstrap',
        MEKATRON_CUSTOM_LOGIN_CSS_URL.'bootstrap.min.css',
        [],
        '5.3.0',
        'all'
    );


    /* ############################# Enqueue style ############################# */
    wp_enqueue_style(
        'mekatron-custom-login-style-css',
        MEKATRON_CUSTOM_LOGIN_CSS_URL.'login.css',
        //        array('bootstrap'),
        ['bootstrap'],
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
    $css_custom_login_code = '';

    $login_settings = get_option('mekatron_custom_login_color', []);
    if(isset($login_settings['column_color']) && $login_settings['column_color']) {
        $mekatron_login_form_section_color = $login_settings['column_color'];
    }
    if(isset($login_settings['background']) && $login_settings['background']) {
        $mekatron_login_background_image = $login_settings['background'];
    }
    if(isset($login_settings['css_code']) && $login_settings['css_code']) {
        $css_custom_login_code = $login_settings['css_code'];
    }
    if(isset($login_settings['logo']) && $login_settings['logo']) {
        $mekatron_login_logo_image = $login_settings['logo'];
    }

    wp_add_inline_style(
        'mekatron-custom-login-style-css',
        "
        $css_custom_login_code
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

    /* ############################# Register script ############################# */
    wp_register_script(
        'bootstrap',
        MEKATRON_CUSTOM_LOGIN_JS_URL.'bootstrap.bundle.min.js',
//        ['jquery'],
        [],
        '5.3.0',
        true
    );


    /* ############################# Enqueue script ############################# */
    wp_enqueue_script(
        'mekatron-custom-login-script-js',
        MEKATRON_CUSTOM_LOGIN_JS_URL.'login.js',
        ['jquery', 'underscore', 'bootstrap'],
        WP_DEBUG ? time() : MEKATRON_CUSTOM_LOGIN_VER,
        [
            'strategy'      => 'defer',
            'in_footer'     => false
        ]
    );

    $js_options = [
        'username_min_character' => 5,
        'password_min_character' => 6
    ];
    wp_add_inline_script(
        'mekatron-custom-login-script-js',
        "const MEKATRON_USERNAME_MIN_CHAR = " . json_encode($js_options),
//        'after'
        'before'
    );

    /* ############################# Enqueue script ############################# */
    wp_enqueue_script(
        'typewriter',
        MEKATRON_CUSTOM_LOGIN_JS_URL.'typewriter.js',
        [],
        WP_DEBUG ? time() : MEKATRON_CUSTOM_LOGIN_VER,
        [
            'strategy'      => 'defer',
            'in_footer'     => true
        ]
    );
    $typewriter_text = "Welcome to <b>mekatronik.ir</b>";
    wp_add_inline_script(
        'typewriter',
        "
        new Typewriter('#login-message', {
          strings: ['$typewriter_text'],
          autoStart: true,
          loop: true,
          delay: 100,
          deleteSpeed: 50,
          pauseFor: 2000,
        });
        ",
        'after'
    );

    /* ############################# Enqueue script ############################# */
    wp_enqueue_script(
        'mekatron-custom-logo-script-js',
        MEKATRON_CUSTOM_LOGIN_JS_URL.'logo.js',
        [],
        WP_DEBUG ? time() : MEKATRON_CUSTOM_LOGIN_VER,
        [
            'strategy'      => 'defer',
            'in_footer'     => true
        ]
    );
    $logo_options = [
        'link'      => "https://mekatronik.ir/",
        'content'   => "mekatronik.ir",
        'target'    => "_blank",
        'style'     => [
            'color' => [
                'background'    => 'red',
                'text'          =>  'blue'
            ],
            'font'  => [
                'family'    =>  'Arial',
                'size'      =>  'larger'
            ]
        ]
    ];
    wp_localize_script(
        'mekatron-custom-logo-script-js',
        'mekatron_logo_options',
        $logo_options
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

// Admin Menu
if(is_admin()) {
   include (MEKATRON_CUSTOM_LOGIN_ADMIN_PATH.'settings.php');
}







