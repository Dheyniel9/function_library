@extends('layouts.app')

@section('title', 'Notification')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Toast Notifications</h1>

        <!-- Notification Buttons -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <button onclick="showNotification('success', 'Success!', 'Operation completed successfully.')"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Success
            </button>
            <button onclick="showNotification('error', 'Error!', 'Something went wrong.')"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                Error
            </button>
            <button onclick="showNotification('warning', 'Warning!', 'Please check your input.')"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Warning
            </button>
            <button onclick="showNotification('info', 'Info', 'Here is some information.')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Info
            </button>
        </div>

        <!-- Custom Notification Form -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Custom Notification</h2>
            <form id="customNotificationForm" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                        <select id="notificationType" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500">
                            <option value="success">Success</option>
                            <option value="error">Error</option>
                            <option value="warning">Warning</option>
                            <option value="info">Info</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Duration (ms)</label>
                        <input type="number" id="notificationDuration" value="5000" min="1000" max="10000"
                               class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" id="notificationTitle" placeholder="Notification Title"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                    <textarea id="notificationMessage" placeholder="Notification message..."
                              class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" rows="3"></textarea>
                </div>
                <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded">
                    Show Custom Notification
                </button>
            </form>
        </div>

        <!-- Notification Settings -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Notification Settings</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Position</span>
                    <select id="notificationPosition" class="px-3 py-2 border rounded">
                        <option value="top-right">Top Right</option>
                        <option value="top-left">Top Left</option>
                        <option value="bottom-right">Bottom Right</option>
                        <option value="bottom-left">Bottom Left</option>
                        <option value="top-center">Top Center</option>
                        <option value="bottom-center">Bottom Center</option>
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Sound</span>
                    <label class="flex items-center">
                        <input type="checkbox" id="notificationSound" class="mr-2">
                        <span class="text-sm">Enable sound</span>
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Auto Close</span>
                    <label class="flex items-center">
                        <input type="checkbox" id="autoClose" checked class="mr-2">
                        <span class="text-sm">Auto close notifications</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notification-container" class="fixed top-4 right-4 z-50 space-y-2">
        <!-- Notifications will appear here -->
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">JavaScript Code:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// Notification System
class NotificationManager {
    constructor() {
        this.container = document.getElementById('notification-container');
        this.notifications = [];
        this.settings = {
            position: 'top-right',
            sound: false,
            autoClose: true,
            defaultDuration: 5000
        };
    }

    show(type, title, message, duration = this.settings.defaultDuration) {
        const notification = this.create(type, title, message, duration);
        this.container.appendChild(notification);

        // Animate in
        setTimeout(() => notification.classList.add('translate-x-0'), 10);

        // Auto close
        if (this.settings.autoClose) {
            setTimeout(() => this.remove(notification), duration);
        }

        // Play sound
        if (this.settings.sound) {
            this.playSound(type);
        }
    }

    create(type, title, message, duration) {
        const notification = document.createElement('div');
        notification.className = `
            transform translate-x-full transition-transform duration-300 ease-in-out
            max-w-sm w-full bg-white border-l-4 rounded-lg shadow-lg p-4 mb-2
            ${this.getTypeClasses(type)}
        `;

        notification.innerHTML = `
            &lt;div class="flex items-start"&gt;
                &lt;div class="flex-shrink-0"&gt;
                    ${this.getIcon(type)}
                &lt;/div&gt;
                &lt;div class="ml-3 flex-1"&gt;
                    &lt;h4 class="text-sm font-semibold text-gray-800"&gt;${title}&lt;/h4&gt;
                    &lt;p class="text-sm text-gray-600 mt-1"&gt;${message}&lt;/p&gt;
                &lt;/div&gt;
                &lt;button onclick="notificationManager.remove(this.parentElement.parentElement)"
                        class="ml-4 text-gray-400 hover:text-gray-600"&gt;
                    &lt;svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"&gt;
                        &lt;path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"&gt;&lt;/path&gt;
                    &lt;/svg&gt;
                &lt;/button&gt;
            &lt;/div&gt;
        `;

        return notification;
    }

    getTypeClasses(type) {
        const classes = {
            success: 'border-green-500',
            error: 'border-red-500',
            warning: 'border-yellow-500',
            info: 'border-blue-500'
        };
        return classes[type] || classes.info;
    }

    remove(notification) {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }
}

const notificationManager = new NotificationManager();

