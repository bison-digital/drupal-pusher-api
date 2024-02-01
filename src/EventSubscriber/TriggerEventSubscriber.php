<?php

namespace Drupal\pusher_api\EventSubscriber;

use Drupal\pusher_api\Event\TriggerEvent;
use Drupal\pusher_api\Service\PusherService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TriggerEventSubscriber implements EventSubscriberInterface {

  public function __construct(
    protected PusherService $pusherService,
  ) {
  }

  public static function getSubscribedEvents() {
    return [
      TriggerEvent::class => [
        ['trigger', -100]
      ],
    ];
  }

  public function trigger(TriggerEvent $event) {
    $this->pusherService->trigger(
      $event->channels,
      $event->event,
      $event->data,
    );
  }

}
