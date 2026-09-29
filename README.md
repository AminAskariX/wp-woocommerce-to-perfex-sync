# 🔄 Perfex Sync for WordPress & WooCommerce

[فارسی](#فارسی) · [English](#english)

<a id="فارسی"></a>
## 🇮🇷 فارسی

نمونهٔ افزونهٔ وردپرس برای ارسال دادهٔ کاربران ثبت‌نامی و برخی سفارش‌های ووکامرس به یک API پیکربندی‌شده.

### ⚙️ رفتار فعلی

- هوک `user_register` نام و ایمیل کاربر را ارسال می‌کند.
- هوک `woocommerce_thankyou` فقط برای سفارشی که کاربر ثبت‌نام‌شدهٔ مرتبط دارد تلاش به ارسال اطلاعات می‌کند.
- صفحهٔ «Sync to Perfex» فیلدهای نشانی API و کلید را ذخیره می‌کند؛ درخواست POST با JSON و هدر Bearer ارسال می‌شود.

### 🛠️ نصب و پیکربندی

فایل‌های مخزن را در پوشه‌ای زیر `wp-content/plugins/` بگذارید، افزونه را فعال کنید و در صفحهٔ تنظیمات نشانی endpoint و کلید معتبر را وارد کنید. ابتدا با API آزمایشی و دادهٔ غیرواقعی جریان را بررسی کنید.

### ⚠️ محدودیت‌های مهم

مخزن endpoint مشخصی برای Perfex ارائه نمی‌کند و سازگاری با نصب شما باید بررسی شود. آدرس و کلید پیش‌فرض در کد فقط مقدار نمایشی‌اند. کد هر پاسخ غیرخطای شبکه را موفق لاگ می‌کند و وضعیت HTTP را اعتبارسنجی نمی‌کند؛ برای همگام‌سازی مطمئن به مدیریت خطا و تکرار نیاز است. فایل `functions.php` نسخهٔ تکراری توابع را دارد و نباید هم‌زمان با فایل اصلی بارگذاری شود.

### 💡 جریان داده

این نمونه برای وصل‌کردن رویدادهای وردپرس به یک endpoint خارجی طراحی شده است. پس از ثبت کاربر، نام و ایمیل او در قالب JSON ارسال می‌شود. در مسیر ووکامرس، هوک صفحهٔ تشکر سفارش را بررسی می‌کند و اگر سفارش به کاربر ثبت‌شده وصل باشد، اطلاعات او را نیز می‌فرستد. پیکربندی از صفحهٔ مدیریت وردپرس خوانده می‌شود.

### 🧩 نقشهٔ فایل‌ها

| فایل | نقش |
| --- | --- |
| `index.php` | نقطهٔ ورود افزونه، تنظیمات و هوک‌های فعال |
| `functions.php` | تعریف‌های تکراری و جدا از نقطهٔ ورود |
| `admin.js` و `style.css` | دارایی‌های همراه مخزن |

> 🔎 این کد قرارداد API پرفکس را تأیید نمی‌کند. قبل از اتصال دادهٔ واقعی، ساختار endpoint، مجوز دسترسی، پاسخ‌های خطا و جلوگیری از ارسال تکراری را در محیط آزمایشی بررسی کنید.

### 👤 پدیدآورنده و حقوق نشر

© م.امین عسکری (M. Amin Askari). [GitHub](https://github.com/AminAskariX) · [وب‌سایت](https://aminaskarix.ir)

### 📜 مجوز

این پروژه تحت مجوز MIT منتشر شده است؛ متن کامل در [LICENSE](LICENSE) آمده است.

<a id="english"></a>
## 🇬🇧 English

A WordPress plugin prototype that posts registration data and selected WooCommerce customer data to a configured API.

### ⚙️ Current behavior

- `user_register` sends a registered user's name and email.
- `woocommerce_thankyou` attempts to send customer data only when the order has an associated registered user.
- The “Sync to Perfex” admin page saves an API URL and key; requests are JSON POSTs with a Bearer header.

### 🛠️ Install and configure

Place the repository files in a folder under `wp-content/plugins/`, activate the plugin, and supply a valid endpoint and key in its settings page. First verify the flow against a test API with non-sensitive data.

### ⚠️ Important limitations

The repository does not specify a working Perfex endpoint; verify compatibility with your own installation. Defaults in the code are placeholders. The code does not validate HTTP status and lacks reliable retry/error handling. `functions.php` duplicates definitions from the main plugin file and must not be loaded alongside it.

### 💡 Data flow

This prototype connects WordPress events to an external endpoint. Registration sends a user's name and email as JSON. The WooCommerce thank-you hook also sends data when an order is linked to a registered user. The destination and key come from the WordPress settings page.

### 🧩 Repository map

| File | Purpose |
| --- | --- |
| `index.php` | Plugin entry point, settings, active hooks |
| `functions.php` | Duplicate definitions outside the entry point |
| `admin.js` and `style.css` | Additional checked-in assets |

> 🔎 This code does not prove compatibility with a particular Perfex API contract. Before sending real data, test the endpoint schema, permissions, error responses, and duplicate handling in a staging environment.

### 👤 Author and copyright

Copyright © M. Amin Askari (م.امین عسکری). [GitHub](https://github.com/AminAskariX) · [Website](https://aminaskarix.ir)

### 📜 License

This project is licensed under MIT. See [LICENSE](LICENSE) for the full terms.
