<?php

  namespace Drupal\hello\Controller;

  use Drupal\Core\Controller\ControllerBase;
  use http\Url;
  use Drupal\user\UserInterface;

  class StatisticsController extends ControllerBase {

    public function count_connections(UserInterface $user) {

      $database = \Drupal::database();

      $result_stats = $database->select('hello_user_statistics', 'hus')
                              ->fields('hus', [])
                              ->condition('uid', $user->id())
                              ->execute();
      $rows = [];

      $connexions_number = 0;

      foreach($result_stats as $stat) {

        $rows[] = [

          \Drupal::service('date.formatter')->format($stat->time),
          $stat->action == '1' ? $this->t('Login') : $this->t('Logout')];

        $connexions_number += $stat->action;

      }

      $tab = [
        '#theme' => 'table',
        '#header' => ['Time','Action'],
        '#rows' => $rows,
      ];

      $message = [
        '#theme' => 'hello_user_connexion',
        '#user' => $user,
        '#count' => $connexions_number,
      ];

      return [
        'table' => $tab,
        'hello_user_connexion' => $message,
      ];

    }

  }