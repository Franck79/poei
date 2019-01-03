<?php

  namespace Drupal\config_override;

  use Drupal\Core\Config\ConfigFactoryOverrideInterface;
  use Drupal\Core\Config\StorageInterface;
  use Drupal\Core\Session\AccountProxyInterface;

  class Overrider implements ConfigFactoryOverrideInterface {

    /**
     * @var AccountProxyInterface
     */

    protected $current_user;

    /**
     * Overrider constructor
     * @param AccountProxyInterface $current_user
     */

    public function __construct(AccountProxyInterface $current_user) {

      $this->current_user = $current_user;

    }

    public function loadOverrides($names) {

      if(in_array('system.site', $names)) {

        $names['system.site']['name'] = t('TEST');


        if($this->current_user->isAuthenticated()) {

        $names['system.site']['name'] = t('DEV AUTH');

        }
        else {

          $names['system.site']['name'] = t('DEV ANONYME');

        }

      }

      return $names;

    }

    public function getCacheSuffix() {
      // TODO: Implement getCacheSuffix() method.
    }

    public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
      // TODO: Implement createConfigObject() method.
    }

    public function getCacheableMetadata($name) {
      // TODO: Implement getCacheableMetadata() method.
    }


  }