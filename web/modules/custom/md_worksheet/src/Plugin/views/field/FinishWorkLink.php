<?php

namespace Drupal\md_worksheet\Plugin\views\field;

use Drupal\Core\Link;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Provides Finish work (link) field handler.
 *
 * @link https://www.webomelette.com/creating-custom-views-field-drupal-8
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("md_worksheet_finish_work_link")
 *
 * @DCG
 * The plugin needs to be assigned to a specific table column through
 * hook_views_data() or hook_views_data_alter().
 * For non-existent columns (i.e. computed fields) you need to override
 * self::query() method.
 */
class FinishWorkLink extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    $work_entity = $values->_entity;
    $work_id = $work_entity->id();

    $link_text = $this->t('Finish');

    $link = Link::createFromRoute($link_text, 'entity.work.finish_form', ['work' => $work_id], [
      'attributes' => [
        'class' => [
          'button',
        ],
      ],
    ]);

    return $link->toString();
  }

  /**
   * Query method.
   *
   * This method is required to be empty, otherwise the field
   * (md_worksheet_finish_work_link) would be accessed by view in database
   * select.
   */
  public function query() {
    // Intentionally empty.
  }

}
