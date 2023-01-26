<?php 

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *  Class DemoFrom.
 */
class DemoFromAlter extends FormBase{
    /**
     * { @inheritdoc}
     */
    public function getFormId(){
        return 'demoform';
    }

    /**
     * { @inheritdoc }
     */

     public function buildForm(array $form, FormStateInterface $form_state){
       $form['name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('name'),
        '#maxlength' => 64,
        '#size' => 64,
        '#weight' => '0',
      ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
     }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
    }
  }
}