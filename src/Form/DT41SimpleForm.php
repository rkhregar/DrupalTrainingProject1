<?php

namespace Drupal\drupal_training_project1\Form;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * {@inheritDoc}
 */
class DT41SimpleForm extends FormBase {

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'dt41_simple_form';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $countryManager = \Drupal::service('country_manager');
    $list = $countryManager->getList();
    $country_array = [];
    foreach ($list as $value) {
      $val = $value->__toString();
      $country_array[$val] = $val;
    }

    $form = [
      'country' => [
        '#type' => 'select',
        '#title' => $this->t('Country'),
        '#title_display' => 'before',
        '#required' => TRUE,
        '#options' => $country_array,
      ],

    ];
    $form['location_fieldset'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Location'),
      '#prefix' => '<div id="location_feildset_wrapper">',
      '#suffix' => '</div>',
    ];
    $form['#tree'] = TRUE;

    if (empty($form_state->get('num_location_fieldset'))) {
      $form_state->set('num_location_fieldset', 1);
    }
    for ($i = 0; $i < $form_state->get('num_location_fieldset'); $i++) {
      $form['location_fieldset'][$i]['state'] = [
        '#type' => 'textfield',
        '#title' => $this->t('state'),
        '#title_display' => 'before',
        '#pattern' => '[A-Za-z]*',
      ];
      $form['location_fieldset'][$i]['city'] = [
        '#type' => 'textfield',
        '#title' => $this->t('city'),
        '#title_display' => 'before',
        '#pattern' => '[A-Za-z]*',
      ];
    }
    $form['add_more'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add More'),
      '#submit' => ['::dt41AddMoreLocation'],
      '#ajax' => [
        'callback' => '::dt41AddMoreLocationCallback',
        'wrapper' => 'location_feildset_wrapper',
      ],
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#title' => $this->t('Submit'),
      '#title_display' => 'before',
      '#required' => TRUE,
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $html = '';
    $html .= 'Your selected country is - <b>' . $form_state->getValue('country') . '</b> <br> Below are the locations you have entered <br> <ul>';
    foreach ($form_state->getValue('location_fieldset') as $value) {
      $html .= '<li>' . $value['state'] . ', ' . $value['city'] . '</li>';
    }
    $html .= '</ul>';
    $this->messenger()->addMessage(new FormattableMarkup($html, []));
  }

  /**
   * {@inheritDoc}
   */
  public function dt41AddMoreLocation($form, $form_state) {
    $form_state->set('num_location_fieldset', $form_state->get('num_location_fieldset') + 1);
    $form_state->setRebuild();
  }

  /**
   * {@inheritDoc}
   */
  public function dt41AddMoreLocationCallback($form, $form_state) {
    return $form['location_fieldset'];
  }

}
