<?php

namespace Drupal\rest_login_addons\Controller;

use Drupal\Core\Access\CsrfTokenGenerator;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Flood\FloodInterface;
use Drupal\Core\Routing\RouteProviderInterface;
use Drupal\user\Controller\UserAuthenticationController;
use Drupal\user\UserAuthInterface;
use Drupal\user\UserStorageInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Drupal\Core\Access\AccessResultForbidden;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Class RestLoginAddonsController.
 *
 * We are altering the user.login route to add all the cusom fields here.
 */
class RestLoginAddonsController extends UserAuthenticationController {

  /**
   * Logs in a user.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   A response which contains the ID and CSRF token.
   */
  public function loginNew(Request $request) {
    $response_data = parent::login($request);


    // We need to fetch the uid and load the user.
    $content = $response_data->getContent();
    $decoded_data = $this->serializer->decode($content, 'json');
    $uid = $decoded_data['current_user']['uid'];
    $user = $this->userStorage->load($uid);

    // Fetching the custom data.
    $decoded_data = $this->fetchCustomfields($user, $decoded_data);
    $encoded_custom_data = $this->serializer->encode($decoded_data, 'json');
    $response_data->setContent($encoded_custom_data);
    return $response_data;
  }

  /**
   * Fetching custom fields.
   *
   * @param object $user
   *   The user object.
   * @param array $response_data
   *   The array of responses.
   *
   * @return mixed
   *   The response
   */
  protected function fetchCustomfields($user, array $response_data) {
    //$response_data['age'] = $user->get('field_age')->value;
       $response_data['mobile'] = $user->get('field_mobile')->value;
	   $response_data['age'] = '35';
    return $response_data;
  }

}