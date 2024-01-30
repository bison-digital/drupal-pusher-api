<?php

namespace Drupal\pusher_api\Event;

use Drupal\pusher_api\DTO\Data;
use Symfony\Contracts\EventDispatcher\Event;

class AuthenticationEvent extends Event {

  public function __construct(
    protected Data $data,
  ) {
  }

  public function getData(): Data {
    return $this->data;
  }

  public function setData(Data $data): void {
    $this->data = $data;
  }

}