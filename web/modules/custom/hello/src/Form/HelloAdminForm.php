<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloAdminForm extends ConfigFormBase {

  public function getFormId() {
    return 'hello_form';
  }

  protected function getEditableConfigNames() {
    return ['hello.settings'];
  }


  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['list'] = [
      '#type' => 'select',
      '#title' => $this->t('Select element'),
      '#options' => [
        '1' => $this->t('Never purge'),
        '2' => $this->t('1 Days'),
        '3' => $this->t('2 Days'),
        '4' => $this->t('7 Days'),
        '5' => $this->t('14 Days'),
        '6' => $this->t('30 Days'),
      ],
    ];

    return parent::buildForm($form, $form_state);

  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

    parent::validateForm($form, $form_state);

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    parent::submitForm($form, $form_state);

    $value = $form_state->getValue('list');

    $this->config('hello.settings')->set('purge_days_number', $value)->save();

  }

}
