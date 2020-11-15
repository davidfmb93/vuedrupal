<?php
 /**
 * @file
 * @author David Martinez
 * Contains \Drupal\vuedrupal\Controller\VueController.
 * Please place this file under your example(module_root_folder)/src/Controller/
 * Use https://www.drupal.org/docs/8/api/database-api/dynamic-queries/introduction-to-dynamic-queries  para consultes y actualización de data
 */

namespace Drupal\vuedrupal\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\ab_core\Form\ConfigForm;
use Drupal\vuedrupal\Services;
use Drupal\node\Entity\Node;


/**
 * Provides route responses for the Example module.
 */
class VueController extends ControllerBase{

    public function index() {
        // return  new JsonResponse('vueJS');
        return array(
            '#theme' => 'vue',
            '#data' => [],
            '#attached' => [
                'library' => [
                    'vuedrupal/vue_sources',
                ],
            ],
          );
    }

}