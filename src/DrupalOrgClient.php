<?php

namespace Checker;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\DescriptionInterface;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\ServiceClientInterface;

/**
 * Class DrupalOrgClient
 *
 * @package Checker
 */
class DrupalOrgClient {

  /**
   * @var \GuzzleHttp\Command\ServiceClientInterface
   */
  protected $client;


  /**
   * DrupalOrgClient constructor.
   *
   * @param \GuzzleHttp\Command\ServiceClientInterface $client
   */
  public function __construct(ServiceClientInterface $client) {
    $this->client = $client;
  }

  /**
   * Creates new object.
   *
   * @param array $config
   *
   * @param \GuzzleHttp\Command\Guzzle\DescriptionInterface $description
   *
   * @return static
   *   Static object.
   */
  public static function create($config = [], DescriptionInterface $description) {
    return new static(
      new GuzzleClient(new Client($config), $description)
    );
  }

  /**
   * Retrieves version details.
   *
   * @param $row
   *
   * @return string
   *   String version number.
   */
  protected function getVersions($row, $core_version) {
    $client = new Client();
    $versions = [];
    // Fix me with DI.
    $response = $client->get('https://updates.drupal.org/release-history/' . $row['project'] . '/' . $core_version);
    $xml = simplexml_load_string($response->getBody()->getContents());
    if (is_object($xml) && !isset($xml->error)) {
      foreach ($xml->releases->release as $release) {
        $versions[(string)$release->version] = (array)$release;
      }
    }
    return $versions;
  }

  /**
   * Provides additional details for each domain.
   *
   * @param array $row
   * @param $core_version
   */
  public function getAdditionalData(array &$row, $core_version) {
    $row['details'] = $this->getProjectDetails(['field_project_machine_name' => $row['project']]);
    $row['maintainers'] = $this->getMaintainers(['project' => $row['project']]);
    $row['versions'] = $this->getVersions($row, $core_version);
  }

  /**
   * Gets project meta data from Drupal.org API.
   *
   * @param $args
   *
   * @return array
   */
  protected function getProjectDetails($args) {
    /** @var \GuzzleHttp\Command\Result $response */
    $response = $this->client->getProjectDetails($args);
    return $response->toArray();
  }

  /**
   * Gets projects' maintainers.
   *
   * @param $args
   * @return array
   */
  protected function getMaintainers($args) {
    /** @var \GuzzleHttp\Command\Result $response */
    $response = $this->client->getMaintainers($args);
    return $response->toArray();
  }

  /**
   * @return \GuzzleHttp\Command\Guzzle\Description
   */
  public static function getDescription() {
    return new Description([
      'baseUri' => 'https://www.drupal.org',
      'operations' => [
        'getProjectDetails' => [
          'httpMethod' => 'GET',
          'uri' => '/api-d7/node.json{?field_project_machine_name}',
          'responseModel' => 'getResponse',
          'parameters' => [
            'field_project_machine_name' => [
              'type' => 'string',
              'location' => 'query'
            ],
          ],
        ],
        'getMaintainers' => [
          'httpMethod' => 'GET',
          'uri' => '/project/{project}/maintainers.json',
          'responseModel' => 'getResponse',
          'parameters' => [
            'project' => [
              'type' => 'string',
              'location' => 'uri'
            ],
          ],
        ],
      ],
      'models' => [
        'getResponse' => [
          'type' => 'object',
          'additionalProperties' => [
            'location' => 'json'
          ],
        ],
      ],
    ]);
  }

}
