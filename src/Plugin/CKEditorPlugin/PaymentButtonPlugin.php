<?php

namespace Drupal\payment_button_drupal_plugin\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "Payment Button" plugin.
 *
 * @CKEditorPlugin(
 *   id = "payment",
 *   label = @Translation("Payment Plugin")
 * )
 */
class PaymentButtonPlugin extends CKEditorPluginBase implements ContainerFactoryPluginInterface {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $config_factory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $config_factory;

  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      'PaymentButton' => [
        'label' => $this->t('PaymentButton'),
        'image' => $this->getYoutubeLibraryPath() . '/images/icon.png',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return $this->getYoutubeLibraryPath() . '/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

  /**
   * Return the plugin path.
   *
   * @return string
   *   The path to the plugin.
   */
  private function getYoutubeLibraryPath() {
    $config = $this->configFactory->get('payment_button_drupal_plugin.settings');
    return $config->get('library_path');
  }

}
