<?php 

namespace Drupal\ajax_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;

Class Ajaxexample extends FormBase {

  public function getFormId(){
    return 'dependentdrupaldownform';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $state_options = static::getFirstDropdownOptions();
  

  if (empty($form_state->getValue('state_dropdown'))) {
  // Use a default value.
    $selected_option = key($state_options);
  } 
  
  else {
    // Get the value if it already exists.
    $selected_option = $form_state->getValue('state_dropdown');
  }

  $form['option_state_fieldset'] = [
    '#type' => 'fieldset',
    '#title' => $this->t('Choose State'),
  ];

  $form['option_state_fieldset']['state_dropdown'] = [
    '#type' => 'select',
    '#title' => $this->t('State'),
    '#options' => $state_options,
    '#default_value' => $selected_option,
    // Bind an Ajax callback to the element.
    '#ajax' => [
      'callback' => '::instrumentDropdownCallback',
      'wrapper' => 'state-fieldset-container',
      'event' => 'change',
    ],
  ];

  $form['select_fieldset_container'] = [
    '#type' => 'container',
    '#attributes' => ['id' => 'state-fieldset-container'],
  ];

  $form['select_fieldset_container']['select_fieldset'] = [
    '#type' => 'fieldset',
    '#title' => $this->t('Choose an one'),
  ];

  $form['select_fieldset_container']['select_fieldset']['select_dropdown'] = [
    '#type' => 'select',
    '#title' => $state_options[$selected_option] . ' ' . $this->t('State'),
    '#options' => static::getSecondDropdownOptions($selected_option),
    '#default_value' => !empty($form_state->getValue('select_dropdown')) ? $form_state->getValue('select_dropdown') : '',
  ];

  $form['select_fieldset_container']['select_fieldset']['submit'] = [
    '#type' => 'submit',
    '#value' => $this->t('Submit'),
  ];

  if ($selected_option == 'none') {
    // Change the field title to provide user with some feedback on why the
    // field is disabled.
    $form['select_fieldset_container']['select_fieldset']['select_dropdown']['#title'] = $this->t('You must choose an state first.');
    $form['select_fieldset_container']['select_fieldset']['select_dropdown']['#disabled'] = TRUE;
    $form['select_fieldset_container']['select_fieldset']['submit']['#disabled'] = TRUE;
  }
  
  return $form;

 }

 public function submitForm(array &$form, FormStateInterface $form_state) { 
    $trigger = (string) $form_state->getTriggeringElement()['#value'];
    if ($trigger == 'Submit') {
      // Process submitted form data.
      drupal_set_message(t('Your form has been submitted'));
    }
    else {
    $form_state->setRebuild();
    }
 }

 public function instrumentDropdownCallback(array $form, FormStateInterface $form_state) {
    return $form['select_fieldset_container'];
  }

  public static function getFirstDropdownOptions() {
    return [
      'none' => 'none',
      'Gujarat' => 'Gujarat',
      'Madhya Pradesh' => 'Madhya Pradesh',
      'Maharashtra' => 'Maharashtra',
      'Uttar Pradesh' => 'Uttar Pradesh',
    ];
  }

  public static function getSecondDropdownOptions($key = '') {
    switch ($key) {
      case 'Gujarat':
        $options = [
          'Gandhinagar' => 'Gandhinagar',
          'Ahmedabad' => 'Ahmedabad',
          'Surat' => 'Surat',
          'Vadodara' => 'Vadodara',
        ];
        break;

      case 'Madhya Pradesh':
        $options = [
          'Indore' => 'Indore',
          'Bhopal' => 'Bhopal',
          'Gwalior' => 'Gwalior',
          'Jabalpur' => 'Jabalpur',
        ];
        break;

      case 'Maharashtra':
        $options = [
          'Pune' => 'Pune',
          'Nagpur' => 'Nagpur',
          'Mumbai' => 'Mumbai',
          'Nashik' => 'Nashik',
        ];
        break;

      case 'Uttar Pradesh':
        $options = [
          'Kanpur' => 'Kanpur',
          'Lucknow' => 'Lucknow',
          'Faizabad' => 'Faizabad',
          'Noida' => 'Noida',
        ];
        break;

      default:
        $options = ['none' => 'none'];
        break;
    }
    return $options;
  }

}