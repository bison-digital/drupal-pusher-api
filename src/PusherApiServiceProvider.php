<?php

namespace Drupal\pusher_api;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Drupal\pusher_api\Factory\PusherFactory;
use Drupal\pusher_api\Service\PusherService;

class PusherApiServiceProvider extends ServiceProviderBase {

  public function register(ContainerBuilder $container): void {
    try {
      /** @var \Drupal\Core\Logger\LoggerChannelFactory $loggerChannelFactory */
      $loggerChannelFactory = $container->get('logger.channel.factory');
      /** @var \Drupal\pusher_api\Factory\ConfigFactory $configFactory */
      $configFactory = $container->get('pusher_api.config.factory');
      $pusherFactory = new PusherFactory();

      foreach ($configFactory->keys() as $key) {
        try {
          $config = $configFactory->create($key);
          $pusherServiceId = 'pusher_api.pusher.service.' . $config->appId;
          $loggerChannel = $loggerChannelFactory->get($pusherServiceId);

          $pusher = $pusherFactory->create($config);
          $pusher->setLogger($loggerChannel);

          $container
            ->register($pusherServiceId, PusherService::class)
            ->addArgument($pusher)
            ->addArgument($loggerChannel);
        } catch (\Exception $exception) {
          //@todo: Log service specific message.
        }
      }

    } catch (\Exception $exception) {
      //@todo: Log any leaky exceptions.
    }
  }

}