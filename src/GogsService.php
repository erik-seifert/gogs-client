<?php
namespace bconnect\GogsClient;

use GuzzleHttp\Client;
use bconnect\GogsClient\IGogsRepoQuery;
use bconnect\GogsClient\Repository\Repository;
use bconnect\GogsClient\Organisation\Organisation;
use bconnect\GogsClient\User\User;

class GogsService implements IGogsService {
  protected $client;
  private function getJsonContent($response) {
    return json_decode($response->getBody()->getContents(), true);
  }

  private function getRawContent($response) {
    return $response->getBody()->getContents();
  }

  private function castRepos($reps) {
    $oReps = [];
    foreach ($reps as $rep) {
      $oReps[] = new Repository($this, $rep);
    }
    return new \ArrayIterator($oReps);
  }

  private function castOrgs($orgs) {
    $oOrgs = [];
    foreach ($orgs as $org) {
      $oOrgs[] = new Organisation($this, $org);
    }
    return new \ArrayIterator($oOrgs);
  }

  public function __construct($url, $login, $password, $handler = null) {
    $this->client = new Client([
        // Base URI is used with relative requests
        'base_uri' => $url,
        // You can set any number of default request options.
        'timeout'  => 2.0,
        'auth' => [$login, $password],
        'handler' => ($handler) ? $handler : null
    ]);
  }

  public function connect($url, $login, $password) {
    $this->client = new Client([
        // Base URI is used with relative requests
        'base_uri' => $url,
        // You can set any number of default request options.
        'timeout'  => 2.0,
        'auth' => [$login, $password],
        
    ]);
  }

  public function getRepositoryList() {
    return $this->castRepos($this->getJsonContent($this->client->get('user/repos')));
  }

  public function searchRepositories($query) {
    return $this->castRepos($this->getJsonContent($this->client->get('repos/search',['query' => $query]))['data']);
  }

  public function getUserRepositories(User $user) {
    return $this->castRepos($this->getJsonContent($this->client->get("users/{$user->getUserName()}/repos")));
  }

  public function getOrganisationRepositories(Organisation $org) {
    return $this->castRepos($this->getJsonContent($this->client->get("orgs/{$org->getUsername()}/repos")));
  }

  public function getRepository(Organisation $org, $repoName): Repository {
    $repo = $this->getJsonContent($this->client->get("repos/{$org->getUsername()}/{$repoName}"));
    return new Repository($this, $repo);
  }

  public function getBranchesForRepository(Repository $repository) {

  }

  public function getUser($username) {
    return new User($this, $this->getJsonContent($this->client->get("users/{$username}")));
  }

  public function getOrganisation($orgName) {
    $org = $this->getJsonContent($this->client->get("orgs/{$orgName}"));
    return new Organisation($this, $org);
  }

  public function getRepositoryFileContent(Repository $repository, $ref, $path) {
    return $this->getRawContent($this->client->get(implode('/',[
      'repos',
      $repository->getOwner()->getUsername(),
      $repository->getName(),
      'raw',
      $ref,
      'composer.json'
    ])));
  }

  public function getOrganisations() {
    return $this->castOrgs($this->getJsonContent($this->client->get("user/orgs")));
  }
}