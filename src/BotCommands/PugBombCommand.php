<?php

namespace App\BotCommands;

use Telegram\Bot\Actions;

class PugBombCommand extends BotCommand
{

    /**
     * @var string Command Name
     */
    protected $name = "pug_bomb";

    /**
     * @var string Command Description
     */
    protected $description = "Gimme a pug!";

    /**
     * {@inheritdoc}
     */
    public function handle()
    {

        $this->callb

        $this->replyWithMessage([
            'text' => 'https://www.pets4homes.co.uk/images/breeds/13/09c3ab97c079eac13e829b44f457313e.jpg'
        ]);
//        $this->replyWithChatAction(['action' => Actions::UPLOAD_PHOTO]);

//        $message = $this->replyWithPhoto([
//            'photo' => 'https://www.pets4homes.co.uk/images/breeds/13/09c3ab97c079eac13e829b44f457313e.jpg',
//            'caption' => 'A pug and a pug.'
//        ]);

//        $this->replyWithMessage([
//            'text' => $message
//        ]);

        return 'Ok';





    }
}