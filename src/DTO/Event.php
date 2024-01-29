<?php

namespace Drupal\pusher_api\DTO;

class Event {
  public function __construct(
    public readonly string $name,
  ) {
  }

  public function __toString(): string {
    return $this->name;
  }
}