# ابزار تولید نقشه راه کریپتو (Crypto Onboarding Guide Generator)

یک اپلیکیشن تک‌صفحه‌ای (SPA) مدرن و مبتنی بر هوش مصنوعی که مسیرهای یادگیری شخصی‌سازی‌شده برای ارزهای دیجیتال را بر اساس سطح، اهداف و زمان کاربر تولید می‌کند.

## ویژگی‌ها
- **نقشه راه‌های هوشمند**: تولید مسیرهای یادگیری اختصاصی با استفاده از مدل‌های پیشرفته هوش مصنوعی.
- **پشتیبانی از چند زبانه**: انگلیسی، فارسی و عربی (با پشتیبانی کامل از RTL).
- **رابط کاربری مدرن**: طراحی Pixel-perfect با افکت‌های Glassmorphism و انیمیشن‌های نرم.
- **بدون نیاز به دیتابیس**: استفاده از سیستم فایل برای ذخیره تاریخچه.
- **سریع و سبک**: پیاده‌سازی با HTML/CSS خام (Tailwind CDN) و PHP (Laravel).

## پیش‌نیازها
- PHP >= 8.2
- Composer

## مراحل نصب و اجرا

۱. **کلون کردن پروژه**:
   ```bash
   git clone <repository-url>
   cd crypto-onboarding-guide
   ```

۲. **نصب وابستگی‌ها**:
   ```bash
   composer install
   ```

۳. **تنظیم متغیرهای محیطی**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

۴. **تنظیمات هوش مصنوعی**:
   فایل `.env` را ویرایش کرده و `AI_TOKEN` خود را وارد کنید:
   ```env
   AI_BASE_URL=https://ai.barivan.workers.dev/v1/chat/completions
   AI_TOKEN=your_token_here
   AI_MODEL=gpt-oss-120b
   ```

۵. **اجرای سرور**:
   ```bash
   php artisan serve
   ```
   سپس آدرس `http://localhost:8000` را در مرورگر باز کنید.

## تکنولوژی‌های مورد استفاده
- **بک‌اند**: Laravel 11 (PHP)
- **فرانت‌اند**: Tailwind CSS (CDN), FontAwesome, Google Fonts
- **هوش مصنوعی**: Barivan AI Workers
