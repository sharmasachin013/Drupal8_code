<?php

namespace Drupal\dependency_injection_services\services;

use Drupal\Core\Database\Connection;

class Db_insert{
    protected $database;
    public function __construct(Connection $database){
      $this->database = $database;
    }

    /**
     *  Set Data function
     */
    
    public function setData($form_state){
      $this->database->insert('customform')
      ->fields(array(
          'mail' => $form_state->getValue('mail'),
          'name' => $form_state->getValue('name'),
          'created' => time(),
          ))
          ->execute();
       
    
    }

    /**
     * get Data function
     */

    public function getData(){
        $query = $this->database->select('customform','cf');
        $query->fields('cf');
        $result = $query->execute()->fetchAll();
        return $result;
     }
}

