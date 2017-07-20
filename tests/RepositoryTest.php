<?php
declare(strict_types=1);

namespace bconnect\GogsService\Tests;

use PHPUnit\Framework\TestCase;
use bconnect\GogsClient\GogsService;
use bconnect\GogsClient\IGogsService;

use bconnect\GogsClient\User\User;
use bconnect\GogsClient\Repository\Repository;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

use bconnect\GogsService\Tests\TestHelper;

final class RepositoryTest extends TestCase {
  public $handler = null;

  public function setUp() {

    $mock = new MockHandler([
      new Response(200, ['X-Foo' => 'Bar'],  Psr7\stream_for(TestHelper::getRepositoryList())),
      new Response(202, ['Content-Length' => 0]),
      new RequestException("Error Communicating with Server", new Request('GET', 'test'))
    ]);

    $handler = HandlerStack::create($mock);

    $this->client = new GogsService('localhost','test','test',$handler);

  }

  public function testRepositoryList() {
    $reps = $this->client->getRepositoryList();
    $this->assertEquals(
      2,
      count($reps)
    );
    $this->assertEquals(
      2,
      $reps->current()->getId()
    );
    $this->assertEquals(
      8,
      $reps->offsetGet(1)->getId()
    );

    $this->assertInstanceOf(Repository::class, $reps->current());

    $user = $reps->offsetGet(0)->getOwner();
    $this->assertInstanceOf(User::class, $user);

    $this->assertEquals(
      $user->getUsername(),
      'unknwon'
    );

  }
}