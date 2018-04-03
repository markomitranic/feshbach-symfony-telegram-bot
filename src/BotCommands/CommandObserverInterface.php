<?php

namespace App\BotCommands;

use App\Bot\BotService;

interface CommandObserverInterface
{

    public static function register(BotService $bot);

    /**
     * @param BotService $bot
     * @param BotCommand $command
     * @return bool
     */
    public static function observeCommand(BotService $bot, BotCommand $command);

    /**
     * @param BotService $bot
     * @param BotCommand $command
     * @return bool
     */
    public static function removeCommand(BotService $bot, BotCommand $command);

}