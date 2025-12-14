<?php namespace App\Controllers;

class Chatbot extends BaseController
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = getenv('GOOGLE_AI_API_KEY') ?: '';
    }

    public function index()
    {
        return $this->renderView('pages/chatbot', [
            'title' => 'Servify - Chatbot AI Assistant',
        ]);
    }

    public function sendMessage()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Invalid Request',
            ]);
        }

        $message = trim($this->request->getPost('message'));

        if ($message === '') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pesan kosong',
                'token'   => csrf_hash(),
            ]);
        }

        try {
            $reply = $this->callGoogleAI($message);

            return $this->response->setJSON([
                'success' => true,
                'reply'   => $reply,
                'token'   => csrf_hash(),
            ]);
        } catch (\Throwable $e) {
            log_message('error', '[Chatbot] ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => (getenv('CI_ENVIRONMENT') === 'development')
                    ? $e->getMessage()
                    : 'Maaf, server sedang sibuk.',
                'token'   => csrf_hash(),
            ]);
        }
    }

    private function callGoogleAI(string $message): string
    {
        if ($this->apiKey === '') {
            throw new \Exception('API Key Gemini belum disetting');
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.0-flash:generateContent?key={$this->apiKey}";

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $message]
                    ]
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
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response  = curl_exec($ch);
        $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            throw new \Exception('Koneksi gagal: ' . $curlError);
        }

        $result = json_decode($response, true);

        if ($httpCode !== 200) {
            $msg = $result['error']['message'] ?? 'Unknown Error';
            throw new \Exception("Google API ({$httpCode}): {$msg}");
        }

        if (!isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            throw new \Exception('Respon Gemini tidak valid');
        }

        return $result['candidates'][0]['content']['parts'][0]['text'];
    }
}
