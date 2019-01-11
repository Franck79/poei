<?php

namespace Drupal\file_from_url\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class FiledownloadController.
 */
class FiledownloadController extends ControllerBase {

  /**
   * Action.
   *
   * @return string
   *   Return Hello string.
   */
  public function action() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: action')
    ];
  }

}
