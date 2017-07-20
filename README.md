# Gogs PHP Client


## Chainable
```
$service = new GogsService('http://try.gogs.io/api/v1/', 'admin', 'admin');

foreach ($orgs->getOrganisations() as $org) {
  print $org->getUsername() . "\n";
  foreach ($org->getRepositories() as $rep) {
    print "----" . $rep->getFullname() . "\n";
    try {
      $rep->getFileContent('master', 'composer.json');
      print "------------- HAS COMPOSER\n";
    } catch (\Exception $ex) {
      print "------------- NO COMPOSER\n";
    }
  }
}
```