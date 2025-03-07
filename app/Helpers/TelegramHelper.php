<?php
// namespace App\Helpers;


// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Http;

// class TelegramHelper
// {

//     protected static $token = env('TELEGRAM_BOT_TOKEN');
//     protected static $chat_id = env('TELEGRAM_CHAT_ID');
//     protected static $url = "https://api.telegram.org/bot{$token}/sendMessage";
//     protected static $group_expense_management = env('TELEGRAM_GROUP_EXPENSE_MANAGEMENT');
//     protected static $group_team1 = env('TELEGRAM_TEAM1');
//     protected static $group_buffet = env('GROUP_BUFFET');


//     public static function sendMessage($message)
//     {

//         // Log the message before sending
//         Log::info('Telegram Message:', ['chat_id' => self::$chat_id, 'message' => $message]);

//         $response = Http::withoutVerifying()->post(self::$url, [
//             'chat_id' => self::$chat_id,
//             'text' => $message,
//             'parse_mode' => 'HTML'
//         ]);


//         $response = Http::withoutVerifying()->post(self::$url, [
//             'chat_id' => self::$group_expense_management,
//             'text' => $message,
//             'parse_mode' => 'HTML'
//         ]);

//         Log::info('Telegram Response:', $response->json()); // Log response from Telegram
//     }


//     public static function sendPhoto($filePath, $caption = '')
//     {
//         $url = "https://api.telegram.org/bot" . self::$token . "/sendPhoto";

//         Http::attach(
//             'photo', file_get_contents(storage_path('app/public/' . $filePath)), basename($filePath)
//         )->post($url, [
//             // 'chat_id' => self::$chat_id,
//             'caption' => $caption,
//             'parse_mode' => 'Markdown',
//         ]);
//     }


namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TelegramHelper
{
    protected static $token;
    protected static $chat_id;
    protected static $group_expense_management;
    protected static $group_team1;
    protected static $group_buffet;

    // Initialize static properties in a constructor-like method
    public static function initialize()
    {
        self::$token = env('TELEGRAM_BOT_TOKEN');
        self::$chat_id = env('TELEGRAM_CHAT_ID');
        self::$group_expense_management = env('TELEGRAM_GROUP_EXPENSE_MANAGEMENT');
        self::$group_team1 = env('TELEGRAM_TEAM1');
        self::$group_buffet = env('GROUP_BUFFET');
    }

    // Send a message to a specified chat ID
    public static function sendMessage($message, $chatId = null)
    {
        self::initialize(); // Ensure properties are set

        $chatId = $chatId ?? self::$chat_id; // Default to main chat ID if none provided
        $url = "https://api.telegram.org/bot" . self::$token . "/sendMessage";

        // Log the message before sending
        Log::info('Telegram Message:', ['chat_id' => $chatId, 'message' => $message]);

        $response = Http::withoutVerifying()->post($url, [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML', // Consistent with your original choice
        ]);

        Log::info('Telegram Response:', $response->json()); // Log response from Telegram

        return $response; // Return response for further handling if needed
    }

    // Optional: Send message to multiple chat IDs (e.g., groups)
    public static function sendMessageToGroups($message, array $chatIds = [])
    {
        self::initialize(); // Ensure properties are set

        $chatIds = !empty($chatIds) ? $chatIds : [
            self::$chat_id,
            self::$group_expense_management,
            self::$group_team1,
            self::$group_buffet,
        ];

        foreach ($chatIds as $chatId) {
            if ($chatId) { // Skip if chat ID is null or empty
                self::sendMessage($message, $chatId);
            }
        }
    }



    // Send a photo to a specified chat ID
    public static function sendPhoto($filePath, $caption = '', $chatId = null)
    {
        self::initialize(); // Ensure properties are set

        $group_expense_management = $group_expense_management ?? self::$group_expense_management;
        $chatId = $chatId ?? self::$chat_id; // Default to main chat ID if none provided
        $url = "https://api.telegram.org/bot" . self::$token . "/sendPhoto";

        // Log the photo details before sending
        Log::info('Telegram Photo:', ['chat_id' => $chatId, 'file_path' => $filePath, 'caption' => $caption]);

        $response = Http::withoutVerifying()
            ->attach(
                'photo',
                file_get_contents(storage_path('app/public/' . $filePath)),
                basename($filePath)
            )
            ->post($url, [
                'chat_id' => $chatId,
                'caption' => $caption,
                'parse_mode' => 'HTML', // Match sendMessage parse mode
            ]);

        $response = Http::withoutVerifying()
        ->attach(
            'photo',
            file_get_contents(storage_path('app/public/' . $filePath)),
            basename($filePath)
        )
        ->post($url, [
            'chat_id' => $group_expense_management,
            'caption' => $caption,
            'parse_mode' => 'HTML', // Match sendMessage parse mode
        ]);
        

        Log::info('Telegram Photo Response:', $response->json()); // Log response from Telegram

        return $response; // Return response for further handling if needed
    }


}





