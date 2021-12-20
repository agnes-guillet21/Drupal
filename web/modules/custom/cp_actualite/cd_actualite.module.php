<?php

//
//use Drupal\Core\Form\FormStateInterface;
//use Drupal\node\NodeInterface;
//
//
////hook preprocess
function cp_actualite_preprocess_node(&$variables) {


  /** @var \Drupal\node\NodeInterface $node */



  $node = $variables['node'];

  if ($node->bundle() == 'news' && $variables['view_mode'] == "full") {

            $variables['content']['my_html'] = [
              '#markup' =>  '<p>'.$variables['bouh'].'</p>'
            ];

  }
}





function cp_news_theme($existing, $type, $theme, $path){
  return [
    // Name of the theme hook. This is used in the controller to trigger the hook.
    'cp_news_list' => [
      'render element' => 'children',
      // Optionally define variables that will be passed to the Twig template and set default values for them.
//      'variables' => [
//        'nodes' => [],
//        'count' => null,
//
//      ],
    ],
  ];
}

