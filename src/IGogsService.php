<?php

namespace bconnect\GogsClient;

use bconnect\GogsClient\IGogsRepoQuery;
use bconnect\GogsClient\Repository\Repository;
use bconnect\GogsClient\User\User;
use bconnect\GogsClient\Organisation\Organisation;

interface IGogsService {
  public function getRepositoryList();
  public function searchRepositories($query);
  public function getUserRepositories(User $user);
  public function getOrganisationRepositories(Organisation $org);

  public function getRepository(Organisation $user, $id);

  public function getBranchesForRepository(Repository $repository);

  public function getRepositoryFileContent(Repository $repository, $ref, $path);

  public function getUser($username);

  public function getOrganisation($orgName);
  public function getOrganisations();

}