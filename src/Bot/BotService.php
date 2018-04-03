<?php

namespace App\Bot;

use App\BotCommands\CommandObserver;
use Psr\Log\LoggerInterface;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

class BotService
{

    const BOT_API_KEY = '586818585:AAFz5J_rX2zU4fVe8RfyO3xVqwCr9N-FUZA';
    const WEBHOOK_SET_ALLOW_TOKEN = 'ntvhn7-9Ve8RfyO-cz5J_rX2-zU4-t49903487';
    const HOOK_URL = 'https://cb792568.ngrok.io/hook';

    /**
     * @var Api
     */
    private $api;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->api = BotFactory::create(self::BOT_API_KEY);
        CommandObserver::register($this);
        return $this;
    }

    public function handle()
    {
        $this->api->commandsHandler(true);
    }

    public function handleCallback(\ArrayObject $callbackQuery)
    {
        if (array_key_exists('data', $callbackQuery)) {
            // TODO: Handle callback
            $this->logger->info($callbackQuery['data']);
        }
    }

    /**
     * @param string $authToken
     * @return bool|\Telegram\Bot\Objects\WebhookInfo
     */
    public function setWebHook(string $authToken)
    {
        if (!isset($authToken) || $authToken !== self::WEBHOOK_SET_ALLOW_TOKEN) {
            return false;
        }

        try {
            $this->api->setWebhook([
                'url' => self::HOOK_URL,
            ]);
        } catch (TelegramSDKException $e) {
            return false;
        }

        return $this->api->getWebhookInfo();
    }

    /**
     * @return Api
     */
    public function getApi(): Api
    {
        return $this->api;
    }

}