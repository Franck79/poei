<?php

namespace Drupal\annonce\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Annonce entities.
 */
class AnnonceViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['annonce_history']['table']['group'] = t('Annonce history');
    $data['annonce_history']['table']['provider'] = 'annonce';
    $data['annonce_history']['table']['base'] = [
      'field' => 'id',
      // Nom des données que l'on liste.
      'title' => t('Annonce history'),
      'help' => t('Annonce history contains historical data'),
      'weight' => -100,
    ];
    $data['annonce_history']['uid'] = [
      'title' => t('User id annonce'),
      'help' => t('User id annonce.'),
      'field' => ['id' => 'numeric'],
      'relationship' => [
        'base' => 'users_field_data',
        'base field' => 'uid',
        'id' => 'standard',
        'label' => t('Relate annonce history UID -> User ID'),
      ],
    ];
    $data['annonce_history']['time'] = [
      'title' => t('Date Annonce history'),
      'help' => t('Date view annonce.'),
      'field' => ['id' => 'date'],
    ];
    $data['annonce_history']['annonce_id'] = [
      'title' => t('Annonce ID'),
      'help' => t('Relate annonce_id annonce history -> Annonce ID.'),
      'field' => ['id' => 'numeric'],
      'relationship' => [
        'base' => 'annonce_field_data',
        'base field' => 'id',
        'id' => 'standard',
        'label' => t('Relate annonce history annonce_id -> Annonce ID'),
      ],
    ];

    return $data;

  }

}
