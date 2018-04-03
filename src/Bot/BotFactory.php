<?php

namespace App\Bot;

use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

abstract class BotFactory implements BotFactoryInterface
{

    /**
     * @param string $key
     * @return Telegram|null
     */
    public static function create(string $key)
    {
        try {
            return new Telegram($key, 'resonate.io');
        } catch (TelegramException $e) {
            return null;
        }
    }

}