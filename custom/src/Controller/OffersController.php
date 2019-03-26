<?php

namespace Drupal\custom\Controller;
use Drupal\Core\Controller\ControllerBase;
/**
 * Class OffersController.
 ** @package Drupal\lotus\Controller
 */ class OffersController extends ControllerBase
 {
    /**
      * Hello.
      * * @return string
      * Return Hello string.
      */
    public function hello($count)
    {
       return ['#type' => 'markup',
       '#markup' => $this->t('You will get %count% discount!!',
       array('%count' => $count)),];
    }
 }