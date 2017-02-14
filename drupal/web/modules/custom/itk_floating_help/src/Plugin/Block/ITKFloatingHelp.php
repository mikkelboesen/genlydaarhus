<?php

namespace Drupal\itk_floating_help\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides floating help
 *
 * @Block(
 *   id = "itk_floating_help",
 *   admin_label = @Translation("ITK Floating help"),
 * )
 */
class ITKFloatingHelp extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::getContainer()->get('itk_floating_help.config')->getAll();

    $floating_help_title = $config['floating_help_title'];
    $floating_help_text = $config['floating_help_text'];
    $floating_help_contact = $config['floating_help_contact'];
    $floating_help_phone = $config['floating_help_phone'];
    $floating_help_email = $config['floating_help_email'];

    return array (
      '#floating_help_title' => $floating_help_title,
      '#floating_help_text' => $floating_help_text,
      '#floating_help_contact' => $floating_help_contact,
      '#floating_help_phone' => $floating_help_phone,
      '#floating_help_email' => $floating_help_email,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    return $form;
  }
}