<?php

namespace Drupal\pusher_api\DTO;

class Data implements \JsonSerializable {
  public function __construct(
    public readonly array $data,
  ) {
  }

  public function jsonSerialize(): array {
    return $this->data;
  }
}