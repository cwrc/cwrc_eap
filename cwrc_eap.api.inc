<?php

// Calls to XML database to create structured data array to go here.


/**
 * JSON output callback to build and EAP page for a given URI.
 *
 * @param string $uri
 *    CWRC entity URI to base EAP upon
 */
function cwrc_module_cwrc_eap_xmldb_json($uri) {
  return file_get_contents(drupal_get_path('module', 'cwrc_eap') . '/data/test.json');
  // temporary test
  $uri = 'http://www.geonames.org/6251999';
  module_load_include('inc', 'islandora_cwrc_basexdb', 'includes/xmldb_endpoints');
  drupal_add_http_header('Content-Type', 'application/json; charset=utf-8');
  $json_results = "";
  if ($uri) {
    $keyValue = array("ENTITY_URI" => "$uri");
    $json_results = islandora_cwrc_exec_xquery(ISLANDORA_EAP_XQUERY_ID, $keyValue);
  }
  echo $json_results;
}
