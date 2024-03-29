<?php

namespace App\Models;

use \PDO;
use stdClass;

class MessageModel extends SqlConnect {
  public function add(array $data) {
    $query = "
      INSERT INTO messages (type, name, content, botColor, day, time)
      VALUES (:type, :name, :content, :botColor, :day, :time)
    ";

    $req = $this->db->prepare($query);
    try {
      $req->execute($data);
    } catch (\PDOException $e) {
      throw $e;
    }

  }
  public function get() {
    $req = $this->db->prepare("SELECT * FROM messages");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
  }
}