<?php

namespace Drupal\example_dependency_injection\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Egulias\EmailValidator\EmailValidator;
use Drupal\Core\Session\AccountInterface;

/**
 * Implements an example form.
 */
class without_di_current_user extends FormBase { 
    
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $options = NULL) {
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Your email address'),
      '#required' => TRUE,
    ];

    $form['actions']['send'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
    ];

    return $form;
  }
  public function getFormId() {
    return 'drupal_email';
  }

  public function validateForm(array &$form, FormStateInterface $form_state) { 
    $value = $form_state->getValue('email');
    if ($value == !\Drupal::service('email.validator')->isValid($value)) {
      $form_state->setErrorByName('email', t('The email address %mail is not valid.', array('%mail' => $value)));
      return;
    }
  }
  public function submitForm(array &$form, FormStateInterface $form_state) { 
    $current_user = \Drupal::currentUser();
    if($user){
        drupal_set_message(t('Form Submitted By Login User'), 'status');
    } else {
        drupal_set_message(t('Form Submitted By End User'));
    }
  }
}