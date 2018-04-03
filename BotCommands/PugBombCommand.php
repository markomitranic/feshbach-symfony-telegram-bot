<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use App\Logger;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

class PugBombCommand extends SystemCommand
{

    /**
     * @var string
     */
    protected $name = 'pug_bomb';

    /**
     * @var string
     */
    protected $description = 'Gimme a pug!';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * @var bool
     */
    protected $private_only = true;

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $callback_query    = $this->getCallbackQuery();
        $callback_query_id = $callback_query->getId();
        $callback_data     = $callback_query->getData();

        $data = [
            'callback_query_id' => $callback_query_id,
            'text'              => 'Hello World!',
            'show_alert'        => $callback_data === 'thumb up',
            'cache_time'        => 5,
        ];

        return Request::answerCallbackQuery($data);
//
//
//        Logger::getLogger()->error('OVDE');
//        $message = $this->getMessage();
//        $chat_id = $message->getChat()->getId();
//        $text    = 'Hi there!' . PHP_EOL . 'Type /help to see all commands!';
//
//        $data = [
//            'chat_id' => $chat_id,
//            'text'    => $text,
//        ];
//
//        return Request::sendMessage($data);

        //        $this->callb

//        $this->replyWithMessage([
//            'text' => 'https://www.pets4homes.co.uk/images/breeds/13/09c3ab97c079eac13e829b44f457313e.jpg'
//        ]);
//        $this->replyWithChatAction(['action' => Actions::UPLOAD_PHOTO]);

//        $message = $this->replyWithPhoto([
//            'photo' => 'https://www.pets4homes.co.uk/images/breeds/13/09c3ab97c079eac13e829b44f457313e.jpg',
//            'caption' => 'A pug and a pug.'
//        ]);

//        $this->replyWithMessage([
//            'text' => $message
//        ]);
    }

}