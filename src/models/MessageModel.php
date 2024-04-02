<?php

namespace App\Models;

use \PDO;
use stdClass;

class MessageModel extends SqlConnect {
  public function add($data) {
    $query = "
      INSERT INTO messages (type, name, content, botColor, day, time)
      VALUES (?, ?, ?, ?, ?, ?)
    ";

    $req = $this->db->prepare($query);

    $req->execute([
      $data['type'],
      $data['name'],
      $data['content'],
      $data['botColor'],
      $data['day'],
      $data['time']
    ]);
  }

  public function get() {
    $req = $this->db->prepare("SELECT * FROM messages");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
  }

  public function getLast() {
    $req = $this->db->prepare("SELECT * FROM messages ORDER BY id DESC LIMIT 1");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
  }
}