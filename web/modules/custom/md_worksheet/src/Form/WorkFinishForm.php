<?php

namespace Drupal\md_worksheet\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Form controller for the work entity edit forms.
 */
class WorkFinishForm extends ContentEntityForm {

  /**
   * Saves work as finished.
   *
   * @param array $form
   *   Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var \Drupal\md_worksheet\Entity\Work $entity */
    $entity = $this->getEntity();
    $work_id = $entity->id();

    $args = ['@work' => $work_id];
    $message = empty($entity->getDateTo()) ?
      $this->t('The work (ID @work) was set as finished with current date.', $args) :
      $this->t("The finished work's (ID @work) date was overwritten with current date.", $args);

    $entity->finish();

    try {
      $entity->save();
    }
    catch (Exception $exception) {
      $message = $this->t('Unable to set the work (ID @work) as finished.', $args);
      $this->messenger()->addError($message);
      $args['@error'] = $exception->getMessage();
      $this->logger('md_worksheet')->error($message .
        ' ' . $this->t("Error: @error", $args));
    }

    $this->messenger()->addStatus($message);
    $this->logger('md_worksheet')->notice($message);

    $response = new RedirectResponse('/');
    $response->send();
    exit;
  }

}
