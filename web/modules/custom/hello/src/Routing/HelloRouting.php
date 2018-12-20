<?php

namespace Drupal\hello\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\Routing\RouteCollection;

class HelloRouting extends RouteSubscriberBase {

  public function alterRoutes(RouteCollection $collection) {
    // TODO: Implement alterRoutes() method.

    $collection->get('entity.user.canonical')->setRequirements(['_access_hello' => '10']);

  }

}