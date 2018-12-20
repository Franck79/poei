<?php

  namespace Drupal\hello\Access;

  use Drupal\Core\Access\AccessCheckInterface;
  use Drupal\Core\Session\AccountInterface;
  use Symfony\Component\Routing\Route;
  use Symfony\Component\HttpFoundation\Request;
  use Drupal\Core\Access\AccessResult;

  class HelloAccessCheck implements AccessCheckInterface {

    public function applies(Route $route) {
      // TODO: Implement applies() method.
      return NULL;
    }

    public function access(Route $route, Request $request = NULL, AccountInterface $account) {

      $time_access = $route->getRequirement('_access_hello');
      $user_time = $account->getAccount()->created;
      $anonymous_user = $account->isAnonymous();

      if($anonymous_user == TRUE) {

        return AccessResult::forbidden()->cachePerUser();

      } if(!$anonymous_user && REQUEST_TIME - ($time_access * 3600) > $user_time) {

        return AccessResult::allowed()->cachePerUser();

      }

    }

  }