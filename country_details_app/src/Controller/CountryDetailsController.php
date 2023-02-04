<?php

namespace Drupal\country_details_app\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\country_details_app\CountryDetailsApp;

/**
 * Class CountryDetailsController.
 */
class CountryDetailsController extends ControllerBase {


  // Protected $httpClient.
  /**
   * @inheritdoc
   */

  /**
   * GuzzleHttp\ClientInterface definition.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $countryDetails;

  /**
   * {@inheritdoc}
   */
  public function __construct(CountryDetailsApp $countryDetails) {
    // $this->httpClient = $http_client.
    $this->countryDetails = $countryDetails;
  }

  /**
   * {@inheritdoc}.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('country_details_app.default')
    );
  }

  /**
   * Conterydetailspage.
   *
   * @return string
   *   Return Hello string.
   */
  public function countryDetailsPage() {
    $rows = $this->countryDetails->getCountryDetails();
    $header = [
      'col1' => t('Name'),
      'col2' => t('Currencies'),
    ];
    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#attached' => [
        'library' => [
          'country_details_app/globalcss',
        ],
      ],
    ];
  }

}
