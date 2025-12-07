<?php namespace App\Controllers;

class Chatbot extends BaseController
{
    protected $apiKey;
    
    public function __construct()
    {
        // Load API Key from environment
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
        // Validasi request
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }
        
        $message = $this->request->getPost('message');
        
        if (empty($message)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Message cannot be empty'
            ]);
        }
        
        try {
            // Call Google AI API
            $response = $this->callGoogleAI($message);
            
            return $this->response->setJSON([
                'success' => true,
                'reply' => $response
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Chatbot Error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sorry, I encountered an error. Please try again later.',
                'error' => ENVIRONMENT === 'development' ? $e->getMessage() : null
            ]);
        }
    }
    
    private function callGoogleAI($message)
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Google AI API Key not configured');
        }
        
        // Prepare system context for laptop repair assistant
        $systemPrompt = "You are a helpful assistant for Servify, a laptop repair service platform. Help users with laptop repair inquiries, booking services, and product recommendations. Be friendly and professional. Answer in Indonesian language.";
        
        $fullPrompt = $systemPrompt . "\n\nUser: " . $message . "\n\nAssistant:";
        
        // Google AI API endpoint (Gemini)
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $this->apiKey;
        
        $data = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $fullPrompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 800,
            ]
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            throw new \Exception('CURL Error: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        if ($httpCode !== 200) {
            throw new \Exception('API returned status code: ' . $httpCode);
        }
        
        $result = json_decode($response, true);
        
        if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            return $result['candidates'][0]['content']['parts'][0]['text'];
        }
        
        throw new \Exception('Invalid API response format');
    }
}