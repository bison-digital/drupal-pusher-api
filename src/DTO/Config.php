<?php

namespace Drupal\pusher_api\DTO;

class Config {

  public function __construct(
    public readonly string $appId,
    public readonly string $key,
    public readonly string $secret,
    public readonly array $options,
  ) {
  }

}