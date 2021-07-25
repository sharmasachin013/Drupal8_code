<?php 

namespace Drupal\example_dependency_injection\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Egulias\EmailValidator\EmailValidator;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Messenger\MessengerInterface;


/**
 * Implements an example form.
 */
class with_di_current_user extends FormBase { 
  /**
   * Email validator.
   *
   * @var \Egulias\EmailValidator\EmailValidator
   */
  protected $emailValidator;
  protected $account;
  protected $messenger;


  public function __construct(EmailValidator $email_validator,AccountInterface $account,MessengerInterface $messenger)  {
    $this->emailValidator = $email_validator;
    $this->account = $account;
    $this->messenger = $messenger;
  }
  
  /**
   * Constructs a new ModalForm.
   *
   * @param \Egulias\EmailValidator\EmailValidator $email_validator
   *   The email validator.
   */
 
  /**
   * {@inheritdoc}
   */
   // Load the service required to construct this class.
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('email.validator'),
      $container->get('current_user'),
      $container->get('messenger')
    );
  }
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
  
  /**
   * Email validation.
   */
  protected function validateEmail(array &$form, FormStateInterface $form_state) {
    if (!$this->emailValidator->isValid($form_state->getValue('email'))) {
      return FALSE;
    }
    return TRUE;
  }
 /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');

    if (!empty($email)) {
      if (!$this->validateEmail($form, $form_state)) {
        $form_state->setErrorByName('email', $this->t('%email is an invalid email address.', array('%email' => $email)));
      }
    }
    else {
      $form_state->setErrorByName('email', $this->t("Please enter an email address."));
    }
    $form_state->setValue('email', $email);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Get current user data.
    $uid = $this->account->id();
    if($uid){
        $this->messenger->addMessage(t('Form Submitted By Login User'));
    } else {
        $this->messenger->addMessage(t('Form Submitted By End  User'));
    }
  }
}