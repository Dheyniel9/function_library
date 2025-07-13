@extends('layouts.app')

@section('title', 'Real-Time Chat')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 text-white p-4">
            <h1 class="text-2xl font-bold">Real-Time Chat</h1>
            <p class="text-blue-100">Connect and chat with other users in real-time</p>
        </div>

        <div class="flex h-96">
            <!-- Users List -->
            <div class="w-1/4 bg-gray-50 border-r border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="font-semibold text-gray-800">Online Users</h2>
                    <div class="flex items-center mt-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600" id="userCount">3 users online</span>
                    </div>
                </div>
                <div id="usersList" class="p-4 space-y-2">
                    <!-- Users will be populated here -->
                </div>
            </div>

            <!-- Chat Area -->
            <div class="flex-1 flex flex-col">
                <!-- Chat Header -->
                <div class="p-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="font-semibold text-gray-800" id="chatTitle">General Chat</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="clearChat()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a3 3 0 003 3h2a3 3 0 003-3V3a2 2 0 012 2v6.5l1.5 1.5A2 2 0 0119 12v4a2 2 0 01-2 2H3a2 2 0 01-2-2v-4a2 2 0 01.5-1.5L3 10.5V5z"></path>
                                </svg>
                            </button>
                            <button onclick="toggleNotifications()" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Messages Container -->
                <div id="messagesContainer" class="flex-1 overflow-y-auto p-4 space-y-4">
                    <!-- Messages will be populated here -->
                </div>

                <!-- Typing Indicator -->
                <div id="typingIndicator" class="px-4 py-2 text-sm text-gray-500 hidden">
                    <span id="typingText">Someone is typing...</span>
                </div>

                <!-- Message Input -->
                <div class="p-4 border-t border-gray-200">
                    <div class="flex items-center space-x-2">
                        <button onclick="toggleEmoji()" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"></path>
                            </svg>
                        </button>
                        <input type="text" id="messageInput" placeholder="Type your message..."
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-blue-500">
                        <button onclick="sendMessage()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Emoji Picker -->
                    <div id="emojiPicker" class="absolute bottom-16 bg-white border border-gray-200 rounded-lg p-4 hidden shadow-lg">
                        <div class="grid grid-cols-8 gap-2">
                            <button onclick="insertEmoji('😀')" class="hover:bg-gray-100 p-2 rounded">😀</button>
                            <button onclick="insertEmoji('😂')" class="hover:bg-gray-100 p-2 rounded">😂</button>
                            <button onclick="insertEmoji('😍')" class="hover:bg-gray-100 p-2 rounded">😍</button>
                            <button onclick="insertEmoji('🤔')" class="hover:bg-gray-100 p-2 rounded">🤔</button>
                            <button onclick="insertEmoji('👍')" class="hover:bg-gray-100 p-2 rounded">👍</button>
                            <button onclick="insertEmoji('👎')" class="hover:bg-gray-100 p-2 rounded">👎</button>
                            <button onclick="insertEmoji('❤️')" class="hover:bg-gray-100 p-2 rounded">❤️</button>
                            <button onclick="insertEmoji('🔥')" class="hover:bg-gray-100 p-2 rounded">🔥</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Connection Status -->
        <div class="bg-gray-50 px-4 py-2 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div id="connectionStatus" class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-600" id="connectionText">Connected</span>
                </div>
                <div class="text-sm text-gray-500">
                    <span id="messageCount">0 messages</span>
                </div>
            </div>
        </div>
    </div>

    <!-- User Setup Modal -->
    <div id="userSetupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-xl font-semibold mb-4">Join the Chat</h2>
            <form id="userSetupForm">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Your Name</label>
                    <input type="text" id="userName" required
                           class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Avatar</label>
                    <div class="flex space-x-2">
                        <button type="button" onclick="selectAvatar('👤')" class="avatar-btn p-2 border rounded hover:bg-gray-100">👤</button>
                        <button type="button" onclick="selectAvatar('👨')" class="avatar-btn p-2 border rounded hover:bg-gray-100">👨</button>
                        <button type="button" onclick="selectAvatar('👩')" class="avatar-btn p-2 border rounded hover:bg-gray-100">👩</button>
                        <button type="button" onclick="selectAvatar('🧑')" class="avatar-btn p-2 border rounded hover:bg-gray-100">🧑</button>
                    </div>
                    <input type="hidden" id="selectedAvatar" value="👤">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
                    Join Chat
                </button>
            </form>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">WebSocket Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// Real-time Chat with WebSocket
