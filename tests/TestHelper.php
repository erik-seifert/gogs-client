<?php

namespace bconnect\GogsService\Tests;

final class TestHelper {
  public static function getRepositoryList() {
    return '[
        {
          "id": 2,
          "owner": {
            "id": 1,
            "username": "unknwon",
            "full_name": "",
            "email": "u@gogs.io",
            "avatar_url": "/avatars/1"
          },
          "full_name": "unknwon/macaron",
          "private": false,
          "fork": false,
          "html_url": "http://localhost:3000/unknwon/macaron",
          "clone_url": "http://localhost:3000/unknwon/macaron.git",
          "ssh_url": "jiahuachen@localhost:unknwon/macaron.git",
          "permissions": {
            "admin": true,
            "push": true,
            "pull": true
          }
        },
        {
          "id": 8,
          "owner": {
            "id": 2,
            "username": "org1",
            "full_name": "org1",
            "email": "org1@org.com",
            "avatar_url": "/avatars/2"
          },
          "full_name": "org1/gogs",
          "private": false,
          "fork": false,
          "html_url": "http://localhost:3000/org1/gogs",
          "clone_url": "http://localhost:3000/org1/gogs.git",
          "ssh_url": "jiahuachen@localhost:org1/gogs.git",
          "permissions": {
            "admin": true,
            "push": true,
            "pull": true
          }
        }
      ]';
  }
}