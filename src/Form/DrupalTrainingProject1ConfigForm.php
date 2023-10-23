<?php

namespace Drupal\drupal_training_project1\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * {@inheritDoc}
 */
class DrupalTrainingProject1ConfigForm extends ConfigFormBase {

  /**
   * {@inheritDoc}
   */
  public function getFormId() : string {
    return 'DrupalTrainingProject1_settings';
  }

  /**
   * {@inheritDoc}
   */
  public function getEditableConfigNames() : array {
    return [
      'drupal_training_project1.settings',
    ];
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('drupal_training_project1.settings');

    $form = [
      'country' => [
        '#type' => 'textfield',
        '#title' => $this->t('Country'),
        '#title_display' => 'before',
        '#default_value' => $config->get('country') ?? 'India',
      ],

      'city' => [
        '#type' => 'textfield',
        '#title' => $this->t('City'),
        '#title_display' => 'before',
        '#default_value' => $config->get('city') ?? 'Kolkata',
      ],

      'api_key' => [
        '#type' => 'textfield',
        '#title' => $this->t('API KEy'),
        '#title_display' => 'before',
        '#default_value' => $config->get('api_key'),
        '#placeholder' => 'API Key',
        '#description' => $this->t('You can generate key from ') . '<a href="https://openweathermap.org/api"> Open Weather </a>',
      ],

      'api_endpoint' => [
        '#type' => 'textfield',
        '#title' => $this->t('API Endpoint'),
        '#title_display' => 'before',
        '#default_value' => $config->get('api_endpoint') ?? 'https://api.openweathermap.org/data/2.5/weather',
      ],
    ];
    return parent::buildForm($form, $form_state);

  }

  /**
   * Form Submit.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('drupal_training_project1.settings');
    $variable = $form_state->getValues();
    foreach ($variable as $key => $value) {
      $config->set($key, $value);
    }
    $config->save();
    parent::submitForm($form, $form_state);
  }

}
