<?php

namespace App\Models;

use \PDO;
use stdClass;

class MessageModel extends SqlConnect {
  public function add($data) {
    $query = "
      INSERT INTO messages (type, name, content, botColor, day, time, api)
      VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $req = $this->db->prepare($query);

    $req->execute([
      $data['type'],
      $data['name'],
      $data['content'],
      $data['botColor'],
      $data['day'],
      $data['time'],
      $data['api']
    ]);
  }

  public function get() {
    $req = $this->db->prepare("SELECT * FROM messages");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
  }

  public function getYellow() {
    $req = $this->db->prepare("SELECT * FROM messages WHERE api='meteo' OR botColor='yellow' OR api='hello'");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
  }

  public function getGreen() {
    $req = $this->db->prepare("SELECT * FROM messages WHERE name='user'");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
  }

  public function getPink() {
    $req = $this->db->prepare("SELECT * FROM messages WHERE api='alcool'");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
  }

  public function getLast() {
    $req = $this->db->prepare("SELECT * FROM messages ORDER BY id DESC LIMIT 1");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
  }
}