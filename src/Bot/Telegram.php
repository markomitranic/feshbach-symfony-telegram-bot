<?php

namespace App\Bot;

use App\LectureService;
use App\Provider\LectureProvider;
use App\Repository\UserRepository;
use Longman\TelegramBot\Telegram as VendorTelegram;

class Telegram extends VendorTelegram
{

    const BOT_API_KEY = '586818585:AAFz5J_rX2zU4fVe8RfyO3xVqwCr9N-FUZA';
    const BOT_USERNAME = 'resonate.io';

    public function __construct(
        LectureProvider $lectureProvider,
        LectureService $lectureService,
        UserRepository $userRepository
    ) {
        parent::__construct(self::BOT_API_KEY, self::BOT_USERNAME);
        $this->lectureProvider = $lectureProvider;
        $this->lectureService = $lectureService;
        $this->userRepository = $userRepository;
    }

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

}