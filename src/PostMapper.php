<?php

declare(strict_types=1);

namespace Blog;

use PDO;

class PostMapper
{
  /**
  * @var PDO
  */

  private PDO $connection;

  /**
  * PostMapper constructor.
  * @param PDO connection
  */

  public function __construct(PDO $connection)
  {
    $this->connection = $connection;
  }

  /**
  * @param string $urlKey
  * @return array|null
  */

  public function getByUrlKey(string $urlKey): ?array {
    $statement = $this->connection->prepare('SELECT * FROM post WHERE url_key = :url_key');
    $statement->execute([
      'url_key' => $urlKey
    ]);
    $result = $statement->fetchAll();
    return array_shift($result);
  }

  public function getList(){
    $statement = $this->connection->prepare('SELECT * FROM post ORDER BY published_date DESC');
    $statement->execute();
    return $statement->fetchAll();
  }

  // public function getImage(){
  //   $statement = $this->connection->prepare('UPDATE post SET image_path = "public/images/tree.jpg" WHERE post_id = 4');
  //   $statement->execute();
  //   return $statement->fetchAll();
  // }
}
