<?php

namespace bconnect\GogsClient\Organisation;

use bconnect\GogsClient\User\User;
use bconnect\GogsClient\Repository\Repository;
use bconnect\GogsClient\IGogsService;

class Organisation {
  protected $id;
  protected $client;
  protected $values;
  protected $username;

  public function __construct(IGogsService $client, $values) {
    $this->client = $client;
    $this->id = $values['id'];
    $this->username = $values['username'];
    $this->values = $values;
  }

  public function getId() {
    return $this->id;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getRepository($repoName) {
    return $this->client->getRepository($this, $repoName);
  }

  public function getRepositories() {
    return $this->client->getOrganisationRepositories($this);
  }

}