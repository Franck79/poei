<?php

  namespace Drupal\hello\Controller;

  use Drupal\Core\Controller\ControllerBase;
  use Symfony\Component\HttpFoundation\JsonResponse;

  class HelloController extends ControllerBase {

    public function content($param) {

      $message = $this->t('You are on Hello page. 
                  Your username is %name and this is a URL parameter : %urlparam',
                  ['%name' => $this->currentUser()->getAccountName(), '%urlparam' => $param]);

      return ['#markup' => $message];

    }

    public function json() {

      $response = new JsonResponse();
      $response->setData(['1' => 'test', '2' => 'toto']);
      return $response;
    }

  }