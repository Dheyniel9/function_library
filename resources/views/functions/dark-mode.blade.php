@extends('layouts.app')

@section('title', 'Dark Mode')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Dark Mode Toggle</h1>

        <!-- Dark Mode Toggle Controls -->
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-8 transition-colors duration-300">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Theme Controls</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Toggle Switch -->
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-3">Toggle Switch</h3>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="darkModeToggle" class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Dark Mode</span>
                    </label>
                </div>

                <!-- Button Toggle -->
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-3">Button Toggle</h3>
                    <button id="themeButton" onclick="toggleTheme()"
                            class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors duration-300 flex items-center mx-auto">
                        <svg id="sunIcon" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
                        </svg>
                        <svg id="moonIcon" class="w-5 h-5 mr-2 hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <span id="buttonText">Dark Mode</span>
                    </button>
                </div>

                <!-- Dropdown Theme Selector -->
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-3">Theme Selector</h3>
                    <select id="themeSelector" onchange="setTheme(this.value)"
                            class="bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 text-gray-700 dark:text-white px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
                        <option value="light">Light</option>
                        <option value="dark">Dark</option>
                        <option value="auto">Auto (System)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Theme Preview -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Sample Content -->
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Sample Content</h2>

                <!-- Card -->
                <div class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4 transition-colors duration-300">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-2">Sample Card</h3>
                    <p class="text-gray-600 dark:text-gray-300">This is how cards look in both light and dark modes. Notice how the colors transition smoothly.</p>
                    <button class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm transition-colors duration-300">
                        Sample Button
                    </button>
                </div>

                <!-- List -->
                <div class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg transition-colors duration-300">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white p-4 border-b border-gray-200 dark:border-gray-600">Sample List</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                        <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-300">
                            <span class="text-gray-800 dark:text-white">List Item 1</span>
                        </li>
                        <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-300">
                            <span class="text-gray-800 dark:text-white">List Item 2</span>
                        </li>
                        <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-300">
                            <span class="text-gray-800 dark:text-white">List Item 3</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Form Example -->
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Sample Form</h2>

                <div class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4 transition-colors duration-300">
                    <form class="space-y-4">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Name</label>
                            <input type="text" placeholder="Enter your name"
                                   class="w-full px-3 py-2 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 text-gray-700 dark:text-white rounded focus:outline-none focus:border-blue-500 transition-colors duration-300">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email</label>
                            <input type="email" placeholder="Enter your email"
                                   class="w-full px-3 py-2 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 text-gray-700 dark:text-white rounded focus:outline-none focus:border-blue-500 transition-colors duration-300">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Message</label>
                            <textarea placeholder="Enter your message" rows="3"
                                      class="w-full px-3 py-2 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 text-gray-700 dark:text-white rounded focus:outline-none focus:border-blue-500 transition-colors duration-300"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded transition-colors duration-300">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Theme Settings -->
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 transition-colors duration-300">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Theme Settings</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-3">Preferences</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="savePreference" checked class="mr-2">
                            <span class="text-gray-700 dark:text-gray-300">Save theme preference</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" id="smoothTransition" checked class="mr-2">
                            <span class="text-gray-700 dark:text-gray-300">Smooth transitions</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" id="systemPreference" class="mr-2">
                            <span class="text-gray-700 dark:text-gray-300">Follow system preference</span>
                        </label>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-3">Current Status</h3>
                    <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <p>Current Theme: <span id="currentTheme" class="font-medium">Light</span></p>
                        <p>System Preference: <span id="systemTheme" class="font-medium">-</span></p>
                        <p>Saved Preference: <span id="savedTheme" class="font-medium">-</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6 mt-8 transition-colors duration-300">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Implementation Code:</h2>
        <pre class="bg-gray-800 dark:bg-gray-900 text-green-400 p-4 rounded overflow-x-auto transition-colors duration-300"><code>
// Dark Mode Implementation
class ThemeManager {
    constructor() {
        this.currentTheme = this.getStoredTheme() || 'light';
        this.init();
    }

    init() {
        this.applyTheme(this.currentTheme);
        this.updateUI();
        this.bindEvents();
        this.detectSystemTheme();
    }

    applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        this.currentTheme = theme;
    }

    toggleTheme() {
        const newTheme = this.currentTheme === 'light' ? 'dark' : 'light';
        this.applyTheme(newTheme);
        this.saveTheme(newTheme);
        this.updateUI();
    }

    saveTheme(theme) {
        localStorage.setItem('theme', theme);
    }

    getStoredTheme() {
        return localStorage.getItem('theme');
    }

    detectSystemTheme() {
        if (window.matchMedia) {
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            mediaQuery.addListener(this.handleSystemThemeChange.bind(this));
            return mediaQuery.matches ? 'dark' : 'light';
        }
        return 'light';
    }
}

