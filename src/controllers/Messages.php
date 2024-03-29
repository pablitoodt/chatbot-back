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

    public function postMessage() {
        $body = (array) json_decode(file_get_contents('php://input'));
        $this->model->add($body);
    }

    protected function getMessages() {
        return $this->model->get();
    }

    protected function header() {
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json; charset=utf-8');
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
        $this->ifMethodExist();
    }
}
