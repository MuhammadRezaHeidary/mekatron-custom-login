<?php

defined('ABSPATH') || exit;

function mekatron_custom_login_settings_load() {

    //enqueue thickbox
    add_thickbox();

    /* ############################# Enqueue style ############################# */
    wp_enqueue_style(
        'mekatron-custom-admin-style-style-css',
        MEKATRON_CUSTOM_LOGIN_CSS_URL.'admin-style.css',
        [],
        WP_DEBUG ? time() : MEKATRON_CUSTOM_LOGIN_VER,
        'all'
    );

    // enqueue code mirror (code editor)
    $code_mirror_settings = wp_enqueue_code_editor([
//        'type'              => 'text/html',
//        'type'              => 'text/js',
        'type'              => 'text/css',
        'codemirror'        => [
            'lineNumbers'   => true,
        ],
        'htmlhint'          => [
            'alt-require'   => false,
            'id-unique'     => true,
        ],
        'jshint'          => [

        ],
        'csslint'          => [

        ],
    ]);

    /*
     * // filter for changing code editor default settings in all parts of wordpress
     * add_filter('wp_code_editor_settings', function () {
     *
     * });
    */

    // enqueue media
    wp_enqueue_media();

    // enqueue color picker
    wp_enqueue_style('wp-color-picker');

    // enqueue script to set color picker properties
    wp_enqueue_script(
        'mekatron-custom-login-settings',
        MEKATRON_CUSTOM_LOGIN_JS_URL.'settings.js',
        ['wp-color-picker'],
        WP_DEBUG ? time() : MEKATRON_CUSTOM_LOGIN_VER
    );

    // localize $code_mirror_settings to settings.js
    wp_localize_script(
        'mekatron-custom-login-settings',
        'mekatron_code_mirror_settings',
        $code_mirror_settings
    );

}

function mekatron_custom_login_settings() {
    $login_settings_hook_suffix = add_menu_page(
        'Custom Login',
        'Custom Login',
        'manage_options',
        'mekatron_custom_login_settings',
        function () {
            $mekatron_custom_login_options = get_option('mekatron_custom_login_color', []);
            include (MEKATRON_CUSTOM_LOGIN_VIEW_PATH.'settings.php');
        },
        'dashicons-admin-users',
    );

    add_action('load-'.$login_settings_hook_suffix, function () {
        add_action('admin_enqueue_scripts', 'mekatron_custom_login_settings_load');

        if(isset($_POST['column_color'])) {
//            print_r($_POST);
            $settings = get_option('mekatron_custom_login_color', []);
            $settings['column_color']       = sanitize_hex_color($_POST['column_color']);
            $settings['background']         = esc_url_raw($_POST['background']);
            $settings['logo']               = esc_url_raw($_POST['logo']);
            $settings['css_code']           = ($_POST['css_code']);


            update_option('mekatron_custom_login_color', $settings);
            add_action('admin_notices', function () {
                echo '
                    <div class="notice notice-success is-dismissible">
                        <p>
                            Settings are saved successfully!
                        </p>
                    </div>
                ';

            });
        }
    });
}

add_action('admin_menu', 'mekatron_custom_login_settings');