<?php

namespace Drupal\pusher_api\Factory;

use Drupal\Core\Site\Settings;
use Drupal\pusher_api\DTO\Config;

class ConfigFactory {

  public function __construct(
    protected Settings $settings
  ) {
  }

  public function keys(): array {
    return array_keys($this->get());
  }

  public function create(string $key = 'default'): Config {
    $settings = $this->get();

    if (empty($settings[$key])) {
      throw new \Exception('Pusher API settings for "' . $key .'" are not defined, please check pusher_api documentation.');
    }

    if (!is_array($settings[$key])) {
      throw new \Exception('Pusher API channel settings must be an array, please check pusher_api documentation.');
    }

    $channelSettings = $settings[$key];

    if (!array_key_exists('options', $channelSettings) || !is_array($channelSettings['options'])) {
      throw new \Exception('Pusher API channel "options" must be an array, please check pusher_api documentation.');
    }

    return new Config(
      $channelSettings['app_id'],
      $channelSettings['key'],
      $channelSettings['secret'],
      $channelSettings['options'],
    );
  }

  private function get(): array {
    $settings = $this->settings->get('pusher_api');

    if (!is_array($settings) || empty($settings)) {
      throw new \Exception('Pusher API settings not defined, please check pusher_api documentation.');
    }

    return $settings;
  }
}