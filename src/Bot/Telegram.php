<?php

namespace App\Bot;

use App\LectureService;
use App\Provider\LectureProvider;
use App\Repository\SpeakerRepository;
use App\Repository\UserRepository;
use Longman\TelegramBot\Telegram as VendorTelegram;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Telegram extends VendorTelegram
{

    const BOT_API_KEY = '586818585:AAFz5J_rX2zU4fVe8RfyO3xVqwCr9N-FUZA';
    const BOT_USERNAME = 'resonate.io';

    public function __construct(
        ContainerInterface $container,
        LectureProvider $lectureProvider,
        LectureService $lectureService,
        UserRepository $userRepository,
        SpeakerRepository $speakerRepository
    ) {
        parent::__construct(self::BOT_API_KEY, self::BOT_USERNAME);
        $this->uploadsPath = __DIR__.'/../../public/uploads/';
        $mari = $container->getParameter('database.name');
        $this->lectureProvider = $lectureProvider;
        $this->lectureService = $lectureService;
        $this->userRepository = $userRepository;
        $this->speakerRepository = $speakerRepository;
    }

    /**
     * @var string
     */
    private $uploadsPath;

    /**
     * @var array
     */
    public $commandArguments = [];

    /**
     * @var LectureProvider
     */
    protected $lectureProvider;

    /**
     * @var LectureService
     */
    protected $lectureService;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var SpeakerRepository
     */
    protected $speakerRepository;

    /**
     * @return LectureProvider
     */
    public function getLectureProvider(): LectureProvider
    {
        return $this->lectureProvider;
    }

    /**
     * @return LectureService
     */
    public function getLectureService(): LectureService
    {
        return $this->lectureService;
    }

    /**
     * @return UserRepository
     */
    public function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    /**
     * @return SpeakerRepository
     */
    public function getSpeakerRepository(): SpeakerRepository
    {
        return $this->speakerRepository;
    }

}