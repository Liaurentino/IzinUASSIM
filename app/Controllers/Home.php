<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Data untuk contoh di halaman utama
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
        // Logika sederhana untuk chatbot (tanpa AI/API eksternal)
        return $this->renderView('pages/chatbot', $data);
    }
    
    // Halaman Find Us (Map dummy)
    public function findus()
    {
        $data = [
            'title' => 'Servify - Cari Lokasi Kami',
        ];
        return $this->renderView('pages/findus', $data);
    }
}