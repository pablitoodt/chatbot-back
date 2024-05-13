<?php

namespace App\Models;

use \PDO;
use stdClass;

class BotsModel extends SqlConnect {
  public function get() {
    $req = $this->db->prepare("SELECT * FROM bots");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
  }

  public function getLast() {
    $req = $this->db->prepare("SELECT * FROM bots ORDER BY id DESC LIMIT 1");
    $req->execute();

    return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdClass();
  }
}