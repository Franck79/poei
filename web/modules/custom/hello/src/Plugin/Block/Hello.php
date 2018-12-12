<?php

  namespace Drupal\hello\Plugin\Block;

  use Drupal\Core\Block\BlockBase;


  /**
   * Provides a hello block.
   *
   * @Block(
   *   id = "hello_block",
   *   admin_label = @Translation("Hello!")
   * )
   */
  class Hello extends BlockBase {

    /**
     * Implements Drupal\Core\Block\BlockBase::build().
     */
    public function build() {
      $dateTime = \Drupal::service('datetime.time')->getCurrentTime();

      $dateFormat = \Drupal::service('date.formatter')->format($dateTime, 'custom','H:i s\s' );

      $user = \Drupal::currentUser()->getAccountName();

      $build = ['#markup' => $this->t('Welcome %user. It is %datetime',
                ['%datetime' => $dateFormat, '%user' => $user]),
                '#cache' => [
                  'keys' => ['hello:block'],
                  'contexts' => ['user', 'timezone'],
                    'max-age' => '10',
                ],
               ];

      return $build;
    }

  }