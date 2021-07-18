<?php

/**
 * @file
 * Post update functions for Action module.
 */

namespace Drupal\mymodule\Controller;
use Drupal\Core\Controller\ControllerBase;

/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @package  MyPackage
 * @author    A N Other 
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

Class FirstController extends ControllerBase {
    /**
     * This is content function
     *  
     */ 

    public function content() 
    {
        return [
            '#theme' => 'my_template',
            '#test_var' => $this->t('Test Value'),
          ];
    }
  }
