<?php

namespace App\Controller;

use App\Bot\BotService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HookController extends Controller
{

    /**
     * @var BotService
     */
    private $bot;

    public function __construct(BotService $bot) {
        $this->bot = $bot;
    }

    public function hook(Request $request)
    {
        $requestContent = json_decode($request->getContent(), true);

        if (array_key_exists('callback_query', $requestContent)) {
            $this->bot->handleCallback(
                $requestContent->getContent()['callback_query']
            );
        } else {
            $this->bot->handle();
        }

        return new Response('Ok', 200);
    }



    public function set(string $authToken)
    {
        $webHookInfo = $this->bot->setWebHook($authToken);
        return new JsonResponse($webHookInfo);
    }

}