<?php

  namespace Drupal\hello\Plugin\Block;

  use Drupal\Core\Access\AccessResult;
  use Drupal\Core\Block\BlockBase;
  use Drupal\Core\Session\AccountInterface;

  /**
   * Provides a session block.
   *
   * @Block(
   *   id = "session_block",
   *   admin_label = @Translation("Sessions actives")
   * )
   */
  class Session extends BlockBase {

    /**
     * Implements Drupal\Core\Block\BlockBase::build().
     */
    public function build() {

      $database = \Drupal::database();

      $session_num = $database->select('sessions', 's')
        ->countQuery()
        ->execute()
        ->fetchField();

      $build = [
          '#markup' => $this->t('Il y a actuellement %nbsession sessions actives',
          ['%nbsession' => $session_num]),
          '#cache' => [
          'keys' => ['session:block'],
          'max-age' => '0',
        ],
      ];

      return $build;

    }

    /**
     * @param \Drupal\Core\Session\AccountInterface $account
     *
     * @return \Drupal\Core\Access\AccessResult
     */
    public function blockAccess(AccountInterface $account) {

      return AccessResult::allowedIfHasPermission($account, 'Hello');

    }

  }