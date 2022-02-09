<?php
namespace Dao;

Use SQLite3;
Use PDO;

class DbConnection
{
  private $serverName = 'oilchange.db';

  protected function connect() {
    // $conn = new SQLite3($this->serverName);

    $conn = new PDO('sqlite:' . $this->serverName);

    return $conn;
  }
}
