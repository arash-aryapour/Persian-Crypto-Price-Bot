# Persian Crypto & Gold Price Bot

![نسخه PHP](https://img.shields.io/badge/PHP-8.3%2B-blue.svg)
![مجوز](https://img.shields.io/badge/License-MIT-green.svg)


## 🌟 معرفی پروژه
یک **ربات تلگرامی خودکار** برای **مانیتورینگ قیمت ارزهای دیجیتال و طلا**. این ربات هر ۵ دقیقه قیمت‌ها را به‌روزرسانی کرده و در گروه‌ها یا تاپیک‌ها ارسال/(ویرایش پیام قبلی) می‌کند:

- 💰 قیمت ارزهای دیجیتال: بیت‌کوین، سولانا، BNB  
- 💵 نرخ تتر به ریال  
- 🏅 قیمت طلای ۱۸ عیار  
- 📈 درصد تغییر قیمت نسبت به آخرین بروزرسانی
- ⚠️ توجه: این ربات تنها یک بار پیام ارسال می‌کند و هر ۵ دقیقه همان پیام را ویرایش می‌کند.  
  (برای عملکرد صحیح، `message_id` باید به‌درستی تنظیم شده باشد)
  ---

## 🚀 ویژگی‌های کلیدی

| ویژگی | توضیح |
|-------|--------|
| ✅ منابع چندگانه | دریافت اطلاعات از CoinGecko و Nobitex API |
| ✅ درصد تغییرات | محاسبه دقیق نسبت به قیمت قبلی |
| ✅ پشتیبانی تاپیک گروه | ارسال در تاپیک‌های مشخص |
| ✅ سبک و بهینه | مناسب برای هاست اشتراکی |
| ✅ کش و مدیریت خطا | سرعت بالا و پایداری بیشتر |

---

## 🛠 فناوری‌ها

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img src="https://img.shields.io/badge/Telegram-2CA5E0?style=for-the-badge&logo=telegram&logoColor=white">
  <img src="https://img.shields.io/badge/CoinGecko-API-green?style=for-the-badge">
  <img src="https://img.shields.io/badge/Nobitex-API-orange?style=for-the-badge">
</p>

---

## 📦 ساختار پروژه
```bash
crypto-price-bot/
├── config.php # نمونه فایل تنظیمات
├── crypto_price_bot.php # اسکریپت اصلی ربات
├── .htaccess # تنظیمات امنیتی سرور
├── .gitignore # فایل‌هایی که نباید در گیت ثبت شوند
└── README.md # این فایل راهنما
```
### 1. نصب اولیه
```bash
git clone https://github.com/arash-aryapour/Persian-Crypto-Price-Bot.git
cd Persian-Crypto-Price-Bot
```

### 2. تنظیمات تلگرام
- یک ربات جدید از طریق [@BotFather](https://t.me/BotFather) بساز.
- توکن دریافتی را در `config.php` قرار بده:
  ```php
  define('TELEGRAM_BOT_TOKEN', 'توکن_ربات_شما');
  ```

### 3. تنظیمات گروه یا تاپیک
- ربات را به گروه تلگرامی اضافه کن.
- آیدی گروه را با استفاده از [@RawDataBot](https://t.me/RawDataBot) بدست بیار.
- سپس در `config.php` قرار بده:
  ```php
  define('TELEGRAM_CHAT_ID', '-1001234567890');
  define('MESSAGE_THREAD_ID', 12345); // فقط در صورت استفاده از تاپیک
  ```
## 🔎 نحوه پیدا کردن Message ID و Thread ID

### 🧷 پیدا کردن `Message ID` اولین پیام ربات:
اگر می‌خوای رباتت هربار **همون پیام قبلی رو ویرایش کنه** (به جای ارسال پیام جدید)، باید `message_id` اولین پیام ارسال‌شده رو ذخیره کنی.

#### مراحل:
1. رباتت رو اجرا کن تا اولین پیام در گروه یا تاپیک ارسال بشه.
2. به [@RawDataBot](https://t.me/RawDataBot) برو و دکمه "Start" رو بزن.
3. پیام اولی که ربات فرستاده رو **فوروارد کن به @RawDataBot**.
4. در خروجی، دنبال مقدار `"message_id"` بگرد:
   ```json
   "message_id": 42
   ```
5. این عدد رو در فایل `config.php` قرار بده:
   ```php
   define('TELEGRAM_MESSAGE_ID', 42);
   ```

> توجه: این مقدار فقط در صورتی معتبر می‌مونه که پیام اصلی پاک نشه.

---

### 🧵 پیدا کردن `Thread ID` (در گروه‌هایی با تاپیک):
اگر گروه شما **Discussion Topics** فعال داره، باید ID تاپیک موردنظر رو پیدا کنید:

#### روش:
1. به گروه برید و وارد تاپیکی بشید که می‌خواید پیام‌ها اونجا ارسال بشن.
2. یک پیام تستی در اون تاپیک ارسال کنید.
3. اون پیام رو به [@RawDataBot](https://t.me/RawDataBot) فوروارد کنید.
4. در خروجی، دنبال `"message_thread_id"` بگرد:
   ```json
   "message_thread_id": 1234
   ```
5. این عدد رو در فایل تنظیمات وارد کن:
   ```php
   define('MESSAGE_THREAD_ID', 1234);
   ```

> اگر از تاپیک استفاده نمی‌کنی، این مقدار رو نذار یا کامنت کن.


### 5.تنظیم کرون جاب
برای اجرای خودکار هر ۵ دقیقه، یک cron job به شکل زیر تعریف کن:
```cron
*/5 * * * * /usr/bin/php /home/username/public_html/crypto-price-bot/crypto_price_bot.php
```




## 📊 نمونه خروجی ربات
```bash
📊 قیمت ارزهای دیجیتال:
🔸 Bitcoin: $61,245.32 (+2.45%)
🔹 Solana: $142.18 (-1.23%)
🔸 BNB: $412.56 (+0.89%)
➖➕➖➖➕➖
💵 قیمت تتر به ریال: 42,150 ریال
🏅 قیمت طلای 18 عیار: 1,245,000 تومان
➖➕➖➖➕➖
🔺 توجه: قیمت‌ها هر 5 دقیقه بروزرسانی می‌شوند
```
# 📬 ارتباط با توسعه‌دهنده
- 📧 ایمیل: arash.aryapour@proton.me
- 📱 تلگرام: @arasharyapour



## 📜 مجوز
این پروژه تحت مجوز MIT License منتشر شده است. ![مجوز](https://img.shields.io/badge/License-MIT-green.svg)


