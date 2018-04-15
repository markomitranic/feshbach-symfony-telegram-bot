<?php

namespace App\Bot;

use App\Provider\LectureProvider;
use Longman\TelegramBot\Telegram as VendorTelegram;

class Telegram extends VendorTelegram
{

    /**
     * @var LectureProvider
     */
    protected $lectureProvider;

    /**
     * @param LectureProvider $lectureProvider
     */
    public function setLectureProvider(LectureProvider $lectureProvider): void
    {
        $this->lectureProvider = $lectureProvider;
    }

    /**
     * @return LectureProvider
     */
    public function getLectureProvider(): LectureProvider
    {
        return $this->lectureProvider;
    }

}