class ChatApplication {
    constructor() {
        this.currentUser = null;
        this.messages = [];
        this.users = [];
        this.socket = null;
        this.init();
    }

    init() {
        this.bindEvents();
        this.simulateConnection();
    }

    // WebSocket connection (simulated)
    connectWebSocket() {
        // In a real application, connect to WebSocket server
        // this.socket = new WebSocket('ws://localhost:8080');

        this.socket = {
            send: (data) => {
                // Simulate sending message
                console.log('Sending:', data);
                this.handleIncomingMessage(JSON.parse(data));
            }
        };
    }

    sendMessage(message) {
        if (this.socket && this.currentUser) {
            const messageData = {
                type: 'message',
                user: this.currentUser,
                message: message,
                timestamp: new Date().toISOString()
            };

            this.socket.send(JSON.stringify(messageData));
        }
    }

    handleIncomingMessage(data) {
        switch(data.type) {
            case 'message':
                this.addMessage(data);
                break;
            case 'user_joined':
                this.addUser(data.user);
                break;
            case 'user_left':
                this.removeUser(data.user);
                break;
            case 'typing':
                this.showTypingIndicator(data.user);
                break;
        }
    }

    addMessage(messageData) {
        this.messages.push(messageData);
        this.renderMessage(messageData);
        this.scrollToBottom();
    }
}

// Initialize chat application
const chatApp = new ChatApplication();
        </code></pre>
    </div>
</div>

<script>
class ChatApplication {
    constructor() {
        this.currentUser = null;
        this.messages = [];
        this.users = ['John Doe', 'Jane Smith', 'Bob Johnson'];
        this.messageCount = 0;
        this.notificationsEnabled = true;
        this.init();
    }

    init() {
        this.bindEvents();
        this.renderUsers();
        this.simulateMessages();
    }

    bindEvents() {
        document.getElementById('userSetupForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.joinChat();
        });

