<?php

namespace App\BotCommands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class StartCommand extends Command
{

    /**
     * @var string Command Name
     */
    protected $name = "start";

    /**
     * @var string Command Description
     */
    protected $description = "Start Command to get you started";

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $this->replyWithMessage(
            [
                'text' => 'Hello! Welcome to our bot, for now, there is not much you can do.'
            ]
        );
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage(
            [
                'text' => 'I am so sorry 😅, but in order to make you feel better, help yourself with a Pug bomb.'
            ]
        );
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $keyboard = Keyboard::make()
            ->inline()
            ->row(
                Keyboard::button(
                    [
                        'text' => '🐨 Pug Bomb',
                        'callback_data' => 'reply_pug_bomb'
                    ]
                )
            )
            ->setOneTimeKeyboard(true)
            ->setResizeKeyboard(true);

        $this->replyWithMessage(
            [
                'text' => 'You know u want to... 😏',
                'reply_markup' => $keyboard
            ]
        );

        return 'Ok';

    }
}