<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ChatGPTWhatsAppController extends Controller
{

    public function webhook(Request $request)
    {
        Log::info('Webhook Request: ' . json_encode($request->all()));

        $data = $request->input('data');
        $eventType = $request->input('event_type');

        if ($eventType !== 'message_received') {
            return response()->json(['status' => 'ignored']);
        }

        $from = $data['from'] ?? null;
        $to = $data['to'] ?? null;
        $message = $data['body'] ?? null;
        $messageId = $data['id'] ?? null;

        $myNumber = '96565145361'; // رقم النظام الرسمي

        // ✅ تجاهل الرسائل من نفس الرقم أو إذا كانت فارغة
        if (!$message || !$from || str_contains($from, $myNumber)) {
            Log::info('Ignored message: empty or from self.');
            return response()->json(['status' => 'ignored']);
        }

        // ✅ تجاهل رسائل المجموعات
        if (Str::endsWith($from, '@g.us')) {
            Log::info('Ignored group message.');
            return response()->json(['status' => 'ignored - group']);
        }

        // ✅ التحقق من التكرار
        if (Cache::has("ultramsg:msg:$messageId")) {
            Log::info("Message $messageId already processed.");
            return response()->json(['status' => 'duplicate']);
        }

        // ✅ معالجة GPT والرد
        $gptReply = $this->askChatGPT($message);
        $this->sendWhatsAppMessage($from, $gptReply);

        // ✅ منع التكرار لاحقًا
        Cache::put("ultramsg:msg:$messageId", true, now()->addMinutes(10));

        return response()->json(['status' => 'replied']);
    }

    protected function askChatGPT($message)
    {
        $apiKey = config('services.openai.key');

        $response = Http::withToken($apiKey)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    ['role' => 'system', 'content' => 'أجب كمساعد ذكي يتحدث العربية الفصحى.'],
                    ['role' => 'user', 'content' => $message],
                ],
            ]);

        if ($response->successful()) {
            return $response->json('choices.0.message.content');
        }

        Log::error('ChatGPT Error: ' . $response->body());
        return 'عذرًا، حدث خطأ أثناء محاولة الرد. حاول لاحقًا.';
    }

    protected function sendWhatsAppMessage($phone, $body)
    {
        $token = config('services.whatsapp.token');
        $instance = config('services.whatsapp.instance');

        $url = "https://api.ultramsg.com/{$instance}/messages/chat";

        $response = Http::asForm()->post($url, [
            'token' => $token,
            'to' => $phone,
            'body' => $body,
        ]);

        Log::info('UltraMsg response: ' . $response->body());
    }

}
