<?php

namespace Drupal\pusher_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\pusher_api\DTO\Data;
use Drupal\pusher_api\Event\AuthenticationEvent;
use Drupal\pusher_api\Service\PusherService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationController extends ControllerBase {

  public function __construct(
    protected AccountInterface $currentUser,
    protected EventDispatcher $eventDispatcher,
    protected PusherService $pusherService,
  ) {
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user'),
      $container->get('pusher_api.pusher.service.default'),
      $container->get('event.dispatcher'),
    );
  }

  public function login(Request $request): JsonResponse {
    if ($this->currentUser->isAuthenticated() == FALSE) {
      return new JsonResponse('Forbidden', 403);
    }

    $data = new Data(['id' => (string) $this->currentUser->id()]);

    $data = $this->eventDispatcher->dispatch(new AuthenticationEvent($data));

    return $this->pusherService->authenticateUser(
      $request->request->get('socket_id'),
      $data,
    );
  }
}