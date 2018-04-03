<?php

namespace App\Bot;

use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

abstract class BotFactory implements BotFactoryInterface
{

    public static function create(string $key)
    {
        try {
            return new Api($key);
        } catch (TelegramSDKException $e) {
            return null;
        }
    }

}