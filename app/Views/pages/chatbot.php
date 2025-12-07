<div class="flex justify-center items-center min-h-[70vh]">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
        
        <div class="bg-gradient-to-r from-primary-blue to-secondary-purple p-6 text-white">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold">Servify AI Assistant</h2>
                    <p class="text-sm text-blue-100">Siap membantu Anda 24/7</p>
                </div>
            </div>
        </div>
        
        <div id="chatMessages" class="h-[500px] overflow-y-auto p-6 space-y-4 bg-gray-50">
            <div class="flex items-start space-x-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-blue to-secondary-purple flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-none p-4 shadow-md max-w-[80%]">
                    <p class="text-gray-800">Halo! 👋 Saya adalah asisten AI Servify.</p>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-200 p-4 bg-white">
            <form id="chatForm" class="flex items-center space-x-3">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrfToken">
                
                <input 
                    type="text" 
                    id="messageInput" 
                    placeholder="Ketik pesan Anda di sini..." 
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-blue focus:border-transparent outline-none"
                    autocomplete="off"
                />
                <button 
                    type="submit" 
                    id="sendButton"
                    class="bg-gradient-to-r from-primary-blue to-secondary-purple text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition duration-300 transform hover:scale-105 flex items-center space-x-2"
                >
                    <span>Kirim</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const chatMessages = document.getElementById('chatMessages');
    const csrfToken = document.getElementById('csrfToken'); // Ambil elemen CSRF

    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const message = messageInput.value.trim();
        if (!message) return;
        
        addMessage(message, 'user');
        messageInput.value = '';
        setLoading(true);
        const typingId = addTypingIndicator();
        
        try {
            // PERBAIKAN: Kirim CSRF Token dalam body request
            const formData = new URLSearchParams();
            formData.append('message', message);
            formData.append(csrfToken.name, csrfToken.value); // Append CSRF

            const response = await fetch('<?= base_url('chatbot/sendMessage') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });
            
            const data = await response.json();
            
            // Update CSRF token untuk request berikutnya (Penting untuk CI4!)
            if(data.token) {
                csrfToken.value = data.token;
            }

            removeTypingIndicator(typingId);
            
            if (data.success) {
                addMessage(data.reply, 'bot');
            } else {
                addMessage('Error: ' + (data.message || 'Gagal memproses pesan'), 'bot', true);
            }
            
        } catch (error) {
            removeTypingIndicator(typingId);
            console.error(error);
            addMessage('Maaf, terjadi kesalahan koneksi.', 'bot', true);
        }
        
        setLoading(false);
    });
    
    // ... (Fungsi helper addMessage, addTypingIndicator, dll sama seperti sebelumnya)
    function addMessage(text, sender, isError = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-start space-x-3';
        if (sender === 'user') {
            messageDiv.classList.add('flex-row-reverse', 'space-x-reverse');
            messageDiv.innerHTML = `<div class="bg-blue-600 text-white p-3 rounded-lg max-w-[80%]">${text}</div>`;
        } else {
            messageDiv.innerHTML = `<div class="bg-gray-100 text-gray-800 p-3 rounded-lg max-w-[80%]">${text}</div>`;
        }
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function addTypingIndicator() {
        const div = document.createElement('div');
        div.innerHTML = '<div class="text-xs text-gray-500 p-2">Mengetik...</div>';
        chatMessages.appendChild(div);
        return div;
    }

    function removeTypingIndicator(el) {
        if(el) el.remove();
    }

    function setLoading(isLoading) {
        sendButton.disabled = isLoading;
        messageInput.disabled = isLoading;
    }
});
</script>