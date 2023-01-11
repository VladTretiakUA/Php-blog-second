<?php
declare(strict_types=1);

namespace Blog;

use PDO;

class LatestPosts
{
  /**
  * @var PDO
  */

  private PDO $connection;

  /**
  * LatestPosts constructor.
  * @param PDO connection
  */

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  /**
  * @return array|null
  */

  public function get(): ?array {
    $statement = $this->connection->prepare('SELECT * FROM post ORDER BY published_date DESC LIMIT 3');

    $statement->execute();

    return $statement->fetchAll();
  }
}
