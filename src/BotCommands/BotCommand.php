<?php

namespace App\BotCommands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Commands\CommandInterface;

abstract class BotCommand extends Command implements CommandInterface
{

}