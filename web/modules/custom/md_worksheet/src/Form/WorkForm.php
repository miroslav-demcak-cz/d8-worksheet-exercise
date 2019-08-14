<?php

namespace Drupal\md_worksheet\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the work entity edit forms.
 */
class WorkForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New work %label has been created.', $message_arguments));
      $this->logger('md_worksheet')->notice('Created new work %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The work %label has been updated.', $message_arguments));
      $this->logger('md_worksheet')->notice('Updated new work %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.work.canonical', ['work' => $entity->id()]);
  }

}
