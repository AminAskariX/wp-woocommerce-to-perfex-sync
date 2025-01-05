// JavaScript for Perfex Sync Plugin

document.addEventListener('DOMContentLoaded', function () {
    const saveButton = document.querySelector('form .button');

    if (saveButton) {
        saveButton.addEventListener('click', function (e) {
            alert('تنظیمات با موفقیت ذخیره شد!');
        });
    }
});
