<?php
/**
 * @file
 * Contains \Drupal\customform\Form\customForm.
 */
namespace Drupal\dependency_injection_services\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class customForm extends FormBase {

  protected $loaddata;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form';
  }


  public function __construct(){
    $this->loaddata = \Drupal::service('dependency_injection_services.dbinsert');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Member Name:'),
      '#required' => TRUE,
    );

    $form['mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
    );

   

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $query = $this->loaddata->setData($form_state);
    \Drupal::messenger()->addMessage(t('Record has been saved'), 'status');
  }
}