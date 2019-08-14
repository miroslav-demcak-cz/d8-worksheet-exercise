<?php

namespace Drupal\md_worksheet\Entity\Routing;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\AdminHtmlRouteProvider;
use Symfony\Component\Routing\Route;

/**
 * Contains additional routes for Work entity.
 */
class WorkAdminHtmlRouteProvider extends AdminHtmlRouteProvider {

  /**
   * {@inheritdoc}
   */
  public function getRoutes(EntityTypeInterface $entity_type) {
    $collection = parent::getRoutes($entity_type);
    $entity_type_id = $entity_type->id();

    if ($finish_route = $this->getFinishFormRoute($entity_type)) {
      $collection->add("entity.{$entity_type_id}.finish_form", $finish_route);
    }

    return $collection;
  }

  /**
   * Gets finish form route.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   Entity type.
   *
   * @return \Symfony\Component\Routing\Route|null
   *   Route.
   */
  protected function getFinishFormRoute(EntityTypeInterface $entity_type) {
    if ($entity_type->hasLinkTemplate('finish-form')) {
      $entity_type_id = $entity_type->id();
      $route = new Route($entity_type->getLinkTemplate('finish-form'));
      $route
        ->setDefaults([
          '_entity_form' => "{$entity_type_id}.finish",
          '_title_callback' => '\Drupal\md_worksheet\Entity\Controller\WorkEntityController::finishTitle',
        ])
        ->setRequirement('_entity_access', "{$entity_type_id}.update")
        ->setOption('parameters', [
          $entity_type_id => ['type' => 'entity:' . $entity_type_id],
        ]);

      // Entity types with serial IDs can specify this in their route
      // requirements, improving the matching process.
      if ($this->getEntityTypeIdKeyType($entity_type) === 'integer') {
        $route->setRequirement($entity_type_id, '\d+');
      }
      $route->setOption('_admin_route', TRUE);

      return $route;
    }
    return NULL;
  }

}
