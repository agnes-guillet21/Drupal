<?php
namespace Drupal\cp_blog_post\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class BlogController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {


    //    $query = $nodeStorage->getQuery();
    //    //condition => sur le bundle
    //    $query->condition('type', 'blog_post')
    //      ->condition('statuts', TRUE);
    //      $nIds = $query->execute();
    //
    //      if(! empty($nIds)){
    //    //    $nodes = $nodeStorage->loadMultiple($nIds);
    ////        dpm($nodes);
    //      }


    /** @var \Drupal\node\NodeStorage $nodeStorage */
    // Recuperation des billets blog connexe
    $nodes = [];

    $entityTypeManager = Drupal::entityTypeManager();
    $limit = 12;
    $build = [
      '#markup' => '<p>' . $this->t("Pas de resultat") . '<p>'
    ];

    $nodeStorage = Drupal::entityTypeManager()
      ->getStorage('node');//recuperation du storage de node
    $query = $nodeStorage->getQuery(); // fait le query
    $query
      ->condition('type', 'blog_post')
      ->condition('status', TRUE);
    //->sort('changer', DESC); //celui qui a ete changer apparait en 1
    //rajouter pager
    $query->pager($limit);


    $nids = $query->execute();

    $countQuery = clone($query);
    $count = $countQuery->count()->execute();

    //    if(!empty($nids)){
    //            $nodes = $nodeStorage->loadMultiple($nids);
    //      $output = \Drupal::entityTypeManager()->getViewBuilder('node')->viewMultiple($nodes, 'teaser');
    //          }else{
    //      $output = $this->t(" no thing ");
    //
    //    }
    //
    //    return [
    //      // Your theme hook name.
    //      '#theme' => 'cp_blog_post_blog_list', // theme du hook theme
    //      // ds l ordre j ai besoin d un template -> commence par faire le hook theme , ensuite on creer un template et ensuite faire le lien ds le controller
    //      // diff templates et theme _/ -
    //      // Your variables.
    //
    //      '#nodes' => $output,
    //        '#count' => $count
    //    ];

    if (!empty($nids)) {
      $nodeObjects = $nodeStorage->loadMultiple($nids);
      $nodeViewBuilder = $entityTypeManager->getViewBuilder('node');
      $view_mode = 'teaser';
      //$nodes = $nodeViewBuilder->viewMultiple($nodeObjects, $view_mode);
      $nodes = [];
      foreach ($nodeObjects as $node) {
        $nodes[] = $nodeViewBuilder->view($node, $view_mode);
      }

            $build = [
              'wrapper' => [
                '#type' => 'container',
                '#attributes' => [
                  'class' => [
                    'BlogList-wrapper'
                  ],
                ],
                'nodes' => [
                  '#theme' => 'cp_blog_post_blog_list',
                  '#nodes' => $nodes,
                ],
                'pager' => [
                  '#type' => 'pager',
                ]
              ],
            ];
          }
          return $build;

//      $build = [
//        'wrapper' => [
//          '#type' => 'container',
//          '#attributes' => [
//            'class' => [
//              'BlogList-wrapper'
//            ],
//          ],
//          'nodes' => [
//            //            '#theme' => 'cp_blog_post_blog_list',
//            //            '#nodes' => $nodes,
//            '#theme' => 'item_list',
//            '#list_type' => 'ul',
//            '#title' => '',
//            '#items' => $nodes,
//            '#attributes' => ['class' => 'BlogList'],
//            //ajouter l attributes
//          ],
//          'pager' => [
//            '#type' => 'pager',
//          ]
//        ],
//      ];
//    }
//    return $build;
  }

}