        document.getElementById('messageInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.sendMessage();
            }
        });

        document.getElementById('messageInput').addEventListener('input', () => {
            this.handleTyping();
        });
    }

    joinChat() {
        const name = document.getElementById('userName').value;
        const avatar = document.getElementById('selectedAvatar').value;

        if (name.trim()) {
            this.currentUser = { name, avatar, id: Date.now() };
            document.getElementById('userSetupModal').classList.add('hidden');
            this.addSystemMessage(`${name} joined the chat`);
            this.users.push(name);
            this.renderUsers();
        }
    }

    sendMessage() {
        const input = document.getElementById('messageInput');
        const message = input.value.trim();

        if (message && this.currentUser) {
            const messageData = {
                user: this.currentUser,
                message: message,
                timestamp: new Date(),
                id: Date.now()
            };

            this.addMessage(messageData);
            input.value = '';

            // Simulate response
            setTimeout(() => {
                this.simulateResponse(message);
            }, 1000 + Math.random() * 2000);
        }
    }

    addMessage(messageData) {
        this.messages.push(messageData);
        this.renderMessage(messageData);
        this.scrollToBottom();
        this.updateMessageCount();

        if (this.notificationsEnabled && messageData.user.name !== this.currentUser?.name) {
            this.showNotification(messageData);
        }
    }

    addSystemMessage(message) {
        const systemMessage = {
            user: { name: 'System', avatar: '🤖' },
            message: message,
            timestamp: new Date(),
            id: Date.now(),
            isSystem: true
        };

        this.addMessage(systemMessage);
    }

    renderMessage(messageData) {
        const container = document.getElementById('messagesContainer');
        const isOwnMessage = messageData.user.name === this.currentUser?.name;

        const messageElement = document.createElement('div');
        messageElement.className = `flex ${isOwnMessage ? 'justify-end' : 'justify-start'} ${messageData.isSystem ? 'justify-center' : ''}`;

        if (messageData.isSystem) {
            messageElement.innerHTML = `
                <div class="bg-gray-200 text-gray-600 px-4 py-2 rounded-full text-sm">
                    ${messageData.message}
                </div>
            `;
        } else {
            messageElement.innerHTML = `
                <div class="flex items-end space-x-2 max-w-xs lg:max-w-md ${isOwnMessage ? 'flex-row-reverse space-x-reverse' : ''}">
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-sm">
                        ${messageData.user.avatar}
                    </div>
                    <div class="${isOwnMessage ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'} px-4 py-2 rounded-lg">
                        <div class="font-semibold text-xs mb-1">${messageData.user.name}</div>
                        <div>${messageData.message}</div>
                        <div class="text-xs mt-1 ${isOwnMessage ? 'text-blue-100' : 'text-gray-500'}">
                            ${messageData.timestamp.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                        </div>
                    </div>
                </div>
            `;
        }

        container.appendChild(messageElement);
    }

    renderUsers() {
        const usersList = document.getElementById('usersList');
        usersList.innerHTML = '';

        this.users.forEach(user => {
            const userElement = document.createElement('div');
            userElement.className = 'flex items-center space-x-2 p-2 hover:bg-gray-100 rounded';
            userElement.innerHTML = `
                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                <span class="text-sm">${user}</span>
            `;
            usersList.appendChild(userElement);
        });

        document.getElementById('userCount').textContent = `${this.users.length} users online`;
    }

    simulateMessages() {
        const sampleMessages = [
            { user: { name: 'John Doe', avatar: '👨' }, message: 'Hello everyone!', timestamp: new Date(Date.now() - 300000) },
            { user: { name: 'Jane Smith', avatar: '👩' }, message: 'How is everyone doing today?', timestamp: new Date(Date.now() - 240000) },
            { user: { name: 'Bob Johnson', avatar: '👤' }, message: 'Great! Just finished a new project.', timestamp: new Date(Date.now() - 180000) }
        ];

        sampleMessages.forEach(msg => {
            this.addMessage(msg);
        });
    }

    simulateResponse(originalMessage) {
        const responses = [
            'That\'s interesting!',
            'I agree with that.',
            'Thanks for sharing!',
            'Good point!',
            'I hadn\'t thought of that.',
            'Nice! 👍'
        ];

        const randomUser = this.users[Math.floor(Math.random() * this.users.length)];
        const randomResponse = responses[Math.floor(Math.random() * responses.length)];

        if (randomUser !== this.currentUser?.name) {
            const responseMessage = {
                user: { name: randomUser, avatar: '👤' },
                message: randomResponse,
                timestamp: new Date(),
                id: Date.now()
            };

            this.addMessage(responseMessage);
        }
    }

    handleTyping() {
        if (this.currentUser) {
            this.showTypingIndicator(this.currentUser);
        }
    }

    showTypingIndicator(user) {
        const indicator = document.getElementById('typingIndicator');
        const text = document.getElementById('typingText');

        if (user.name !== this.currentUser?.name) {
            text.textContent = `${user.name} is typing...`;
            indicator.classList.remove('hidden');

            clearTimeout(this.typingTimeout);
            this.typingTimeout = setTimeout(() => {
                indicator.classList.add('hidden');
            }, 3000);
        }
    }

    scrollToBottom() {
        const container = document.getElementById('messagesContainer');
        container.scrollTop = container.scrollHeight;
    }

    updateMessageCount() {
        this.messageCount++;
        document.getElementById('messageCount').textContent = `${this.messageCount} messages`;
    }

    showNotification(messageData) {
        if (Notification.permission === 'granted') {
            new Notification(`${messageData.user.name}`, {
                body: messageData.message,
                icon: '/favicon.ico'
            });
        }
    }

    clearChat() {
        document.getElementById('messagesContainer').innerHTML = '';
        this.messages = [];
        this.messageCount = 0;
        this.updateMessageCount();
    }

    toggleNotifications() {
        this.notificationsEnabled = !this.notificationsEnabled;

        if (this.notificationsEnabled && Notification.permission !== 'granted') {
            Notification.requestPermission();
        }
    }
}

// Global functions
function selectAvatar(avatar) {
    document.getElementById('selectedAvatar').value = avatar;
    document.querySelectorAll('.avatar-btn').forEach(btn => btn.classList.remove('bg-blue-100'));
    event.target.classList.add('bg-blue-100');
}

function sendMessage() {
    chatApp.sendMessage();
}

function clearChat() {
    chatApp.clearChat();
}

function toggleNotifications() {
    chatApp.toggleNotifications();
}

function toggleEmoji() {
    const picker = document.getElementById('emojiPicker');
    picker.classList.toggle('hidden');
}

function insertEmoji(emoji) {
    const input = document.getElementById('messageInput');
    input.value += emoji;
    input.focus();
    document.getElementById('emojiPicker').classList.add('hidden');
}

// Initialize chat application
const chatApp = new ChatApplication();

// Request notification permission
if (Notification.permission === 'default') {
    Notification.requestPermission();
}
</script>
@endsection
