<?php

namespace Drupal\glossary_tooltip\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class AddGlossary extends FormBase{
  public function getFormId(){
    return 'glossary_tooltip_add_glossary';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $form = [];

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title (Glossary)'),
      '#description' => $this->t('This is the title of the glossary'),
      '#required' => TRUE,
    ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description (Glossary)'),
      '#description' => $this->t('This is the description of the glossary'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state){
    if(empty($form_state->getValue('title'))){
      $form_state->setErrorByName('title', $this->t('Title is required'));
    }
    if(empty($form_state->getValue('description'))){
      $form_state->setErrorByName('description', $this->t('Description is required'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state){
    \Drupal::messenger()->addMessage("Saved");
    $values = $form_state->cleanValues()->getValues();
    \Drupal::database()->insert('glossary_tooltip')->fields([
      'title' => $values['title'],
      'description' => $values['description'],
    ])->execute();
  }
}
