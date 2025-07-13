<!-- Notification Component -->
<!-- Include this in your Blade templates for easy notification management -->

<div id="notification-container" class="fixed top-4 right-4 z-50 space-y-2">
    <!-- Notifications will be inserted here -->
</div>

<script>
// Enhanced Notification System
class NotificationManager {
    constructor() {
        this.container = document.getElementById('notification-container');
        this.notifications = [];
        this.maxNotifications = 5;
    }

    show(type, message, duration = 5000, options = {}) {
        const notification = this.createNotification(type, message, options);

        // Add to notifications array
        this.notifications.push(notification);

        // Remove oldest if exceeding max
        if (this.notifications.length > this.maxNotifications) {
            this.remove(this.notifications[0]);
        }

        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
            notification.classList.add('translate-x-0');
        }, 100);

        // Auto remove if duration is set
        if (duration > 0) {
            setTimeout(() => {
                this.remove(notification);
            }, duration);
        }

        return notification;
    }

    createNotification(type, message, options = {}) {
        const notification = document.createElement('div');
        const id = 'notification-' + Date.now();
        notification.id = id;

        const colors = {
            success: 'bg-green-500 border-green-600',
            error: 'bg-red-500 border-red-600',
            warning: 'bg-yellow-500 border-yellow-600',
            info: 'bg-blue-500 border-blue-600'
        };

        const icons = {
            success: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>`,
            error: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>`,
            warning: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>`,
            info: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>`
        };

        notification.className = `${colors[type]} text-white p-4 rounded-lg shadow-lg border-l-4 min-w-80 max-w-96 transform transition-all duration-300 translate-x-full`;

        const actionButtons = options.actions ? options.actions.map(action =>
            `<button onclick="${action.handler}" class="ml-2 px-3 py-1 text-xs bg-white bg-opacity-20 rounded hover:bg-opacity-30 transition-colors">
                ${action.text}
            </button>`
        ).join('') : '';

        notification.innerHTML = `
            <div class="flex items-start justify-between">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        ${icons[type]}
                    </div>
                    <div class="flex-1">
                        ${options.title ? `<div class="font-semibold text-sm">${options.title}</div>` : ''}
                        <div class="text-sm">${message}</div>
                        ${actionButtons}
                    </div>
                </div>
                <button onclick="notificationManager.remove(document.getElementById('${id}'))" class="ml-4 text-white hover:text-gray-200 flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

        this.container.appendChild(notification);
        return notification;
    }

    remove(notification) {
        if (!notification || !notification.parentElement) return;

        notification.classList.add('translate-x-full');
        notification.classList.remove('translate-x-0');

        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);

        // Remove from notifications array
        this.notifications = this.notifications.filter(n => n !== notification);
    }

    clear() {
        this.notifications.forEach(notification => {
            this.remove(notification);
        });
    }

    // Convenience methods
    success(message, options = {}) {
        return this.show('success', message, options.duration || 5000, options);
    }

    error(message, options = {}) {
        return this.show('error', message, options.duration || 8000, options);
    }

    warning(message, options = {}) {
        return this.show('warning', message, options.duration || 6000, options);
    }

    info(message, options = {}) {
        return this.show('info', message, options.duration || 5000, options);
    }

    // Persistent notifications (no auto-remove)
    persistent(type, message, options = {}) {
        return this.show(type, message, 0, options);
    }
}

// Initialize notification manager
const notificationManager = new NotificationManager();

// Global notification functions for backward compatibility
window.showSuccess = (message, options) => notificationManager.success(message, options);
window.showError = (message, options) => notificationManager.error(message, options);
window.showWarning = (message, options) => notificationManager.warning(message, options);
window.showInfo = (message, options) => notificationManager.info(message, options);
window.clearNotifications = () => notificationManager.clear();

// Additional helper functions
window.showFormValidation = (errors) => {
    const errorList = Array.isArray(errors) ? errors : [errors];
    const message = errorList.length > 1 ?
        `Multiple errors found:<br>${errorList.map(e => `• ${e}`).join('<br>')}` :
        errorList[0];

    return notificationManager.error(message, {
        title: 'Validation Error',
        duration: 8000
    });
};

window.showApiError = (error) => {
    const message = error.response?.data?.message || error.message || 'An unexpected error occurred';
    return notificationManager.error(message, {
        title: 'API Error',
        duration: 8000
    });
};

window.showActionSuccess = (action) => {
    return notificationManager.success(`${action} completed successfully!`, {
        duration: 4000
    });
};

window.showConfirmation = (message, onConfirm, onCancel) => {
    return notificationManager.persistent('warning', message, {
        title: 'Confirmation Required',
        actions: [
            { text: 'Confirm', handler: `${onConfirm}(); notificationManager.remove(this.closest('.bg-yellow-500'));` },
            { text: 'Cancel', handler: `${onCancel ? onCancel + '();' : ''} notificationManager.remove(this.closest('.bg-yellow-500'));` }
        ]
    });
};
</script>
