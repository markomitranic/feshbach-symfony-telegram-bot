<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use App\DogApi;
use App\Logger;
use GuzzleHttp\Exception\GuzzleException;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Request;

/**
 * Callback query command
 *
 * This command handles all callback queries sent via inline keyboard buttons.
 *
 * @see InlinekeyboardCommand.php
 */
class CallbackqueryCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'callbackquery';

    /**
     * @var string
     */
    protected $description = 'Reply to callback query';

    /**
     * @var string
     */
    protected $version = '1.1.1';

    /**
     * @var array
     */
    private $commands = [
        'pugBomb' => 'pugBomb'
    ];

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $callback_query = $this->getCallbackQuery();
        $data = $callback_query->getData();

        $command = explode('_', $data);
        $command = $command[0];

        if (isset($this->commands[$command]) && $this->getTelegram()->getCommandObject($this->commands[$command])) {
            return $this->getTelegram()->executeCommand($this->commands[$command]);
        } else {
            $data = [];
            $data['callback_query_id'] = $callback_query->getId();
            $data['text'] = 'Invalid request!';
            $data['show_alert'] = true;
        }

        return Request::answerCallbackQuery($data);
    }

}
