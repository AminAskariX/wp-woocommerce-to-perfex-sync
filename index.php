<?php
/**
 * Plugin Name: Perfex Sync for WordPress & WooCommerce
 * Plugin URI: https://aminaskarix.ir
 * Description: افزونه برای ارسال کاربران ثبت‌نام شده وردپرس و ووکامرس به پرفکس CRM.
 * Version: 1.0.0
 * Author: M.Amin Askari
 * Author URI: https://aminaskarix.ir
 */

// جلوگیری از دسترسی مستقیم به فایل
if (!defined('ABSPATH')) {
    exit;
}

// تعریف ثابت‌ها
define('PERFEX_SYNC_PLUGIN_VERSION', '1.0.0');
define('PERFEX_SYNC_PLUGIN_DIR', plugin_dir_path(__FILE__));

define('PERFEX_API_URL', 'https://your-perfex-url.com/api'); // آدرس API پرفکس

define('PERFEX_API_KEY', 'your-api-key'); // کلید API پرفکس

// افزودن منوی تنظیمات در بخش مدیریت وردپرس
add_action('admin_menu', 'perfex_sync_add_admin_menu');

function perfex_sync_add_admin_menu() {
    add_menu_page(
        'Perfex Sync',
        'Sync to Perfex',
        'manage_options',
        'perfex_sync',
        'perfex_sync_settings_page',
        'dashicons-update',
        100
    );
}

// صفحه تنظیمات افزونه
function perfex_sync_settings_page() {
    ?>
    <div class="wrap">
        <h1>تنظیمات افزونه Perfex Sync</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('perfex_sync_options_group');
            do_settings_sections('perfex_sync');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// ثبت تنظیمات
add_action('admin_init', 'perfex_sync_register_settings');

function perfex_sync_register_settings() {
    register_setting('perfex_sync_options_group', 'perfex_api_url');
    register_setting('perfex_sync_options_group', 'perfex_api_key');

    add_settings_section('perfex_sync_main_section', 'تنظیمات اصلی', null, 'perfex_sync');

    add_settings_field(
        'perfex_api_url',
        'آدرس API پرفکس',
        'perfex_api_url_callback',
        'perfex_sync',
        'perfex_sync_main_section'
    );

    add_settings_field(
        'perfex_api_key',
        'کلید API پرفکس',
        'perfex_api_key_callback',
        'perfex_sync',
        'perfex_sync_main_section'
    );
}

function perfex_api_url_callback() {
    $url = get_option('perfex_api_url', '');
    echo "<input type='text' name='perfex_api_url' value='" . esc_attr($url) . "' class='regular-text' />";
}

function perfex_api_key_callback() {
    $key = get_option('perfex_api_key', '');
    echo "<input type='text' name='perfex_api_key' value='" . esc_attr($key) . "' class='regular-text' />";
}

// هوک برای ثبت‌نام کاربر جدید در وردپرس
add_action('user_register', 'perfex_sync_user_register');

function perfex_sync_user_register($user_id) {
    $user = get_userdata($user_id);

    // اطلاعات کاربر
    $data = [
        'firstname' => $user->first_name,
        'lastname' => $user->last_name,
        'email' => $user->user_email,
    ];

    perfex_sync_send_to_api($data);
}

// هوک برای ایجاد سفارش در ووکامرس
add_action('woocommerce_thankyou', 'perfex_sync_order_created');

function perfex_sync_order_created($order_id) {
    $order = wc_get_order($order_id);
    $user = $order->get_user();

    if ($user) {
        $data = [
            'firstname' => $user->first_name,
            'lastname' => $user->last_name,
            'email' => $user->user_email,
            'phone' => $user->billing_phone,
        ];

        perfex_sync_send_to_api($data);
    }
}

// ارسال داده‌ها به API پرفکس
function perfex_sync_send_to_api($data) {
    $api_url = get_option('perfex_api_url', PERFEX_API_URL);
    $api_key = get_option('perfex_api_key', PERFEX_API_KEY);

    $response = wp_remote_post($api_url, [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json',
        ],
        'body' => wp_json_encode($data),
    ]);

    if (is_wp_error($response)) {
        error_log('Error syncing with Perfex API: ' . $response->get_error_message());
    } else {
        error_log('Data synced successfully: ' . wp_remote_retrieve_body($response));
    }
}
