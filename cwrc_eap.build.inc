<?php

/**
 * Helper function to perform additional preprocessing for person entities.
 *
 * @param  array &$build      The finished build array, should be modified
 *                             directly by this function.
 * @param  array $connections The connection information from the XML db.
 */
function _cwrc_eap_build_person(&$build, $connections) {
  $object = $build['#object'];
  $project = $build['#project'];

  // Get xquery for the "PERSON" datastream.
  $xml = new SimpleXMLElement($object['PERSON']->content);

  // Get info arrays.
  $recordInfo = $xml->person->recordInfo;
  $identity = $xml->person->identity;
  $description = $xml->person->description;

  // Access conditions.
  $build['#info_record']['accessConditions'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Access Conditions'),
    '#elements' => (string) $recordInfo->accessCondition['type'],
  );

  // Origin info (contributing projects).
  $build['#info_record']['originInfo'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Contributing Project(s)'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($recordInfo->originInfo->projectId as $project) {
    $build['#info_record']['originInfo']['#elements']['#items'][] = (string) $project;
  }

  // Person types.
  $build['#info_record']['personTypes'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Person Type(s)'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($recordInfo->personTypes->personType as $personType) {
    $build['#info_record']['personTypes']['#elements']['#items'][] = _cwrc_eap_map_person_type($personType);
  }

  // Preferred names.
  $build['#info_identity']['preferredForm'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Preferred Name(s)'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($identity->preferredForm->namePart as $namePart) {
    $build['#info_identity']['preferredForm']['#elements']['#items'][] = $namePart . ' (<em>' . _cwrc_eap_map_name_type($namePart['partType']) . '</em>)';
  }

  // Variant names.
  $build['#info_identity']['variantForms'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Variant Name(s)'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($identity->variantForms->variant as $variantForm) {
    $name = '<strong>' . t('Variant Type') . '</strong>: ' . $variantForm->variantType . '<br />';
    $name .= $variantForm->namePart . ' (<em>' . _cwrc_eap_map_name_type($variantForm->namePart['partType']) . '</em>)';
    $build['#info_identity']['variantForms']['#elements']['#items'][] = $name;
  }

  // Same as.
  $build['#info_identity']['sameAs'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Same As'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($identity->sameAs as $sameAs) {
    if (valid_url($sameAs, true)) {
      $content = l($sameAs, $sameAs);
    } else {
      $content = (string) $sameAs;
    }

    $content .= ' (<em>' . _cwrc_eap_map_certainty($sameAs['cert']) . '</em>)';
    $build['#info_identity']['sameAs']['#elements']['#items'][] = $content;
  }

  // Date(s) of existence.
  $build['#info_description']['existDates'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Date(s) of Existence'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($description->existDates->dateSingle as $dateSingle) {
    $content = '<strong>' . _cwrc_eap_map_date_type($dateSingle->dateType) . '</strong>: ';
    $content .= $dateSingle->standardDate;
    $content .= ' (<em>' . _cwrc_eap_map_certainty($dateSingle['cert']) . '</em>)';
    if (!empty($dateSingle->note)) {
      $content .= '<p><strong>Note:</strong> ' . $dateSingle->note . '</p>';
    }
    $build['#info_description']['existDates']['#elements']['#items'][] = $content;
  }

  // Factuality.
  $build['#info_description']['factuality'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Factuality'),
    '#elements' => array(
      '#markup' => _cwrc_eap_map_factuality($description->factuality),
    ),
  );

  // Gender(s).
  $build['#info_description']['genders'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Gender(s)'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($description->genders->gender as $gender) {
    $content = (string) $gender;
    $content .= ' (<em>' . _cwrc_eap_map_certainty($gender->attributes()['cert']) . '</em>)';
    $build['#info_description']['genders']['#elements']['#items'][] = $content;
  }

  // Occupation(s).
  $build['#info_description']['occupations'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Occupation(s)'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($description->occupations->occupation as $occupation) {
    $content = (string) $occupation->term;
    $content .= ' (<em>' . _cwrc_eap_map_certainty($occupation->term['cert']) . '</em>)';
    if (!empty($occupation->note)) {
      $content .= '<p><strong>Note:</strong> ' . $occupation->note . '</p>';
    }
    $build['#info_description']['occupations']['#elements']['#items'][] = $content;
  }

  // Activities.
  $build['#info_description']['activities'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Activities'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($description->activities->activity as $activity) {
    $content = (string) $activity->term;
    $content .= ' (<em>' . _cwrc_eap_map_certainty($activity->term['cert']) . '</em>)';
    $build['#info_description']['activities']['#elements']['#items'][] = $content;
  }

  // Research Interests.
  $build['#info_description']['researchInterests'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Research Interests'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($description->researchInterests->interest as $interest) {
    $content = (string) $interest->term;
    $content .= ' (<em>' . _cwrc_eap_map_certainty($interest->term['cert']) . '</em>)';
    $build['#info_description']['researchInterests']['#elements']['#items'][] = $content;
  }

  // Descriptive Notes.
  $build['#info_description']['descriptiveNotes'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Descriptive Notes'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($description->descriptiveNotes->note as $note) {
    $build['#info_description']['descriptiveNotes']['#elements']['#items'][] = (string) $note;
  }

  // Related Resources.
  $build['#info_description']['relatedResources'] = array(
    '#theme' => 'cwrc_eap_info',
    '#label' => t('Related Resources'),
    '#elements' => array(
      '#theme' => 'item_list',
      '#type' => 'ul',
      '#items' => array(),
      '#title' => null,
      '#attributes' => array(),
    ),
  );
  foreach ($description->relatedResources->resource as $resource) {
    $build['#info_description']['relatedResources']['#elements']['#items'][] = (string) $resource;
  }
}

