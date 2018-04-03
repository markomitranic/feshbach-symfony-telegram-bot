<?php

namespace App\BotCommands;

use App\Bot\BotService;
use Telegram\Bot\Exceptions\TelegramSDKException;

abstract class CommandObserver implements CommandObserverInterface
{

    public static function register(BotService $botService)
    {
        $botService->getApi()->addCommands([
            StartCommand::class,
            PugBombCommand::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function observeCommand(BotService $botService, BotCommand $command)
    {
        try {
            $botService->getApi()->addCommand($command);
        } catch (TelegramSDKException $e) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public static function removeCommand(BotService $botService, BotCommand $command)
    {
        $botService->getApi()->removeCommand($command);
        return true;
    }
}