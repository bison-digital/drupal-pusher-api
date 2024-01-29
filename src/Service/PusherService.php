<?php

namespace Drupal\pusher_api\Service;

use Drupal\Core\Logger\LoggerChannel;
use Drupal\pusher_api\DTO\Channels;
use Drupal\pusher_api\DTO\Data;
use Drupal\pusher_api\DTO\Event;
use Pusher\Pusher;

class PusherService {

  public function __construct(
    protected Pusher $pusher,
    protected LoggerChannel $loggerChannel,
  ) {
  }

  public function trigger(Channels $channels, Event $event, Data $data): void {
    try {
      $this->pusher->trigger(
        $channels->getArrayCopy(),
        $event,
        $data,
      );
    } catch (\Throwable $throwable) {
      $this->loggerChannel->error('pusher_api: ' . $throwable->getMessage());
    }
  }

}