<?php

namespace Tarsas\Models;

class BookModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getByValues($args)
  {
    foreach ($args as $key => $val) {
      $args[$key] = '%' . $val . '%';
    }
    $params = [];
    foreach (['title', 'isbn', 'writer'] as $key) {
      $params[$key] = isset($args[$key]) ? $args[$key] : '%';
    }
    $this->res = $this->db->prepare('
      SELECT
        kon.konyvid,
        kon.ISBN as isbn,
        kon.cim,
        szr.nev
      FROM
        konyv kon
      LEFT JOIN
        konyvszerzo ksz
          ON ksz.konyvid = kon.konyvid
      LEFT JOIN
        szerzo szr
          ON szr.szerzoid = ksz.szerzoid
      WHERE
        TRUE
        AND kon.cim LIKE :title
        AND kon.ISBN LIKE :isbn
        AND szr.nev LIKE :writer
    ');
    $this->res->execute($params);
    return $this->res->fetchAll();
  }

  public function newBook($args)
  {
    $this->res = $this->db->prepare('
      INSERT INTO konyv
      SET cim = :title, ISBN = :isbn
    ');
    $this->res->execute([
      'title' => $args['title'],
      'isbn' => $args['isbn']
    ]);
    $this->res->fetch();
    $bookId = $this->db->lastInsertId();

    $this->res = $this->db->prepare('
      INSERT INTO szerzo
      SET nev = :writer
    ');
    $this->res->execute([
      'writer' => $args['writer']
    ]);
    $this->res->fetch();
    $writerId = $this->db->lastInsertId();

    $this->res = $this->db->prepare('
      INSERT INTO konyvszerzo
      SET konyvid = :konyvid, szerzoid = :szerzoid
    ');
    $this->res->execute([
      'konyvid' => $bookId,
      'szerzoid' => $writerId
    ]);
    $this->res->fetch();
  }
}
