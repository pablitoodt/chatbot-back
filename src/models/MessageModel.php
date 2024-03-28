<?php

namespace App\Models;

use \PDO;
use stdClass;

class MessageModel extends SqlConnect {
    public function get() {
      $req = $this->db->prepare("SELECT * FROM messages");
      $req->execute();

      return $req->rowCount() > 0 ? $req->fetchAll(PDO::FETCH_ASSOC) : new stdClass();
    }

}