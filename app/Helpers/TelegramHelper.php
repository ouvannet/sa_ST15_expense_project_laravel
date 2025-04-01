<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

// class TelegramHelper
// {
//     protected static $token;
//     protected static $chat_id;
//     protected static $group_expense_management;
//     protected static $group_team1;
//     protected static $group_buffet;

//     // Initialize static properties in a constructor-like method
//     public static function initialize()
//     {
//         self::$token = env('TELEGRAM_BOT_TOKEN');
//         self::$chat_id = env('TELEGRAM_CHAT_ID');
//         self::$group_expense_management = env('TELEGRAM_GROUP_EXPENSE_MANAGEMENT');
//         self::$group_team1 = env('TELEGRAM_TEAM1');
//         self::$group_buffet = env('GROUP_BUFFET');
//     }

//     // Send a message to group_buffet and group_team1 (or a specified chat ID)
//     public static function sendMessage($message, $chatId = null)
//     {
//         self::initialize(); // Ensure properties are set
//         $url = "https://api.telegram.org/bot" . self::$token . "/sendMessage";

//         // Default chat IDs to send to: group_buffet and group_team1
//         $defaultChatIds = $chatId;

//         // If a specific chatId is provided, override the default list
//         $chatIds = $chatId ? [$chatId] : $defaultChatIds;

//         foreach ($chatIds as $id) {
//             if ($id) { // Skip if chat ID is null or empty
//                 // Log the message before sending
//                 Log::info('Telegram Message:', ['chat_id' => $id, 'message' => $message]);

//                 $response = Http::withoutVerifying()->post($url, [
//                     'chat_id' => $id,
//                     'text' => $message,
//                     'parse_mode' => 'HTML',
//                 ]);

//                 Log::info('Telegram Response:', $response->json()); // Log response from Telegram
//             }
//         }

//         return $response ?? null; // Return the last response for further handling if needed
//     }

//     // Optional: Send message to multiple chat IDs (e.g., groups)
//     public static function sendMessageToGroups($message, array $chatIds = [])
//     {
//         self::initialize(); // Ensure properties are set

//         $chatIds = !empty($chatIds) ? $chatIds : [
//             self::$chat_id,
//             self::$group_expense_management,
//             self::$group_team1,
//             self::$group_buffet,
//         ];

//         foreach ($chatIds as $chatId) {
//             if ($chatId) { // Skip if chat ID is null or empty
//                 self::sendMessage($message, $chatId);
//             }
//         }
//     }

//     // Send a photo to group_buffet and group_team1 (or a specified chat ID)
//     public static function sendPhoto($filePath, $caption = '', $chatId = null)
//     {
//         self::initialize(); // Ensure properties are set
//         $url = "https://api.telegram.org/bot" . self::$token . "/sendPhoto";
//         $defaultChatIds = $chatId;
//         // If a specific chatId is provided, override the default list
//         $chatIds = $chatId ? [$chatId] : $defaultChatIds;

//         foreach ($chatIds as $id) {
//             if ($id) { // Skip if chat ID is null or empty
//                 // Log the photo details before sending
//                 Log::info('Telegram Photo:', ['chat_id' => $id, 'file_path' => $filePath, 'caption' => $caption]);

//                 $response = Http::withoutVerifying()
//                     ->attach(
//                         'photo',
//                         file_get_contents(storage_path('app/public/' . $filePath)),
//                         basename($filePath)
//                     )
//                     ->post($url, [
//                         'chat_id' => $id,
//                         'caption' => $caption,
//                         'parse_mode' => 'HTML',
//                     ]);

//                 Log::info('Telegram Photo Response:', $response->json()); // Log response from Telegram
//             }
//         }

//         return $response ?? null; // Return the last response for further handling if needed
//     }
// }


class TelegramHelper
{
    protected static $token;
    protected static $chat_id;
    protected static $group_expense_management;
    protected static $group_team1;
    protected static $group_buffet;

    // Initialize static properties
    public static function initialize()
    {
        self::$token = env('TELEGRAM_BOT_TOKEN');
        self::$chat_id = env('TELEGRAM_CHAT_ID');
        self::$group_expense_management = env('TELEGRAM_GROUP_EXPENSE_MANAGEMENT');
        self::$group_team1 = env('TELEGRAM_TEAM1');
        self::$group_buffet = env('GROUP_BUFFET');
    }

    // Send a message to specified chat IDs
    public static function sendMessage($message, array $chatIds)
    {
        self::initialize(); // Ensure properties are set
        $url = "https://api.telegram.org/bot" . self::$token . "/sendMessage";
        $responses = [];
g
        if (empty($chatIds)) {
            throw new \Exception("No chat IDs provided for sending message.");
        }

        foreach ($chatIds as $id) {
            if ($id) { // Skip if chat ID is null or empty
                // Log the message before sending
                Log::info('Telegram Message:', ['chat_id' => $id, 'message' => $message]);

                $response = Http::withoutVerifying()->post($url, [
                    'chat_id' => $id,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                ]);

                Log::info('Telegram Response:', $response->json());
                $responses[$id] = $response; // Store response for each chat ID
            }
        }

        return $responses; // Return array of responses keyed by chat ID
    }

    // Send a photo to specified chat IDs
    public static function sendPhoto($filePath, $caption = '', array $chatIds)
    {
        self::initialize(); // Ensure properties are set
        $url = "https://api.telegram.org/bot" . self::$token . "/sendPhoto";
        $responses = [];

        if (empty($chatIds)) {
            throw new \Exception("No chat IDs provided for sending photo.");
        }

        foreach ($chatIds as $id) {
            if ($id) { // Skip if chat ID is null or empty
                // Log the photo details before sending
                Log::info('Telegram Photo:', ['chat_id' => $id, 'file_path' => $filePath, 'caption' => $caption]);

                $response = Http::withoutVerifying()
                    ->attach(
                        'photo',
                        file_get_contents(storage_path('app/public/' . $filePath)),
                        basename($filePath)
                    )
                    ->post($url, [
                        'chat_id' => $id,
                        'caption' => $caption,
                        'parse_mode' => 'HTML',
                    ]);

                Log::info('Telegram Photo Response:', $response->json());
                $responses[$id] = $response; // Store response for each chat ID
            }
        }

        return $responses; // Return array of responses keyed by chat ID
    }

    // Optional: Send message to multiple predefined groups
    public static function sendMessageToGroups($message, array $chatIds = [])
    {
        self::initialize(); // Ensure properties are set

        // Use provided chat IDs or default to all predefined groups
        $targetChatIds = !empty($chatIds) ? $chatIds : [
            self::$chat_id,
            self::$group_expense_management,
            self::$group_team1,
            self::$group_buffet,
        ];

        return self::sendMessage($message, $targetChatIds);
    }

    // Optional: Send photo to multiple predefined groups
    public static function sendPhotoToGroups($filePath, $caption = '', array $chatIds = [])
    {
        self::initialize(); // Ensure properties are set

        // Use provided chat IDs or default to all predefined groups
        $targetChatIds = !empty($chatIds) ? $chatIds : [
            self::$chat_id,
            self::$group_expense_management,
            self::$group_team1,
            self::$group_buffet,
        ];

        return self::sendPhoto($filePath, $caption, $targetChatIds);
    }
}
