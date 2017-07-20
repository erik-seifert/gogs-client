<?php

namespace bconnect\GogsClient\Branch;

use bconnect\GogsClient\User\User;
use bconnect\GogsClient\Repository\Repository;
use bconnect\GogsClient\IGogsService;

class Branch {
  protected $id;
  protected $client;
  protected $values;
  protected $name;
  protected $repository;
  protected $author;
  protected $message;

  public function __construct(IGogsService $client, Repository $rep, $values) {
    $this->client = $client;
    $this->id = $values['commit']['id'];
    $this->name = $values['name'];
    $this->values = $values;
    $this->author = $values['commit']['author'];
    $this->message = $values['commit']['message'];
    $this->repository = $rep;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getRepository() {
    return $this->repository;
  }

}