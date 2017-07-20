<?php

namespace bconnect\GogsClient\User;

use bconnect\GogsClient\IGogsService;

class User {
  protected $id;
  protected $name;
  protected $username;
  protected $avatar_url;
  protected $client;

  public function __construct(IGogsService $client, $values) {
    $this->client = $client;
    if ($values['id']) {
      $this->id = $values['id'];
    }
    if (isset($values['name'])) {
      $this->name = $values['name'];
    }
    if (isset($values['username'])) {
      $this->username = $values['username'];
    }
    if (isset($values['avatar_url'])) {
      $this->avatar_url = $values['avatar_url'];
    }
  }

  public function setId($id) {
    $this->id;
  }

  public function getId() {
    return $this->id;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }

  public function setUserName($name) {
    $this->username = $name;
  }

  public function getUserName() {
    return $this->username;
  }

  public function getRepositories() {
    return $this->client->getUserRepositories($this);
  }

  public function setAvatarUrl() {
    return $this->avatar_url;
  }

  public function getRepository($repoName) {
    return $this->client->getRepository($this, $repoName);
  }
} 