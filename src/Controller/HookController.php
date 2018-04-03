<?php

namespace App\Controller;

use App\Bot\BotService;
use App\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HookController extends Controller
{

    /**
     * @var BotService
     */
    private $bot;

    public function __construct(
        BotService $bot,
        LoggerInterface $logger
    ) {
        Logger::init($logger);
        $this->bot = $bot;
    }

    /**
     * @return Response
     */
    public function hook()
    {
        try {
            $this->bot->handle();
        } catch (\Exception $e) {
            Logger::getLogger()->error($e->getMessage(), $e->getTrace());
            return new Response('Not Ok', 500);
        }

        return new Response('Ok', 200);
    }

    /**
     * @param string $authToken
     * @return JsonResponse
     */
    public function set(string $authToken)
    {
        $webHookInfo = $this->bot->setWebHook($authToken);
        return new JsonResponse($webHookInfo);
    }

    /**
     * @return Response
     */
    public function sanity()
    {
        return new Response('is ok. u here.', 200);
    }

}