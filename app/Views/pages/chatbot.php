<!-- Halaman Chatbot dengan Design Modern -->
<div class="flex justify-center items-center min-h-[70vh]">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
        
        <!-- Header Chatbot -->
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
        
        <!-- Chat Messages Container -->
        <div id="chatMessages" class="h-[500px] overflow-y-auto p-6 space-y-4 bg-gray-50">
            <!-- Welcome Message -->
            <div class="flex items-start space-x-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-blue to-secondary-purple flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-none p-4 shadow-md max-w-[80%]">
                    <p class="text-gray-800">Halo! 👋 Saya adalah asisten AI Servify. Saya dapat membantu Anda dengan:</p>
                    <ul class="mt-2 text-sm text-gray-600 space-y-1">
                        <li>• Informasi service laptop</li>
                        <li>• Rekomendasi produk</li>
                        <li>• Bantuan reservasi</li>
                        <li>• Pertanyaan umum</li>
                    </ul>
                    <p class="mt-2 text-gray-800">Ada yang bisa saya bantu?</p>
                </div>
            </div>
        </div>
        
        <!-- Input Area -->
        <div class="border-t border-gray-200 p-4 bg-white">
            <form id="chatForm" class="flex items-center space-x-3">
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
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
    
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const message = messageInput.value.trim();
        if (!message) return;
        
        // Add user message to chat
        addMessage(message, 'user');
        messageInput.value = '';
        
        // Disable input while processing
        setLoading(true);
        
        // Show typing indicator
        const typingId = addTypingIndicator();
        
        try {
            const response = await fetch('<?= base_url('chatbot/sendMessage') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ message: message })
            });
            
            const data = await response.json();
            
            // Remove typing indicator
            removeTypingIndicator(typingId);
            
            if (data.success) {
                addMessage(data.reply, 'bot');
            } else {
                addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot', true);
            }
            
        } catch (error) {
            removeTypingIndicator(typingId);
            addMessage('Maaf, terjadi kesalahan koneksi. Silakan coba lagi.', 'bot', true);
        }
        
        setLoading(false);
    });
    
    function addMessage(text, sender, isError = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-start space-x-3';
        
        if (sender === 'user') {
            messageDiv.classList.add('flex-row-reverse', 'space-x-reverse');
            messageDiv.innerHTML = `
                <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="bg-gradient-to-r from-primary-blue to-secondary-purple text-white rounded-2xl rounded-tr-none p-4 shadow-md max-w-[80%]">
                    <p>${escapeHtml(text)}</p>
                </div>
            `;
        } else {
            const bgColor = isError ? 'bg-red-50 border border-red-200' : 'bg-white';
            const textColor = isError ? 'text-red-700' : 'text-gray-800';
            
            messageDiv.innerHTML = `
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-blue to-secondary-purple flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="${bgColor} rounded-2xl rounded-tl-none p-4 shadow-md max-w-[80%]">
                    <p class="${textColor}">${formatMessage(text)}</p>
                </div>
            `;
        }
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }
    
    function addTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'flex items-start space-x-3 typing-indicator';
        typingDiv.innerHTML = `
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-blue to-secondary-purple flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="bg-white rounded-2xl rounded-tl-none p-4 shadow-md">
                <div class="flex space-x-2">
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                </div>
            </div>
        `;
        
        chatMessages.appendChild(typingDiv);
        scrollToBottom();
        return typingDiv;
    }
    
    function removeTypingIndicator(element) {
        if (element && element.parentNode) {
            element.parentNode.removeChild(element);
        }
    }
    
    function setLoading(loading) {
        messageInput.disabled = loading;
        sendButton.disabled = loading;
        
        if (loading) {
            sendButton.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            sendButton.classList.remove('opacity-50', 'cursor-not-allowed');
            messageInput.focus();
        }
    }
    
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    function formatMessage(text) {
        // Convert line breaks to <br>
        text = escapeHtml(text);
        text = text.replace(/\n/g, '<br>');
        
        // Convert **bold** to <strong>
        text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        
        // Convert bullet points
        text = text.replace(/^[•\-\*]\s/gm, '<br>• ');
        
        return text;
    }
});
</script>

<style>
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}
</style>