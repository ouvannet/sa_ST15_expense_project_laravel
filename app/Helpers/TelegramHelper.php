<?php
namespace App\Helpers;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TelegramHelper
{
    public static function sendMessage($message)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";
        $group_expense_management = env('TELEGRAM_GROUP_EXPENSE_MANAGEMENT');
        $group_team1 = env('TELEGRAM_TEAM1');
        $group_buffet = env('GROUP_BUFFET');

        // Log the message before sending
        Log::info('Telegram Message:', ['chat_id' => $chat_id, 'message' => $message]);

        $response = Http::withoutVerifying()->post($url, [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'HTML'
        ]);

        
        $response = Http::withoutVerifying()->post($url, [
            'chat_id' => $group_expense_management,
            'text' => $message,
            'parse_mode' => 'HTML'
        ]);


        Log::info('Telegram Response:', $response->json()); // Log response from Telegram
    }
}


