<?php

namespace Drupal\pusher_api\Factory;

use Drupal\pusher_api\DTO\Config;
use Pusher\Pusher;

class PusherFactory {
  public function create(Config $config): Pusher {
    return new Pusher($config->key, $config->secret, $config->appId, $config->options);
  }
}