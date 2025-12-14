<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Chatbot extends BaseController
{
    protected $apiKey;
    
    public function __construct()
    {
        // Mengambil API Key dari .env
        $this->apiKey = getenv('GOOGLE_AI_API_KEY');
    }
    
    public function index()
    {
        $data = [
            'title' => 'Servify - Chatbot AI Assistant',
        ];
        
         return $this->renderView('pages/chatbot', $data);
    }
    
    public function sendMessage()
    {
        // 1. Validasi Request
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid Request']);
        }
        
        $message = $this->request->getPost('message');
        
        if (empty($message)) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Pesan kosong', 
                'token' => csrf_hash()
            ]);
        }
        
        try {
            // 2. Panggil API
            $reply = $this->callGoogleAI($message);
            
            return $this->response->setJSON([
                'success' => true,
                'reply'   => $reply,
                'token'   => csrf_hash()
            ]);
            
        } catch (\Exception $e) {
            // Log error untuk developer
            log_message('error', '[Chatbot] ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                // Tampilkan pesan error jika di development, pesan umum jika production
                'message' => (getenv('CI_ENVIRONMENT') === 'development') 
                             ? "Error: " . $e->getMessage() 
                             : "Maaf, server sedang sibuk. Silakan coba lagi.",
                'token'   => csrf_hash()
            ]);
        }
    }
   
private function callGoogleAI($message)
    {
        if (!$this->apiKey) throw new \Exception("API Key belum disetting di .env");

        $model = 'gemini-embedding-001'; 
        
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$this->apiKey}";
        
        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [['text' => $message]]
                ]
            ]
        ];

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => false, // Penting buat Localhost
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) throw new \Exception("Koneksi Gagal: " . $curlError);

        $result = json_decode($response, true);

        // Cek Error API
        if ($httpCode !== 200) {
            // Tangkap pesan error spesifik dari Google
            $errMsg = $result['error']['message'] ?? 'Unknown Error';
            
            // Jika Error 429 (Kebanyakan Request), beri pesan user friendly
            if ($httpCode == 429) {
                throw new \Exception("Server sedang sibuk (Limit API Tercapai). Silakan tunggu 1 menit lagi.");
            }
            
            throw new \Exception("Google API ({$httpCode}): {$errMsg}");
        }

        if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            return $result['candidates'][0]['content']['parts'][0]['text'];
        }

        throw new \Exception("Format respon tidak sesuai. Raw: " . substr($response, 0, 100));
    }
}