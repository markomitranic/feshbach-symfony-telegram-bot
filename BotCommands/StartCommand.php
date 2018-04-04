<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Request;

class StartCommand extends UserCommand
{

    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * @var bool
     */
    protected $private_only = true;

    /**
     * @var bool
     */
    protected $need_mysql = true;

    /**
     * Conversation Object
     *
     * @var \Longman\TelegramBot\Conversation
     */
    protected $conversation;

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $text = 'Hi there!' . PHP_EOL;
        $text .= 'Hello! Welcome to our bot, for now, there is not much you can do.'. PHP_EOL.PHP_EOL;
        $text .= 'I am so sorry 😅, but in order to make you feel better, help yourself with a Pug bomb'. PHP_EOL;

        $inline_keyboard = new InlineKeyboard([
            ['text' => '🐨 Pug Bomb', 'callback_data' => 'pugBomb'],
        ]);

        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
            'reply_markup' => $inline_keyboard
        ];
        return Request::sendMessage($data);
    }

}
