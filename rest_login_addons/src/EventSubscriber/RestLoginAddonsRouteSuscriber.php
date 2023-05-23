<?php

namespace Drupal\rest_login_addons\EventSubscriber;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class PIcoreRouteSuscriber.
 */
class RestLoginAddonsRouteSuscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {
    $route_login = $collection->get('user.login.http');
    /*$route_login->setDefaults([
      '_controller' => '\Drupal\rest_login_addons\Controller\RestLoginAddonsController::login',
    ]);*/
	$route_login->setDefault('_controller', '\Drupal\rest_login_addons\Controller\RestLoginAddonsController::login');
	//$route_login->setPath('/rest_login_addons/login');
	//$collection->add('user.login.http', $route_login);


  }

}