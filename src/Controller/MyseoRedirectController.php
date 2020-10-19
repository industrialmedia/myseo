<?php

namespace Drupal\myseo\Controller;

use Drupal\Core\Controller\ControllerBase;


class MyseoRedirectController extends ControllerBase {


  public function redirectPage($route_name) {
    return $this->redirect($route_name, [], [], 301);
  }


}
