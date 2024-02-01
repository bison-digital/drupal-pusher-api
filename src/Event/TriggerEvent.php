<?php

namespace Drupal\pusher_api\Event;

use Drupal\pusher_api\DTO\Channels;
use Drupal\pusher_api\DTO\Data;
use Drupal\pusher_api\DTO\Event;
use Symfony\Contracts\EventDispatcher\Event as SymfonyEvent;

class TriggerEvent extends SymfonyEvent {

  public function __construct(
    public readonly Channels $channels,
    public readonly Event $event,
    public readonly Data $data,
  ) {
  }

}
