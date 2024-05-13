<?php

require 'vendor/autoload.php';


use App\Router;
use App\Controllers\User;
use App\Controllers\Messages;
use App\Controllers\Bots;

new Router([
  'user/:id' => User::class,
  'messages' => Messages::class,
  'bots' => Bots::class
]);

