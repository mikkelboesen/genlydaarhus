<?php
/**
 * @file
 * Contains Drupal\itk_floating_help\Form\ITKFloatingHelpContentForm.
 */

namespace Drupal\itk_floating_help\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ITKFloatingHelpContentForm
 *
 * @package Drupal\itk_floating_help\Form
 */
class ITKFloatingHelpContentForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'itk_floating_help';
  }

  /**
   * Get key/value storage for base config.
   *
   * @return object
   */
  private function getBaseConfig() {
    return \Drupal::getContainer()->get('itk_floating_help.config');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->getBaseConfig();

    $form['basic_information_wrapper'] = [
      '#title' => t('Basic information'),
      '#type' => 'details',
      '#description' => t('Configure the content of the basic information of the floating help module.'),
      '#weight' => '1',
      '#open' => TRUE,
    ];

    $form['basic_information_wrapper']['floating_help_button_label_closed'] = [
      '#title' => t('Button label (closed)'),
      '#type' => 'textfield',
      '#description' => t('Set the button text for opening the box.'),
      '#default_value' => $config->get('floating_help_button_label_closed'),
      '#required' => true,
      '#weight' => '2',
    ];

    $form['basic_information_wrapper']['floating_help_button_label_open'] = [
      '#title' => t('Button label (open)'),
      '#type' => 'textfield',
      '#description' => t('Set the button text for closing the box.'),
      '#default_value' => $config->get('floating_help_button_label_open'),
      '#required' => true,
      '#weight' => '3',
    ];

    $form['basic_information_wrapper']['floating_help_text'] = [
      '#title' => t('Text'),
      '#type' => 'textfield',
      '#description' => t('A short text that provides information to the user.'),
      '#default_value' => $config->get('floating_help_text'),
      '#required' => true,
      '#weight' => '4',
    ];

    $form['contact_information_wrapper'] = [
      '#title' => t('Contact information'),
      '#type' => 'details',
      '#description' => t('Configure the contact information for the floating help module.'),
      '#weight' => '1',
      '#open' => TRUE,
    ];

    $form['contact_information_wrapper']['floating_help_contact'] = [
      '#title' => t('Contact'),
      '#type' => 'textfield',
      '#default_value' => $config->get('floating_help_contact'),
      '#weight' => '2',
    ];

    $form['contact_information_wrapper']['floating_help_phone'] = [
      '#title' => t('Phone'),
      '#type' => 'textfield',
      '#default_value' => $config->get('floating_help_phone'),
      '#weight' => '3',
    ];

    $form['contact_information_wrapper']['floating_help_email'] = [
      '#title' => t('Email'),
      '#type' => 'textfield',
      '#default_value' => $config->get('floating_help_email'),
      '#weight' => '4',
    ];

    $form['actions'] = array('#type' => 'actions');
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#attributes' => ['class' => ['button--primary']],
      '#value' => t('Save configuration'),
      '#weight' => '6',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message('Settings saved');

    // Set the rest of the configuration values.
    $this->getBaseConfig()->setMultiple(array(
      'floating_help_button_label_closed' => $form_state->getValue('floating_help_button_label_closed'),
      'floating_help_button_label_open' => $form_state->getValue('floating_help_button_label_open'),
      'floating_help_text' => $form_state->getValue('floating_help_text'),
      'floating_help_contact' => $form_state->getValue('floating_help_contact'),
      'floating_help_phone' => $form_state->getValue('floating_help_phone'),
      'floating_help_email' => $form_state->getValue('floating_help_email'),
    ));

    drupal_flush_all_caches();
  }
}
