<?php

namespace Drupal\console_tests\Plugin\ImageEffect;

use Drupal\Core\Image\ImageInterface;
use Drupal\image\ImageEffectBase;

/**
 * Provides a 'ConsoleTestImageEffet' image effect.
 *
 * @ImageEffect(
 *  id = "console_test_image_effet",
 *  label = @Translation("Console test image effet"),
 *  description = @Translation("Console test blur.")
 * )
 */
class ConsoleTestImageEffet extends ImageEffectBase {

  /**
   * {@inheritdoc}
   */
  public function applyEffect(ImageInterface $image) {
    // Implement Image Effect.
    return imagefilter($image->getToolkit()->getResource(), IMG_FILTER_NEGATE, NULL);
  }

}
