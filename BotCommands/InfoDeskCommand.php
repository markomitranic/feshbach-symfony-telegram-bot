<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Request;

class InfoDeskCommand extends UserCommand
{

    /**
     * @var string
     */
    protected $name = 'infoDesk';

    /**
     * @var string
     */
    protected $description = 'Shows all the options.';

    /**
     * @var string
     */
    protected $usage = '/info-desk';

    /**
     * @var string
     */
    protected $version = '1.0.0';

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
        $data['chat_id'] = $chat_id;

        $text = 'Hi there!' . PHP_EOL;
        $text .= 'We had a lot of options, and to fit them in such a small space was no small feat. So i figured let’s create a giant hamburger menu. 🍔'. PHP_EOL;
        $text .= PHP_EOL;
        $text .= 'That always solves the problem, right? 🤔'. PHP_EOL;
        $data['text'] = $text;

        $data['reply_markup'] = new InlineKeyboard([
            ['text' => 'Take the personal survey! 📊', 'callback_data' => 'command__personalSurvey']
        ]);

        Request::sendMessage($data);


        $data = [];
        $data['chat_id'] = $chat_id;

        $keyboard = new Keyboard([
            ['text' => 'Upcoming Talks ☝🏻'],
            ['text' => 'Speakers 🔊']
        ], [
            ['text' => 'Full Timetable ⛓'],
            ['text' => 'Social Media 🎎']
        ], [
            ['text' => 'Get Directions 🗺'],
            ['text' => 'Belgrade Map 🏬']
        ], [
            ['text' => 'Your profile 🤷🏽‍♀️'],
            ['text' => 'About Feshbach 🤖']
        ], [
            ['text' => '🔙']
        ]);
        $keyboard = $keyboard
            ->setResizeKeyboard(true);

        $data['reply_markup'] = $keyboard;
        $data['text'] = 'Behold:';

        return Request::sendMessage($data);
    }
}
