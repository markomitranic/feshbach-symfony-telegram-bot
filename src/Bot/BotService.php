<?php

namespace App\Bot;

use App\Logger;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;

class BotService
{

    const BOT_API_KEY = '586818585:AAFz5J_rX2zU4fVe8RfyO3xVqwCr9N-FUZA';
    const WEBHOOK_SET_ALLOW_TOKEN = 'ntvhn7-9Ve8RfyO-cz5J_rX2-zU4-t49903487';
    const HOOK_URL = 'https://6eb89280.ngrok.io/hook';
    const COMMANDS_PATH = __DIR__.'/../../BotCommands';

    /**
     * @var Telegram
     */
    private $api;

    public function __construct()
    {
        $this->api = BotFactory::create(self::BOT_API_KEY);
        TelegramLog::initialize(Logger::getLogger());
        return $this;
    }

    /**
     * @return bool
     * @throws TelegramException
     */
    public function handle()
    {
        $this->api->addCommandsPaths([self::COMMANDS_PATH]);
        $this->api->enableAdmins($this->getAdminUsers());
        $this->api->enableLimiter();
        $this->api->enableMySql($this->getMysqlConfig());

        // Set custom Upload and Download paths
        //$telegram->setDownloadPath(__DIR__ . '/Download');
        //$telegram->setUploadPath(__DIR__ . '/Upload');

        // Here you can set some command specific parameters
        // e.g. Google geocode/timezone api key for /date command
        //$telegram->setCommandConfig('date', ['google_api_key' => 'your_google_api_key_here']);

        // Botan.io integration
        //$telegram->enableBotan('your_botan_token');

        $this->api->handle();

        return true;
    }

    /**
     * @param string $authToken
     * @return bool
     */
    public function setWebHook(string $authToken)
    {
        if (!isset($authToken) || $authToken !== self::WEBHOOK_SET_ALLOW_TOKEN) {
            return false;
        }

        try {
            $this->api->setWebhook(self::HOOK_URL);
        } catch (TelegramException $e) {
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    private function getMysqlConfig()
    {
        return [
            'host'     => 'localhost',
            'user'     => 'root',
            'password' => '',
            'database' => 'feshbach',
        ];
    }

    /**
     * @return array
     */
    private function getAdminUsers()
    {
        return [
            'markomitranic'
        ];
    }

    /**
     * @return Telegram
     */
    public function getApi(): Telegram
    {
        return $this->api;
    }

}