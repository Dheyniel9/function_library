<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Library - @yield('title', 'Home')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @yield('extra-css')
    <style>
        /* Custom transition for smoother animations */
        .sidebar-transition {
            transition: width 300ms cubic-bezier(0.4, 0, 0.2, 1), transform 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        .content-transition {
            transition: margin-left 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Improved text animations */
        .text-fade-enter {
            animation: textFadeIn 200ms ease-out forwards;
        }

        .text-fade-leave {
            animation: textFadeOut 150ms ease-in forwards;
        }

        @keyframes textFadeIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes textFadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(-10px);
            }
        }

        /* Hover effects for collapsed state */
        .sidebar-item-collapsed {
            position: relative;
        }

        .sidebar-tooltip {
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 12px;
            background: #1f2937;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 200ms ease, visibility 200ms ease;
            z-index: 1000;
            pointer-events: none;
        }

        .sidebar-tooltip::before {
            content: '';
            position: absolute;
            right: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-right-color: #1f2937;
        }

        .sidebar-item-collapsed:hover .sidebar-tooltip {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen" x-data="{ sidebarOpen: false, sidebarCollapsed: false, notifications: [] }">
    <!-- Mobile menu button -->
    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden fixed top-4 left-4 z-50 p-3 bg-white rounded-lg shadow-lg hover:bg-gray-50 transition-colors">
        <svg class="w-6 h-6 transform transition-transform duration-200" :class="{'rotate-90': sidebarOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-show="!sidebarOpen" d="M4 6h16M4 12h16M4 18h16"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-show="sidebarOpen" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-40 bg-white shadow-lg sidebar-transition"
         :class="{
             'w-64 translate-x-0': !sidebarCollapsed && (sidebarOpen || window.innerWidth >= 768),
             'w-16 translate-x-0': sidebarCollapsed && (sidebarOpen || window.innerWidth >= 768),
             'w-64 translate-x-0': sidebarOpen && window.innerWidth < 768,
             'w-64 -translate-x-full': !sidebarOpen && window.innerWidth < 768
         }"
         @click.away="if (window.innerWidth < 768) sidebarOpen = false">

        <!-- Sidebar Header -->
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <!-- Header content with improved animations -->
            <div class="overflow-hidden">
                <div x-show="!sidebarCollapsed"
                     x-transition:enter="transition-all duration-300 delay-100"
                     x-transition:enter-start="opacity-0 transform translate-x-4"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition-all duration-200"
                     x-transition:leave-start="opacity-100 transform translate-x-0"
                     x-transition:leave-end="opacity-0 transform translate-x-4">
                    <h1 class="text-xl font-bold text-gray-800">Function Library</h1>
                    <p class="text-sm text-gray-600">30+ Useful Functions</p>
                </div>
            </div>

            <!-- Collapse/Expand button for desktop -->
            <button @click="sidebarCollapsed = !sidebarCollapsed"
                    class="hidden md:block p-1.5 text-gray-500 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200">
                <svg class="w-5 h-5 transform transition-transform duration-300"
                     :class="{'rotate-180': sidebarCollapsed}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            </button>

            <!-- Close button for mobile -->
            <button @click="sidebarOpen = false" class="md:hidden p-1 text-gray-500 hover:text-gray-700 rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="p-4 space-y-2 overflow-y-auto h-full pb-20" :class="{'px-2': sidebarCollapsed}">
            <!-- Dashboard link -->
            <a href="{{ route('functions.index') }}"
               class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
               :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
               @click="if (window.innerWidth < 768) sidebarOpen = false">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                <span x-show="!sidebarCollapsed"
                      x-transition:enter="transition-all duration-300 delay-100"
                      x-transition:enter-start="opacity-0 transform translate-x-2"
                      x-transition:enter-end="opacity-100 transform translate-x-0"
                      x-transition:leave="transition-all duration-150"
                      x-transition:leave-start="opacity-100 transform translate-x-0"
                      x-transition:leave-end="opacity-0 transform translate-x-2"
                      class="whitespace-nowrap">Dashboard</span>
                <!-- Tooltip for collapsed state -->
                <div x-show="sidebarCollapsed" class="sidebar-tooltip">Dashboard</div>
            </a>

            <!-- UI Components Section -->
            <div class="pt-4">
                <!-- Section header with improved animation -->
                <div class="overflow-hidden">
                    <h3 x-show="!sidebarCollapsed"
                        x-transition:enter="transition-all duration-300 delay-150"
                        x-transition:enter-start="opacity-0 transform translate-x-2"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition-all duration-150"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform translate-x-2"
                        class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 px-2">UI Components</h3>
                </div>
                <div x-show="sidebarCollapsed" class="border-t border-gray-200 my-2 transition-opacity duration-300"></div>

                <!-- Navigation items with staggered animations -->
                <a href="{{ route('functions.accordion') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[175ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Accordion</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Accordion</div>
                </a>

                <a href="{{ route('functions.modal') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-200"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Modal</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Modal</div>
                </a>

                <a href="{{ route('functions.tabs') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[225ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Tabs</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Tabs</div>
                </a>

                <a href="{{ route('functions.tooltip') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[250ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Tooltip</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Tooltip</div>
                </a>
            </div>

            <!-- Data & Forms -->
            <div class="pt-4">
                <div class="overflow-hidden">
                    <h3 x-show="!sidebarCollapsed"
                        x-transition:enter="transition-all duration-300 delay-[275ms]"
                        x-transition:enter-start="opacity-0 transform translate-x-2"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition-all duration-150"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform translate-x-2"
                        class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 px-2">Data & Forms</h3>
                </div>
                <div x-show="sidebarCollapsed" class="border-t border-gray-200 my-2 transition-opacity duration-300"></div>

                <a href="{{ route('functions.data-table') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-300"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Data Table</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Data Table</div>
                </a>

                <a href="{{ route('functions.form-validation') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[325ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Form Validation</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Form Validation</div>
                </a>

                <a href="{{ route('functions.multi-step-form') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[350ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Multi-Step Form</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Multi-Step Form</div>
                </a>
            </div>

            <!-- Features -->
            <div class="pt-4">
                <div class="overflow-hidden">
                    <h3 x-show="!sidebarCollapsed"
                        x-transition:enter="transition-all duration-300 delay-[375ms]"
                        x-transition:enter-start="opacity-0 transform translate-x-2"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition-all duration-150"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform translate-x-2"
                        class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 px-2">Features</h3>
                </div>
                <div x-show="sidebarCollapsed" class="border-t border-gray-200 my-2 transition-opacity duration-300"></div>

                <a href="{{ route('functions.dashboard') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-400"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Analytics Dashboard</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Analytics Dashboard</div>
                </a>

                <a href="{{ route('functions.real-time-chat') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.959 8.959 0 01-4.906-1.471L3 21l2.529-5.094A8.959 8.959 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[425ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Real-Time Chat</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Real-Time Chat</div>
                </a>

                <a href="{{ route('functions.image-editor') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[450ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Image Editor</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Image Editor</div>
                </a>

                <a href="{{ route('functions.api-testing') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[475ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">API Testing</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">API Testing</div>
                </a>

                <a href="{{ route('functions.progress-tracker') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-500"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Progress Tracker</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Progress Tracker</div>
                </a>
            </div>

            <!-- Utilities -->
            <div class="pt-4">
                <div class="overflow-hidden">
                    <h3 x-show="!sidebarCollapsed"
                        x-transition:enter="transition-all duration-300 delay-[525ms]"
                        x-transition:enter-start="opacity-0 transform translate-x-2"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition-all duration-150"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform translate-x-2"
                        class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 px-2">Utilities</h3>
                </div>
                <div x-show="sidebarCollapsed" class="border-t border-gray-200 my-2 transition-opacity duration-300"></div>

                <a href="{{ route('functions.calculator') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[550ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Calculator</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Calculator</div>
                </a>

                <a href="{{ route('functions.qr-generator') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[575ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">QR Generator</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">QR Generator</div>
                </a>

                <a href="{{ route('functions.color-picker') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3H5v12a2 2 0 002 2h2V3zm0 0h2m6 0v18m4-8V9a2 2 0 00-2-2h-2m0 0V3m0 4h2m-6 0h2v4H9V7z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-600"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Color Picker</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Color Picker</div>
                </a>
                <a href="{{ route('functions.card-designs') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-600"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Card Designs</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Card Designs</div>
                </a>
            </div>

            <!-- Container Utilities -->
            <div class="pt-4">
                <div class="overflow-hidden">
                    <h3 x-show="!sidebarCollapsed"
                        x-transition:enter="transition-all duration-300 delay-[625ms]"
                        x-transition:enter-start="opacity-0 transform translate-x-2"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition-all duration-150"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform translate-x-2"
                        class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 px-2">Container Utilities</h3>
                </div>
                <div x-show="sidebarCollapsed" class="border-t border-gray-200 my-2 transition-opacity duration-300"></div>

                <a href="{{ route('functions.container-layouts') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[650ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Container Layouts</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Container Layouts</div>
                </a>

                <a href="{{ route('functions.flexbox-container') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[675ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Flexbox Container</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Flexbox Container</div>
                </a>

                <a href="{{ route('functions.grid-container') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-700"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Grid Container</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Grid Container</div>
                </a>

                <a href="{{ route('functions.responsive-container') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[725ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Responsive Container</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Responsive Container</div>
                </a>
            </div>

            <!-- Table Utilities -->
            <div class="pt-4">
                <div class="overflow-hidden">
                    <h3 x-show="!sidebarCollapsed"
                        x-transition:enter="transition-all duration-300 delay-[750ms]"
                        x-transition:enter-start="opacity-0 transform translate-x-2"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition-all duration-150"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform translate-x-2"
                        class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 px-2">Table Utilities</h3>
                </div>
                <div x-show="sidebarCollapsed" class="border-t border-gray-200 my-2 transition-opacity duration-300"></div>

                <a href="{{ route('functions.advanced-table') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[775ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Advanced Table</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Advanced Table</div>
                </a>

                <a href="{{ route('functions.editable-table') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-800"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Editable Table</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Editable Table</div>
                </a>

                <a href="{{ route('functions.comparison-table') }}"
                   class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-all duration-200 group relative"
                   :class="sidebarCollapsed ? 'justify-center sidebar-item-collapsed' : 'space-x-3'"
                   @click="if (window.innerWidth < 768) sidebarOpen = false">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed"
                          x-transition:enter="transition-all duration-300 delay-[825ms]"
                          x-transition:enter-start="opacity-0 transform translate-x-2"
                          x-transition:enter-end="opacity-100 transform translate-x-0"
                          x-transition:leave="transition-all duration-150"
                          x-transition:leave-start="opacity-100 transform translate-x-0"
                          x-transition:leave-end="opacity-0 transform translate-x-2"
                          class="whitespace-nowrap">Comparison Table</span>
                    <div x-show="sidebarCollapsed" class="sidebar-tooltip">Comparison Table</div>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content with improved transition -->
    <div class="content-transition"
         :class="{
             'md:ml-64': !sidebarCollapsed,
             'md:ml-16': sidebarCollapsed
         }">
        <!-- Top Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200 px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <!-- Mobile hamburger for smaller screens -->
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h2 class="text-lg font-semibold text-gray-800">@yield('title', 'Home')</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <button onclick="showNotification('info', 'Welcome to Function Library!')" class="text-gray-600 hover:text-gray-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="p-4 lg:p-8">
            @yield('content')
        </main>
    </div>

    <!-- Rest of the HTML remains the same... -->
    <!-- Notification Container, Overlay, Scripts, etc. -->

    @yield('extra-js')
</body>
</html>
