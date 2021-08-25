<?php

namespace Drupal\custom_config_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DefaultForm.
 */
class DefaultForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'custom_config_form.default',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'default_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_config_form.default');
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('first_name'),
    ];
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('last_name'),
    ];

    $form['url'] = [
      '#type' => 'url',
      '#title' => $this->t('Url'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('url'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('custom_config_form.default')
      ->set('first_name', $form_state->getValue('first_name'))
      ->set('last_name', $form_state->getValue('last_name'))
      ->save();
  }

}
