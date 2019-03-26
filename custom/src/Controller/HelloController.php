<?php 
/** 
* 
* Place this file in src/Controller folder inside the lotus module folder
**/
namespace Drupal\custom\Controller;
use Drupal\Core\Controller\ControllerBase;
class HelloController extends ControllerBase {
  public function content() {
    return array(
        '#type' => 'markup',
        '#markup' => $this->t('Welcome to my website!'),
    );
  }
  public function test(){
	return array(
        '#type' => 'markup',
        '#markup' => $this->t('Welcome Demo'),
    );  
  }
}
