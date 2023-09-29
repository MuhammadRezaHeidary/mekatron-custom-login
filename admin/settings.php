<?php

defined('ABSPATH') || exit;

function mekatron_custom_login_settings_load() {
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script(
        'mekatron-custom-login-settings',
        MEKATRON_CUSTOM_LOGIN_JS_URL.'settings.js',
        ['wp-color-picker'],
        WP_DEBUG ? time() : MEKATRON_CUSTOM_LOGIN_VER
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
            $settings['column_color'] = sanitize_hex_color($_POST['column_color']);
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