// Usage
const themeManager = new ThemeManager();

// Toggle function
function toggleTheme() {
    themeManager.toggleTheme();
}
        </code></pre>
    </div>
</div>

<script>
class ThemeManager {
    constructor() {
        this.currentTheme = this.getStoredTheme() || this.detectSystemTheme();
        this.init();
    }

    init() {
        this.applyTheme(this.currentTheme);
        this.updateUI();
        this.bindEvents();
        this.updateStatus();
    }

    applyTheme(theme) {
        if (theme === 'auto') {
            const systemTheme = this.detectSystemTheme();
            theme = systemTheme;
        }

        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        this.currentTheme = theme;
    }

    toggleTheme() {
        const newTheme = this.currentTheme === 'light' ? 'dark' : 'light';
        this.setTheme(newTheme);
    }

    setTheme(theme) {
        this.applyTheme(theme);
        if (document.getElementById('savePreference').checked) {
            this.saveTheme(theme);
        }
        this.updateUI();
        this.updateStatus();
    }

    saveTheme(theme) {
        localStorage.setItem('theme', theme);
    }

    getStoredTheme() {
        return localStorage.getItem('theme');
    }

    detectSystemTheme() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }
        return 'light';
    }

    updateUI() {
        const isDark = this.currentTheme === 'dark';

        // Update toggle switch
        document.getElementById('darkModeToggle').checked = isDark;

        // Update button
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        const buttonText = document.getElementById('buttonText');

        if (isDark) {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
            buttonText.textContent = 'Light Mode';
        } else {
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
            buttonText.textContent = 'Dark Mode';
        }

        // Update selector
        document.getElementById('themeSelector').value = this.currentTheme;
    }

    updateStatus() {
        document.getElementById('currentTheme').textContent =
            this.currentTheme.charAt(0).toUpperCase() + this.currentTheme.slice(1);

        document.getElementById('systemTheme').textContent =
            this.detectSystemTheme().charAt(0).toUpperCase() + this.detectSystemTheme().slice(1);

        const saved = this.getStoredTheme();
        document.getElementById('savedTheme').textContent =
            saved ? saved.charAt(0).toUpperCase() + saved.slice(1) : 'None';
    }

    bindEvents() {
        // Toggle switch
        document.getElementById('darkModeToggle').addEventListener('change', (e) => {
            this.setTheme(e.target.checked ? 'dark' : 'light');
        });

        // System preference checkbox
        document.getElementById('systemPreference').addEventListener('change', (e) => {
            if (e.target.checked) {
                this.setTheme('auto');
                this.setupSystemListener();
            } else {
                this.removeSystemListener();
            }
        });

        // Smooth transition checkbox
        document.getElementById('smoothTransition').addEventListener('change', (e) => {
            const duration = e.target.checked ? '300ms' : '0ms';
            document.documentElement.style.setProperty('--transition-duration', duration);
        });
    }

    setupSystemListener() {
        if (window.matchMedia) {
            this.mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            this.mediaQueryListener = (e) => {
                if (document.getElementById('systemPreference').checked) {
                    this.setTheme('auto');
                }
            };
            this.mediaQuery.addListener(this.mediaQueryListener);
        }
    }

    removeSystemListener() {
        if (this.mediaQuery && this.mediaQueryListener) {
            this.mediaQuery.removeListener(this.mediaQueryListener);
        }
    }
}

// Initialize theme manager
const themeManager = new ThemeManager();

// Global functions
function toggleTheme() {
    themeManager.toggleTheme();
}

function setTheme(theme) {
    themeManager.setTheme(theme);
}

// Set initial CSS variable for transitions
document.documentElement.style.setProperty('--transition-duration', '300ms');
</script>

<style>
/* CSS for smooth transitions */
.transition-colors {
    transition-property: color, background-color, border-color;
    transition-duration: var(--transition-duration, 300ms);
    transition-timing-function: ease-in-out;
}

/* Dark mode styles */
.dark {
    color-scheme: dark;
}

/* Custom scrollbar for dark mode */
.dark ::-webkit-scrollbar {
    width: 8px;
}

.dark ::-webkit-scrollbar-track {
    background: #374151;
}

.dark ::-webkit-scrollbar-thumb {
    background: #6B7280;
    border-radius: 4px;
}

.dark ::-webkit-scrollbar-thumb:hover {
    background: #9CA3AF;
}
</style>
@endsection
