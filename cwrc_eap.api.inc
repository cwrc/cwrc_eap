<?php

/**
 * @file
 * Documentation for the cwrc_eap API.
 */

/**
 * JSON output callback to build an EAP page for a given URI.
 *
 * @param string $pid
 *    Fedora PID to base EAP upon.
 * @param bool $return
 *    If set to TRUE will return the results, rather than rendering them.
 *
 * @return string
 *   The JSON to build an EAP page.
 */
function cwrc_eap_xmldb_json($pid, $components = array(), $return = FALSE) {
  // If no components were passed specify them all.
  if (empty($components)) {
    $components = array(
      'entries_about',
      'entries_other',
      'entries_mentioning',
      'bibliographic_about',
      'bibliographic_related',
      'multimedia',
      'coMentionPerson',
      'coMentionOrganization',
      'coMentionPlace',
    );
  }

  // This line is for local debugging of the EAPs, will use the test data from
  // the data folder.
  $debug = variable_get('cwrc_eap_debug', FALSE);
  if ($debug) {
    $json_results = file_get_contents(drupal_get_path('module', 'cwrc_eap') . '/data/test.json');
  }
  else {
    $json_results = "";
  }

  // Load endpoints and query the xml database.
  module_load_include('inc', 'islandora_cwrc_basexdb', 'includes/xmldb_endpoints');
  if (isset($pid) && empty($json_results)) {
    $keyValue = array(
      "FEDORA_PID" => "$pid",
      "COMPONENT_TYPE" => "('" . implode("','", $components) . "')",
    );
    $json_results = islandora_cwrc_exec_xquery(ISLANDORA_EAP_XQ, $keyValue);
  }

  // Return the results as array.
  if ($return) {
    return json_decode($json_results, TRUE);
  }

  // Render the results for api usage.
  drupal_add_http_header('Content-Type', 'application/json; charset=utf-8');
  echo $json_results;
}
