<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use App\Provider\LectureProvider;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

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
     * @var LectureProvider
     */
    protected $lectureProvider;

    public function __construct(
        Telegram $telegram,
        Update $update = null
    ) {
        parent::__construct($telegram, $update);
    }

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

        try {
            $events = $this->getNextEvents();
        } catch (ResourceNotFoundException $e) {
            return $this->respondWithNoEvents($data);
        } catch (\Exception $e) {
            $data['text'] = 'Uh oh, something went wrong. 🤡';
            return Request::sendMessage($data);
        }


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

    /**
     * @param array $data
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    private function respondWithNoEvents(array $data)
    {
        $data['text'] = 'Sorry pal, i don\'t see any events starting in the next hour. 😐';

        $inline_keyboard = new InlineKeyboard([
            ['text' => 'See all events today?', 'callback_query' => 'command__whatNow__today']
        ]);
        $inline_keyboard = $inline_keyboard->setResizeKeyboard(true);
        $data['reply_markup'] = $inline_keyboard;
        return Request::sendMessage($data);
    }

    /**
     * @return \App\Entity\Lecture[]
     * @throws \Exception
     * @throws ResourceNotFoundException
     */
    private function getNextEvents()
    {
        return $this->lectureProvider->findLecturesInInterval(
            new \DateTimeImmutable(),
            new \DateTimeImmutable('+1 minute')
        );
    }

}