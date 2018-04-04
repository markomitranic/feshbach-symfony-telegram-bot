<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use App\DogApi;
use App\Logger;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Request;

class PugBombCommand extends SystemCommand
{

    /**
     * @var string
     */
    protected $name = 'pug_bomb';

    /**
     * @var string
     */
    protected $description = 'Gimme a pug!';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * @var bool
     */
    protected $private_only = true;

    /**
     * @var CallbackQuery
     */
    protected $callbackQuery;

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $this->callbackQuery = $this->getCallbackQuery();
        if (!$this->callbackQuery) {
            return Request::emptyResponse();
        }

        $data = [];
        $data['chat_id'] = $this->callbackQuery->getMessage()->getChat()->getId();
        $data['message_id'] = $this->callbackQuery->getMessage()->getMessageId();
        $data['parse_mode'] = 'HTML';
        $data['disable_web_page_preview'] = true;

        try {
            $pugImage = DogApi::getRandomPugImage();
        } catch (\Exception $e) {
            Logger::getLogger()->error($e->getMessage(), $e->getTrace());
            $data = [
                'callback_query_id' => $this->callbackQuery->getId(),
                'text'              => 'Woof. I am so, so, so sorry. I am unable to obtain a propper pug image at the moment, and we both know you wouldn\'t like an imitation.',
                'show_alert'        => true,
                'cache_time'        => 5,
            ];

            return Request::answerCallbackQuery($data);
        }
        $data['text'] = $pugImage;
        $data['photo'] = Request::encodeFile($pugImage);

        Request::answerCallbackQuery(['callback_query_id' => $this->callbackQuery->getId()]);

        return Request::sendPhoto($data);
    }

}