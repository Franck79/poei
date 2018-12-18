<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;


/**
 * Class HelloForm.
 */
class HelloForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hello_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    if(isset($form_state->getRebuildInfo()['result'])) {

      $form['resultat'] = [
        '#type' => 'html_tag',
        '#tag' => 'h2',
        '#value' => $this->t('Résultat :' .$form_state->getRebuildInfo()['result']),
      ];

    }

    $form['firstvalue'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('First value'),
      '#description' => $this->t('Enter first value'),
      '#required' => 'TRUE',
      '#ajax' => array (
        'callback' => array($this, 'validateFirstValue'),
        'event' => 'change'),
      '#suffix' => '<span id ="firstvalue-response"></span>',
    );

    $form['operation'] = array(
      '#type' => 'radios',
      '#title' => $this->t('Operation'),
      '#description' => $this->t('Choose operator for processing'),
      '#default_value' => 'Ajouter',
      '#options' => array(
        'Ajouter' => $this->t('+'),
        'Soustract' => $this->t('-'),
        'Multiply' => $this->t('*'),
        'Divide' => $this->t('/'),
      ),

    );

    $form['secondvalue'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Second value'),
      '#description' => $this->t('Enter second value'),
      '#required' => 'TRUE',
      '#ajax' => array (
        'callback' => array($this, 'validateFirstValue'),
        'event' => 'change'),
      '#suffix' => '<span id ="secondvalue-response"></span>',
    );

    $form['calculate'] = [
      '#type' => 'submit',
      '#value' => $this->t('Calculate'),
    ];

    return $form;
  }

  public function validateFirstValue(array &$form, FormStateInterface $form_state) {


    //$message = 'Ajax message: ' .$form_state->getValue('firstvalue');

    $field = $form_state->getTriggeringElement()['#name'];

    $response = new AjaxResponse();

    if(!is_numeric($form_state->getValue($field))) {

      $css = ['border' => '2px solid red'];
      $message = $this->t('%field must be numeric', ['%field' => $form[$field]['#title']]);

    } else {

      $css = ['border' => '2px solid green'];
      $message = $this->t('Ok');

    }

    $response->addCommand(new CssCommand('#edit-' . $field, $css));
    $response->addCommand(new HtmlCommand('#' . $field . '-response' ,$message ));

    return $response;

  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $first_value = $form_state->getValue('firstvalue');
    $second_value = $form_state->getValue('secondvalue');
    $operation = $form_state->getValue('operation');

    if (!is_numeric($first_value)) {

      $form_state->setErrorByName('firstvalue', $this->t('First value must be numeric'));

    } if (!is_numeric($second_value)) {

      $form_state->setErrorByName('secondvalue', $this->t('Second value must be numeric'));

    } if ($operation == 'Divide' && $second_value == 0) {

      $form_state->setErrorByName('secondvalue', $this->t('Second value can\'t be null'));

    } if (isset($form['resultat'])) {

      unset($form['resultat']);

    }

    parent::validateForm($form, $form_state);

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $first_value = $form_state->getValue('firstvalue');
    $second_value = $form_state->getValue('secondvalue');
    $operation = $form_state->getValue('operation');

    switch($operation) {

      case 'Ajouter':

        $result = $first_value + $second_value;
        $operator = ' + ';

        break;

      case 'Soustract':

        $result = $first_value - $second_value;
        $operator = ' - ';

        break;

      case 'Multiply':

        $result = $first_value * $second_value;
        $operator = ' * ';

        break;

      case 'Divide':

        $result = $first_value / $second_value;
        $operator = ' / ';

        break;

    }

    $state = \Drupal::state()->set('hello_state',REQUEST_TIME);

    drupal_set_message('Resultat: ' . $first_value . $operator . $second_value . ' = ' . $result);

    $form_state->setRebuild();

    $form_state->addRebuildInfo('result', $result);

  }

}