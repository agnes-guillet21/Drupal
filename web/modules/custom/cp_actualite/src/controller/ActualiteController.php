<?php
namespace Drupal\cp_actualite\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class ActualiteController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {

    dpm("bouh");
    $build = [
      '#markup' => $this->t('Hello World!'),
    ];
    return $build;


  }
}
