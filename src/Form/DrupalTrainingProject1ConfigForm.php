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
    $form = parent::buildForm($form, $form_state);

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#title_display' => 'before',
      '#default_value' => $config->get('name'),
    ];

    return $form;
  }

  /**
   * Form Submit.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('drupal_training_project1.settings');
    $config->set('name', $form_state->getValue('name'));
    $config->save();
    parent::submitForm($form, $form_state);
  }

}
