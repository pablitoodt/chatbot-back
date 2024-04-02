<?php

namespace App\Controllers;

use App\Models\MessageModel;

class Messages {
    protected array $params;
    protected string $reqMethod;
    protected object $model;

    public function __construct($params) {
        $this->params = $params;
        $this->reqMethod = strtolower($_SERVER['REQUEST_METHOD']);

        $this->model = new MessageModel();
        $this->run();
    }

    public function postMessages() {
        $body = (array) json_decode(file_get_contents('php://input'));
        $this->model->add($body);

        return $this->model->getLast();
    }

    protected function getMessages() {
        return $this->model->get();
    }

    protected function header() {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json; charset=utf-8');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }

    protected function ifMethodExist() {
        $method = $this->reqMethod.'Messages';

        if (method_exists($this, $method)) {
        echo json_encode($this->$method());

        return;
        }

        header('HTTP/1.0 404 Not Found');
        echo json_encode([
        'code' => '404',
        'message' => 'Not Found'
        ]);

        return;
    }

    protected function run() {
        $this->header();
        if ($this->reqMethod === 'options') {
            header('HTTP/1.1 204 No Content');
            exit;
        }
        $this->ifMethodExist();
    }
}
