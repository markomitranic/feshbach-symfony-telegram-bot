<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Request;

class WhatNowCommand extends UserCommand
{

    /**
     * @var string
     */
    protected $name = 'what_now';

    /**
     * @var string
     */
    protected $description = 'Get a short list of events that start during the next hour';

    /**
     * @var string
     */
    protected $usage = '/what_now';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Execute command
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $data['chat_id'] = $chat_id;

        $events = [
            'Franc Camps-Febrer - Forensic Architecture',
            'Hungry Castle - Fashion for Planet Earth',
            'Jan Robert Leegete - NetArt'
        ];

        $data['text'] = 'Sorry, I couldn’t find any matching lectures. 😐';

//        if (empty($events)) {
//            $data['text'] = 'Sorry, I couldn’t find any matching lectures. 😐';
//        } else {
//            $data['text'] = 'Here, just some quick and dirty direct links.';
//        }
//
//        $inline_keyboard = new InlineKeyboard([
//            ['text' => 'Tweet to @resonate.io', 'url' => 'https://twitter.com/intent/tweet?text=@resonate_io']
//        ],[
//            ['text' => 'Tweet to #res18', 'url' => 'https://twitter.com/intent/tweet?hashtags=res18']
//        ]);
//        $inline_keyboard = $inline_keyboard->setResizeKeyboard(true);
//        $data['reply_markup'] = $inline_keyboard;

        return Request::sendMessage($data);
    }
}