<?php

namespace Drupal\custom_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class Emailsending extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'email_notice_form';
  }

   /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Form constructor.
    $form = parent::buildForm($form, $form_state);
    // Default settings.
    $config = $this->config('emailsending.settings');

    

      $form['email_notice'] = array(
        '#type' => 'email',
        '#title' => t('Email'),
        '#required' => TRUE,
        '#default_value' => $config->get('emailsending.email_notice'),
        '#description' => "Please enter your email.",
        '#size' => 20,
        '#maxlength' => 20,
      );

      return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

}

/**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('emailsending.settings');
    $config->set('emailsending.email_notice', $form_state->getValue('email_notice'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

   /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'emailsending.settings',
    ];
  }
}