<?php

namespace Drupal\pusher_api\Service;

use Drupal\Core\Logger\LoggerChannel;
use Drupal\pusher_api\DTO\Channels;
use Drupal\pusher_api\DTO\Data;
use Drupal\pusher_api\DTO\Event;
use Pusher\Pusher;
use Symfony\Component\HttpFoundation\JsonResponse;

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

  public function authenticateUser(string $webSocketId, Data $data): JsonResponse {
    try {
      return new JsonResponse(
        data: $this->pusher->authenticateUser($webSocketId, $data->data),
        json: TRUE,
      );
    } catch (\Throwable $throwable) {
      $this->loggerChannel->error('pusher_api: ' . $throwable->getMessage());
    }

    return new JsonResponse('Something went wrong...', 500);
  }

}