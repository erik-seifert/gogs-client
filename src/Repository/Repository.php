<?php

namespace bconnect\GogsClient\Repository;

use bconnect\GogsClient\User\User;
use bconnect\GogsClient\IGogsService;
use bconnect\GogsClient\Organisation\Organisation;

class Repository {
  protected $id;
  protected $owner;
  protected $client;
  protected $values;

  public function __construct(IGogsService $client, $values) {
    $this->client = $client;
    if ($values['owner']) {
      $this->owner = new Organisation($client, $values['owner']);
    }
    $this->id = $values['id'];
    $this->full_name = $values['full_name'];
    $this->values = $values;
  }

  public function getId() {
    return $this->id;
  }

  public function getOwner() {
    return $this->owner;
  }

  public function getFullName() {
    return $this->values['full_name'];
  }

  public function getName() {
    return explode('/', $this->getFullName())[1];
  }

  public function getBranches() {
    return $this->client->getBranchesForRepository($this);
  }

  public function getFileContent($ref, $path) {
    return $this->client->getRepositoryFileContent($this, $ref, $path);
  }

  public function getValues() {
    return $this->values;
  }

}