function showNotification(type, title, message) {
    notificationManager.show(type, title, message);
}
        </code></pre>
    </div>
</div>

<script>
// Notification System
class NotificationManager {
    constructor() {
        this.container = document.getElementById('notification-container');
        this.notifications = [];
        this.settings = {
            position: 'top-right',
            sound: false,
            autoClose: true,
            defaultDuration: 5000
        };
        this.updatePosition();
        this.bindEvents();
    }

    show(type, title, message, duration = this.settings.defaultDuration) {
        const notification = this.create(type, title, message, duration);
        this.container.appendChild(notification);

        // Animate in
        setTimeout(() => notification.classList.add('translate-x-0'), 10);

        // Auto close
        if (this.settings.autoClose) {
            setTimeout(() => this.remove(notification), duration);
        }

        // Play sound
        if (this.settings.sound) {
            this.playSound(type);
        }
    }

    create(type, title, message, duration) {
        const notification = document.createElement('div');
        notification.className = `
            transform translate-x-full transition-transform duration-300 ease-in-out
            max-w-sm w-full bg-white border-l-4 rounded-lg shadow-lg p-4 mb-2
            ${this.getTypeClasses(type)}
        `;

        notification.innerHTML = `
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    ${this.getIcon(type)}
                </div>
                <div class="ml-3 flex-1">
                    <h4 class="text-sm font-semibold text-gray-800">${title}</h4>
                    <p class="text-sm text-gray-600 mt-1">${message}</p>
                </div>
                <button onclick="notificationManager.remove(this.parentElement.parentElement)"
                        class="ml-4 text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path>
                    </svg>
                </button>
            </div>
        `;

        return notification;
    }

    getTypeClasses(type) {
        const classes = {
            success: 'border-green-500',
            error: 'border-red-500',
            warning: 'border-yellow-500',
            info: 'border-blue-500'
        };
        return classes[type] || classes.info;
    }

    getIcon(type) {
        const icons = {
            success: '<svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>',
            error: '<svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"></path></svg>',
            warning: '<svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"></path></svg>',
            info: '<svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"></path></svg>'
        };
        return icons[type] || icons.info;
    }

    remove(notification) {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }

    updatePosition() {
        const position = this.settings.position;
        const positions = {
            'top-right': 'top-4 right-4',
            'top-left': 'top-4 left-4',
            'bottom-right': 'bottom-4 right-4',
            'bottom-left': 'bottom-4 left-4',
            'top-center': 'top-4 left-1/2 transform -translate-x-1/2',
            'bottom-center': 'bottom-4 left-1/2 transform -translate-x-1/2'
        };

        this.container.className = `fixed ${positions[position]} z-50 space-y-2`;
    }

    bindEvents() {
        // Position change
        document.getElementById('notificationPosition').addEventListener('change', (e) => {
            this.settings.position = e.target.value;
            this.updatePosition();
        });

        // Sound toggle
        document.getElementById('notificationSound').addEventListener('change', (e) => {
            this.settings.sound = e.target.checked;
        });

        // Auto close toggle
        document.getElementById('autoClose').addEventListener('change', (e) => {
            this.settings.autoClose = e.target.checked;
        });

        // Custom notification form
        document.getElementById('customNotificationForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const type = document.getElementById('notificationType').value;
            const title = document.getElementById('notificationTitle').value || 'Notification';
            const message = document.getElementById('notificationMessage').value || 'Custom notification message';
            const duration = parseInt(document.getElementById('notificationDuration').value);

            this.show(type, title, message, duration);
        });
    }

    playSound(type) {
        // Simple beep sound using Web Audio API
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();

        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);

        const frequencies = {
            success: 800,
            error: 300,
            warning: 600,
            info: 400
        };

        oscillator.frequency.value = frequencies[type] || 400;
        oscillator.type = 'sine';

        gainNode.gain.setValueAtTime(0, audioContext.currentTime);
        gainNode.gain.linearRampToValueAtTime(0.1, audioContext.currentTime + 0.01);
        gainNode.gain.linearRampToValueAtTime(0, audioContext.currentTime + 0.1);

        oscillator.start(audioContext.currentTime);
        oscillator.stop(audioContext.currentTime + 0.1);
    }
}

const notificationManager = new NotificationManager();

function showNotification(type, title, message) {
    notificationManager.show(type, title, message);
}
</script>
@endsection
