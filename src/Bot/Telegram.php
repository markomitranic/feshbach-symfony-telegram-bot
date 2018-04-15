<?php

namespace App\Bot;

use App\Provider\LectureProvider;
use Longman\TelegramBot\Telegram as VendorTelegram;

class Telegram extends VendorTelegram
{

    const BOT_API_KEY = '586818585:AAFz5J_rX2zU4fVe8RfyO3xVqwCr9N-FUZA';
    const BOT_USERNAME = 'resonate.io';

    public function __construct(
        LectureProvider $lectureProvider
    ) {
        parent::__construct(self::BOT_API_KEY, self::BOT_USERNAME);
        $this->lectureProvider = $lectureProvider;
    }

    /**
     * @var LectureProvider
     */
    protected $lectureProvider;

    /**
     * @return LectureProvider
     */
    public function getLectureProvider(): LectureProvider
    {
        return $this->lectureProvider;
    }

}