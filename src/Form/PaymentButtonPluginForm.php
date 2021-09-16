<?php

namespace Drupal\payment_button_drupal_plugin\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;


class PaymentButtonPluginForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'payment_plugin_admin_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['payment_button_drupal_plugin.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('payment_button_drupal_plugin.settings');

    $form['payment_button_drupal_plugin_settings']['library_path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter the path the CKEditor Payment Button plugin is installed at.'),
      '#required' => TRUE,
      '#description' => $this->t('By default this is "modules/payment_button_drupal_plugin/payment".'),
      '#default_value' => $config->get('library_path'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    $this->config('payment_button_drupal_plugin.settings')
      ->set('library_path', $values['library_path'])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
