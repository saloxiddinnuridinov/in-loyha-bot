<?php

namespace App\Http\Controllers;

use App\Models\BotUser;
use Telegram\Bot\Api;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;


class TelegramBotController extends Command
{
    private $bot;
    private $botupdate;
    private $message;
    private $chat_id;
    private $chat;

    public function __construct()
    {
        $this->bot = new Api();
    }

    public function handle()
    {

        try {
            /// keyboard example
//            $keyboard =
//                [
//                    'resize_keyboard' => true,
//                    'keyboard' =>
//                        [
//                            ['example 1', 'example 2', 'example 3'],
//                            ['example 4'],
//                            ['example 5', 'example 6'],
//                            ['example 7', 'example 8', 'example 9'],
//                        ]
//                ];
            // $update orqali barcha typelarni olamiz;
            $update = $this->bot->getWebhookUpdate();
            $this->botupdate = $update;

            $message = $update['message'];
            $this->message = $message;

            $chat = $message['chat'];
            $this->chat = $chat;
            $this->chat_id = $chat['id'];

            $this->bot->sendMessage([
                'chat_id' => $chat['id'],
                'text' => json_encode('Sizning arizangizni qabul qildik. Tez orada sizga xabar beramiz!'),
               // 'reply_markup' => json_encode($keyboard),
            ]);
            // Check user exists in DB
            $this->checkUserExists();

//            //sendmessage example
//            $this->bot->sendMessage([
//                'chat_id' => $chat['id'],
//                'text' => $message['text'],
//              //  'reply_markup' => json_encode($keyboard),
//            ]);

            $this->sendMe();
        } catch (\Throwable $th) {
            $response = $this->bot->sendMessage([
                'chat_id' => 1212223737,
                'text' => $th->getMessage(),
            ]);
            return $response;
        }
        //kod error berib qolsa errorni ko'rish uchun try catchda yozilgan
    }

    public function sendMe()
    {
        $response = $this->bot->sendMessage([
            'chat_id' => 1212223737,
            'text' => json_encode($this->botupdate, JSON_PRETTY_PRINT),
        ]);
    }

    public function checkUserExists()
    {
        $model = BotUser::where("chat_id", $this->chat_id)->first();

        if ($model === null) {
            $model = new BotUser();
            $model->name = $this->chat['first_name'];
            $model->surname = $this->chat['last_name'];
            $model->username = $this->chat['username'];
            $model->chat_id = $this->chat_id;
            $model->save();
        }
    }
}
