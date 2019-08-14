<?php

/**
 * @file
 * Alters views.
 */

/**
 * {@inheritdoc}
 */
function md_worksheet_views_data_alter(array &$data) {
  $data['work']['md_worksheet_finish_work_link'] = [
    'title' => t('Finish work (link)'),
    'field' => [
      'title' => t('Link to finish Work'),
      'help' => t('Provide an finish link which sets work as finished with current date.'),
      'id' => 'md_worksheet_finish_work_link',
    ],
  ];
}
