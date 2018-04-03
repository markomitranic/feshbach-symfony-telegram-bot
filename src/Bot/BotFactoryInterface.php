<?php

namespace App\Bot;

interface BotFactoryInterface
{

    public static function create(string $key);

}