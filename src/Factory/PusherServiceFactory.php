<?php

namespace Drupal\pusher_api\Factory;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\pusher_api\Service\PusherService;

class PusherServiceFactory {

  public function __construct(
    protected ConfigFactory $configFactory,
    protected PusherFactory $pusherFactory,
    protected LoggerChannelFactoryInterface $loggerChannelFactory,
  ) {
  }

  public function create(string $key): PusherService {
    $config = $this->configFactory->create($key);
    $pusher = $this->pusherFactory->create($config);
    $logger = $this->loggerChannelFactory->get('pusher_api.pusher.service.' . $key);
    $pusher->setLogger($logger);

    return new PusherService(
      $pusher,
      $logger,
    );
  }

}
