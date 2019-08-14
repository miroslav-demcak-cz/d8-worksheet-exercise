<?php

namespace Drupal\md_worksheet;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a work entity type.
 */
interface WorkInterface extends ContentEntityInterface {

  /**
   * Gets the work title.
   *
   * @return string
   *   Title of the work.
   */
  public function getTitle();

  /**
   * Sets the work title.
   *
   * @param string $title
   *   The work title.
   *
   * @return \Drupal\md_worksheet\WorkInterface
   *   The called work entity.
   */
  public function setTitle($title);

  /**
   * Gets the "Date to" value.
   *
   * @return string
   *   Date to.
   */
  public function getDateTo();

  /**
   * Sets the "Date to" field with current date.
   *
   * @return \Drupal\md_worksheet\WorkInterface
   *   WorkInterface.
   */
  public function finish();

}
