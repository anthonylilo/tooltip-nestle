<?php

namespace Drupal\glossary_tooltip\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class GlossaryTooltipAPI extends FormBase{

  const GLOSSARY_API_CONFIG_PAGE = 'glossary_api_config_page:values';

  public function getFormId(){
    return 'glossary_api_config_page';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $values = \Drupal::state()->get(self::GLOSSARY_API_CONFIG_PAGE);
    $form = [];

    $form['api_base_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Base URL'),
      '#description' => $this->t('This is the API Base URL'),
      '#required' => TRUE,
      '#default_value' => $values['api_base_url'],
    ];

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key (v3 auth'),
      '#description' => $this->t('This is the API Key'),
      '#required' => TRUE,
      '#default_value' => $values['api_key'],
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state){
    $submitted_values = $form_state->cleanValues()->getValues();

    \Drupal::state()->set(self::GLOSSARY_API_CONFIG_PAGE, $submitted_values);

    $messenger = \Drupal::service('messenger');
    $messenger->addMessage($this->t('Saved'));
  }
}