/**
 * Helper function to perform additional preprocessing for organization
 * entities.
 *
 * @param  array &$build      The finished build array, should be modified
 *                            directly by this function.
 * @param  array $connections The connection information from the XML db.
 */
function _cwrc_eap_build_organization(&$build, $connections) {
  $object = $build['#object'];
  $project = $build['#project'];
}

/**
 * Helper function to perform additional preprocessing for place entities.
 *
 * @param  array &$build      The finished build array, should be modified
 *                            directly by this function.
 * @param  array $connections The connection information from the XML db.
 */
function _cwrc_eap_build_place(&$build, $connections) {
  $object = $build['#object'];
  $project = $build['#project'];
}

/**
 * Helper function that statically maps keys to values for certainty selects.
 */
function _cwrc_eap_map_certainty($key) {
  static $map = array(
    '1' => 'Speculative',
    '2' => 'Probable',
    '3' => 'Reasonably Certain',
    '4' => 'Definite',
  );

  return isset($map[(string)$key]) ? t($map[(string)$key]) : $key;
}

/**
 * Helper function that statically maps keys to values for person type selects.
 */
function _cwrc_eap_map_person_type($key) {
  static $map = array(
    'creator' => 'Creator',
    'writer' => 'Writer',
    'critic' => 'Critic',
    'canwwr:creator' => 'Creator (CanWWr)',
    'canwwr:critic' => 'Critic (CanWWr)',
    'orl:BWW' => 'British Woman Writer (Orlando)',
    'orl:IBW' => 'International-British Women Writer (Orlando)',
    'orl:IWW' => 'International Women Writer (Orlando)',
    'orl:MW' => 'Male Writer (Orlando)',
  );

  return isset($map[(string)$key]) ? t($map[(string)$key]) : $key;
}

/**
 * Helper function that statically maps keys to values for name type selects.
 */
function _cwrc_eap_map_name_type($key) {
  static $map = array(
    'family' => 'Family Name',
    'fullName' => 'Full name (inverse order)',
    'given' => 'Given Names',
    'termsOfAddress' => 'Terms of Address',
  );

  return isset($map[(string)$key]) ? t($map[(string)$key]) : $key;
}

/**
 * Helper function that statically maps keys to values for date type selects.
 */
function _cwrc_eap_map_date_type($key) {
  static $map = array(
    'birth' => 'Birth',
    'death' => 'Death',
    'flourish' => 'Flourish',
  );

  return isset($map[(string)$key]) ? t($map[(string)$key]) : $key;
}

/**
 * Helper function that statically maps keys to values for factuality selects.
 */
function _cwrc_eap_map_factuality($key) {
  static $map = array(
    'real' => 'Real',
    'fictional' => 'Fictional',
    'both' => 'Both',
  );

  return isset($map[(string)$key]) ? t($map[(string)$key]) : $key;
}
