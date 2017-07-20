<?php
namespace bconnect\GogsClient;

use GuzzleHttp\Client;
use bconnect\GogsClient\IGogsRepoQuery;
use bconnect\GogsClient\Repository\Repository;
use bconnect\GogsClient\User\User;

class GogsService implements IGogsService {
  protected $client;
  private function getJsonContent($response) {
    return json_decode($response->getBody()->getContents(), true);
  }

  private function castRepos($reps) {
    $oReps = [];
    foreach ($reps as $rep) {
      $oReps[] = new Repository($this, $rep);
    }
    return new \ArrayIterator($oReps);
  }

  public function __construct($url, $login, $password, $handler) {
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
    return $this->castRepos($this->getJsonContent($this->client->get('users/'.$user->getUserName().'/repos')));
  }

  public function getOrgRepositories($org) {

  }

  public function getRepository(User $user, $id) {

  }

  public function getBranchesForRepository(Repository $repository) {

  }

  public function getRepositoryFileContent($repository, $ref, $path) {

  }
}