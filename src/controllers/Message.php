<?php

namespace App\Controllers;

class Message {
    protected array $params;
    protected array $messages;

    public function __construct($params) {
        $this->params = $params;
        $this-> messages = ['bonjour','hello','tutu'];
        $this->run();
    }

    protected function header() {
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json; charset=utf-8");
    }

    protected function run() {
        $this->header();
        if (isset($this->params['id']) && is_numeric($this->params['id'])) {
            $index = intval($this->params['id'])-1;
            if ($index >= 0 && $index < count($this->messages)) {
                echo json_encode([
                    'message' => $this->messages[$index],
                    'code' => 200
                ]);
                return;
            }
        }
        
        echo json_encode([
            'message' => 'Invalid request',
            'code' => 400
        ]);
    }
}
