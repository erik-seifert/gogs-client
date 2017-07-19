<?php

namespace bconnect\GogsClient;

use bconnect\GogsClient\IGogsRepoQuery;
use bconnect\GogsClient\Repository\Repository;
use bconnect\GogsClient\User\User;

interface IGogsService {
  public function connect($url, $login, $password);
  public function getRepositoryList();
  public function searchRepositories($query);
  public function getUserRepositories(User $user);
  public function getOrgRepositories($org);

  public function getRepository(User $user, $id);

  public function getBranchesForRepository(Repository $repository);

  public function getRepositoryFileContent($repository, $ref, $path);

}