<?php

namespace App\Bot;

use Longman\TelegramBot\Exception\TelegramException;

abstract class BotFactory implements BotFactoryInterface
{

    /**
     * @param string $key
     * @return Telegram|null
     */
    public static function create(string $key)
    {
        try {
            $telegram = new Telegram($key, 'resonate.io');
        } catch (TelegramException $e) {
            return null;
        }

        return $telegram;
    }

}