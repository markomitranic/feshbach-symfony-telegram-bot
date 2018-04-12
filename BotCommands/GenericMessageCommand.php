<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use App\Bot\Exceptions\UnrecognizedCommandException;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

class GenericMessageCommand extends SystemCommand
{

    /**
     * @var string
     */
    protected $name = 'genericmessage';

    /**
     * @var string
     */
    protected $description = 'Reply to a generic message';

    /**
     * @var string
     */
    protected $version = '1.1.2';

    /**
     * @var array
     */
    private $allowedCallbackMessages = [
        '🔙' => 'homeScreenKeyboard',
        'Information Desk ℹ️' => 'infoDesk',
        'Tweet about us 🐦' => 'tweetAboutUs',
        'What now? ⏱' => 'WhatNow'
    ];

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $data = $message->getText();

        try {
            return $this->executeCommandByName($data);
        } catch (\Exception $e) {
            return $this->generateInvalidCommandReply($message->getChat()->getId());
        }
    }

    /**
     * @param string $commandName
     * @return mixed
     * @throws \Longman\TelegramBot\Exception\TelegramException
     * @throws UnrecognizedCommandException
     */
    private function executeCommandByName(string $commandName)
    {
        if (!isset($this->allowedCallbackMessages[$commandName])
            || !$this->getTelegram()->getCommandObject($this->allowedCallbackMessages[$commandName])) {
            throw new UnrecognizedCommandException();
        }

        return $this->getTelegram()->executeCommand($this->allowedCallbackMessages[$commandName]);
    }

    /**
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    private function generateInvalidCommandReply($chatId)
    {
        $data['chat_id'] = $chatId;
        $data['text'] = 'Ugh, didn\'t quite understand that, sorry.';
        return Request::sendMessage($data);
    }

}
