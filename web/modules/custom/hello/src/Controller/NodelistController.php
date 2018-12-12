<?php

  namespace Drupal\hello\Controller;

  use Drupal\Core\Controller\ControllerBase;
  use http\Url;

  class NodelistController extends ControllerBase {

    public function nodetype($param = NULL) {

      /*$node_types = $this->entityTypeManager()->getStorage('node_type')->loadMultipler();

      $items_list = [];

      foreach($node_types as $node_type) {

        $url = new Url('hello.hello.node_list', ['nodetype' => $node_type->id()];

        $item_list[] = new Link($node_type);

      }*/


      $storage = $this->entityTypeManager()->getStorage('node');

      $query = $this->entityTypeManager()->getStorage('node')->getQuery();

      if($param) {

        $query->condition('type', $param);

      }

      $ids = $query
            ->pager(10)
            ->execute();

      $nodes = $storage->loadMultiple($ids);

      //ksm($entities);

      $items = [];

      foreach ($nodes as $node) {

        $items[] = $node->toLink();

      }

      $pager = ['#type' => 'pager'];

      $list = [
        '#theme' => 'item_list',
        '#items' => $items,
        '#title' => $this->t('Node list')
      ];

      return [
        'list' => $list,
        'pager' => $pager,
        '#cache' => [
          'keys' => ['hello:node_list'],
          'tag' => ['node_list', 'node_type_list'],
          'contexts' => ['url'],
          ],
      ];
    }
  }