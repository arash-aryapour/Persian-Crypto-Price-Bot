<?php
require_once 'config.php';

// دریافت قیمت ارزهای دیجیتال
$cryptoData = json_decode(file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,solana,binancecoin&vs_currencies=usd'), true);

// دریافت قیمت تتر به تومان
$tetherData = json_decode(file_get_contents('https://api.nobitex.ir/v2/orderbook/USDTIRT'), true);
$tetherPrice = $tetherData['lastTradePrice'];

// دریافت قیمت طلای 18 عیار
$goldPrice = getGoldPriceFromTgju();

// محاسبه درصد تغییرات
$percentageChanges = [
    'bitcoin' => (($cryptoData['bitcoin']['usd'] - PREV_BTC_PRICE) / PREV_BTC_PRICE) * 100,
    'solana' => (($cryptoData['solana']['usd'] - PREV_SOL_PRICE) / PREV_SOL_PRICE) * 100,
    'bnb' => (($cryptoData['binancecoin']['usd'] - PREV_BNB_PRICE) / PREV_BNB_PRICE) * 100
];

// ساخت متن پیام
$message = "📊 قیمت ارزهای دیجیتال:\n";
$message .= "🔸Bitcoin: $" . $cryptoData['bitcoin']['usd'] . " (" . round($percentageChanges['bitcoin'], 2) . "%)\n";
$message .= "🔹Solana: $" . $cryptoData['solana']['usd'] . " (" . round($percentageChanges['solana'], 2) . "%)\n";
$message .= "🔸BNB: $" . $cryptoData['binancecoin']['usd'] . " (" . round($percentageChanges['bnb'], 2) . "%)\n";
$message .= "➖➕➖➖➕➖\n";
$message .= "💵 قیمت تتر به ریال: " . $tetherPrice . " ریال\n";
$message .= "🏅 قیمت طلای 18 عیار: " . $goldPrice . " \n";
$message .= "➖➕➖➖➕➖\n";
$message .= "🔺توجه: قیمت ها هر 5 دقیقه بروزرسانی میشوند.";

// ارسال پیام به گروه تلگرام
$url = "https://api.telegram.org/bot".TELEGRAM_BOT_TOKEN."/editMessageText?chat_id=".TELEGRAM_CHAT_ID."&message_thread_id=".MESSAGE_THREAD_ID."&message_id=".MESSAGE_ID."&text=" . urlencode($message);
$response = file_get_contents($url);

// تابع دریافت قیمت طلا
function getGoldPriceFromTgju() {
    $html = file_get_contents('https://www.tgju.org/profile/geram18');
    preg_match('/<span data-col="info\.last_trade\.PDrCotVal">(.*?)<\/span>/', $html, $matches);
    return isset($matches[1]) ? number_format(str_replace(',', '', $matches[1])) . " تومان" : 'N/A';
}
?>
