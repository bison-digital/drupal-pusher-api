<?php

namespace Drupal\pusher_api;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Drupal\pusher_api\Factory\PusherFactory;
use Drupal\pusher_api\Service\PusherService;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class PusherApiServiceProvider extends ServiceProviderBase {

  public function register(ContainerBuilder $container): void {
    try {
      /** @var \Drupal\pusher_api\Factory\ConfigFactory $configFactory */
      $configFactory = $container->get('pusher_api.config.factory');
      foreach ($configFactory->keys() as $key) {
        try {
          $container->register('pusher_api.pusher.service.' . $key, PusherService::class)
            ->setFactory([new Reference('pusher_api.pusher_service.factory'), 'create'])
            ->addArgument($key);
        } catch (\Exception $exception) {
          //@todo: Log any pusher app specific exceptions.
        }
      }

    } catch (\Exception $exception) {
      //@todo: Log any leaky exceptions.
    }
  }

}
