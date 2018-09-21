<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace A0\models;

class response {
    private $response = [];
    
    public function __construct() {
        $this->response['messages'] = [];
        $this->response['error'] = 0;
        $this->response['content'] = "";
    }
    
    public function hasError() {
        return $this->response['error'];
    }
    
    public function setError($error) {
        $this->response['error'] = $error;
        return $this;
    }
    
    public function setMessage($content,$type='info') {
        $this->response['messages'][] = ['type'=>$type,'content'=>$content];
        return $this;
    }
    
    public function setContent($content) {
        $this->response['content'] = $content;
        return $this;
    }
    
    public function getMessages() {
        return $this->response['messages'];
    }
    
    public function send() {
        A0()->output->json($this->response);
    }
    
}
