<?php

namespace Drupal\md_worksheet\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\md_worksheet\WorkInterface;

/**
 * Defines the work entity class.
 *
 * @ContentEntityType(
 *   id = "work",
 *   label = @Translation("Work"),
 *   label_collection = @Translation("Works"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\md_worksheet\WorkListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\md_worksheet\WorkAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\md_worksheet\Form\WorkForm",
 *       "edit" = "Drupal\md_worksheet\Form\WorkForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "finish" = "Drupal\md_worksheet\Form\WorkFinishForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\md_worksheet\Entity\Routing\WorkAdminHtmlRouteProvider"
 *     }
 *   },
 *   base_table = "work",
 *   admin_permission = "administer work",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/work/add",
 *     "canonical" = "/work/{work}",
 *     "edit-form" = "/admin/content/work/{work}/edit",
 *     "delete-form" = "/admin/content/work/{work}/delete",
 *     "collection" = "/admin/content/work",
 *     "finish-form" = "/admin/content/work/{work}/finish"
 *   },
 *   field_ui_base_route = "entity.work.settings"
 * )
 */
class Work extends ContentEntityBase implements WorkInterface {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($title) {
    $this->set('title', $title);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getDateTo() {
    return $this->get('field_date_to')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function finish() {
    $this->set('field_date_to', gmdate('Y-m-d'));
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the work entity.'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDescription(t('A description of the work.'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
