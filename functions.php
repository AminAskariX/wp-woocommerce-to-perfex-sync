<?php
// فایل functions.php برای مدیریت سینک اطلاعات در افزونه Perfex Sync

// جلوگیری از دسترسی مستقیم به فایل
if (!defined('ABSPATH')) {
    exit;
}

// تابع برای ارسال داده‌ها به API پرفکس
function perfex_sync_send_to_api($data) {
    $api_url = get_option('perfex_api_url', 'https://your-perfex-url.com/api');
    $api_key = get_option('perfex_api_key', 'your-api-key');

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

// هوک برای ثبت‌نام کاربر جدید در وردپرس
add_action('user_register', 'perfex_sync_user_register');

function perfex_sync_user_register($user_id) {
    $user = get_userdata($user_id);

    $data = [
        'firstname' => $user->first_name,
        'lastname' => $user->last_name,
        'email' => $user->user_email,
    ];

    perfex_sync_send_to_api($data);
}

// هوک برای ایجاد سفارش جدید در ووکامرس
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

// ثبت تنظیمات افزونه در دیتابیس وردپرس
add_action('admin_init', 'perfex_sync_register_settings');

function perfex_sync_register_settings() {
    register_setting('perfex_sync_options_group', 'perfex_api_url');
    register_setting('perfex_sync_options_group', 'perfex_api_key');
}
?>
