<?php

namespace Drupal\rest_login_addons\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;
use Drupal\Core\Routing\RoutingEvents;

/**
 * Class RouteSubscriber.
 *
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
	   if ($route = $collection->get('user.login.http')) {
	     //$route->setRequirement('_csrf_token', 'TRUE');
         $route->setdefaults([
        '_controller' => '\Drupal\rest_login_addons\Controller\RestLoginAddonsController::loginNew',
      ]);
    } 
  }
}
