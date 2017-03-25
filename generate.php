<?php

require './config/settings.php';
require './vendor/autoload.php';

use Checker\DrupalOrgClient;

global $conf;
$is_header = TRUE;
$header = [];
$data_path = __DIR__ . '/data/';
$dest_path = __DIR__ . '/dest/';

if (($handle = fopen($data_path . 'projects.csv', 'r')) !== FALSE) {
  $options = [
    'http_errors' => TRUE,
    'timeout'  => 120,
    'verify' => FALSE,
  ];
  /** @var \GuzzleHttp\Command\Guzzle\Description $description */
  $description = DrupalOrgClient::getDescription();
  /** @var Checker\DrupalOrgClient $client */
  $client = DrupalOrgClient::create($options, $description);
  while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {
    if ($is_header) {
      $is_header = FALSE;
      $header = $line;
      continue;
    }
    $row = [];
    foreach ($header as $index => $column) {
      $key = str_replace(' ', '_', strtolower($column));
      $row[$key] = isset($line[$index]) ? $line[$index] : NULL;
    }
    $ts = time();
    $client->getAdditionalData($row, $conf['core']);
    // Additional field for prod URL.
    console_log("Processed !project project (!time)\n", ['!project' => $row['project'], '!time' => (time() - $ts) . 's']);
    $rows[] = $row;
  }
  fclose($handle);
  $data = [
    'updated' => date('c'),
    'metadata' => $rows
  ];
  console_log("Generated metadata at !time.\n", ['!time' => $data['updated']]);
}

if (isset($data) && ($handle = fopen($dest_path . 'project-metadata.json', 'w+')) !== FALSE) {
  if (!fwrite($handle, json_encode($data) . "\n")) {
    console_log('Error while writing project-metadata.json');
  }
  fclose($handle);
}
else {
  console_log('Error while opening projects.json to write');
  exit(1);
}

/**
 * Helper to log messages.
 *
 * @param string $message
 *
 * @param array $options
 *   An array of replacement string and translation.
 */
function console_log($message, array $options = []) {
  print strtr($message, $options);
}
