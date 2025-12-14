<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Servify - Solusi Reparasi Laptop Anda',
        ];
        
        return $this->renderView('pages/home', $data);
    }
    
    public function chatbot()
    {
        $data = [
            'title' => 'Servify - Chatbot',
        ];
        return $this->renderView('pages/chatbot', $data);
    }
    
     public function findus()
    {
        $data = [
            'title' => 'Find Us - Servify Locations',
            'session' => $this->session
        ];
        
        return $this->renderView('pages/findus', $data);
    }
}