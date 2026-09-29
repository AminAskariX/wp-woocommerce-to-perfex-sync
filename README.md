# Perfex Sync for WordPress & WooCommerce

[فارسی](#فارسی) · [English](#english)

<a id="فارسی"></a>
## فارسی

نمونهٔ افزونهٔ وردپرس برای ارسال دادهٔ کاربران ثبت‌نامی و برخی سفارش‌های ووکامرس به یک API پیکربندی‌شده.

### رفتار فعلی

- هوک `user_register` نام و ایمیل کاربر را ارسال می‌کند.
- هوک `woocommerce_thankyou` فقط برای سفارشی که کاربر ثبت‌نام‌شدهٔ مرتبط دارد تلاش به ارسال اطلاعات می‌کند.
- صفحهٔ «Sync to Perfex» فیلدهای نشانی API و کلید را ذخیره می‌کند؛ درخواست POST با JSON و هدر Bearer ارسال می‌شود.

### نصب و پیکربندی

فایل‌های مخزن را در پوشه‌ای زیر `wp-content/plugins/` بگذارید، افزونه را فعال کنید و در صفحهٔ تنظیمات نشانی endpoint و کلید معتبر را وارد کنید. ابتدا با API آزمایشی و دادهٔ غیرواقعی جریان را بررسی کنید.

### محدودیت‌های مهم

مخزن endpoint مشخصی برای Perfex ارائه نمی‌کند و سازگاری با نصب شما باید بررسی شود. آدرس و کلید پیش‌فرض در کد فقط مقدار نمایشی‌اند. کد هر پاسخ غیرخطای شبکه را موفق لاگ می‌کند و وضعیت HTTP را اعتبارسنجی نمی‌کند؛ برای همگام‌سازی مطمئن به مدیریت خطا و تکرار نیاز است. فایل `functions.php` نسخهٔ تکراری توابع را دارد و نباید هم‌زمان با فایل اصلی بارگذاری شود.

### پدیدآورنده و حقوق نشر

© 2025 م.امین عسکری (M. Amin Askari). [GitHub](https://github.com/AminAskariX) · [وب‌سایت](https://aminaskarix.ir)

### مجوز

این پروژه تحت مجوز MIT منتشر شده است؛ متن کامل در [LICENSE](LICENSE) آمده است. عبارت «تمام حقوق محفوظ است» جایگزین شرایط این مجوز نمی‌شود.

<a id="english"></a>
## English

A WordPress plugin prototype that posts registration data and selected WooCommerce customer data to a configured API.

### Current behavior

- `user_register` sends a registered user's name and email.
- `woocommerce_thankyou` attempts to send customer data only when the order has an associated registered user.
- The “Sync to Perfex” admin page saves an API URL and key; requests are JSON POSTs with a Bearer header.

### Install and configure

Place the repository files in a folder under `wp-content/plugins/`, activate the plugin, and supply a valid endpoint and key in its settings page. First verify the flow against a test API with non-sensitive data.

### Important limitations

The repository does not specify a working Perfex endpoint; verify compatibility with your own installation. Defaults in the code are placeholders. The code does not validate HTTP status and lacks reliable retry/error handling. `functions.php` duplicates definitions from the main plugin file and must not be loaded alongside it.

### Author and copyright

Copyright © 2025 M. Amin Askari (م.امین عسکری). [GitHub](https://github.com/AminAskariX) · [Website](https://aminaskarix.ir)

### License

This project is licensed under MIT. See [LICENSE](LICENSE) for the full terms.
