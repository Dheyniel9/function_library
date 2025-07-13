@extends('layouts.app')

@section('title', 'Function Library')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg p-8 mb-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Function Library</h1>
            <p class="text-xl mb-6">25 production-ready components and functions for your Laravel projects</p>
            <button onclick="showInfo('Explore the sidebar to discover all available functions!')"
                    class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition-colors">
                Get Started
            </button>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="text-3xl font-bold text-blue-600 mb-2">25</div>
            <div class="text-gray-600">Total Functions</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="text-3xl font-bold text-green-600 mb-2">100%</div>
            <div class="text-gray-600">Copy-Paste Ready</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="text-3xl font-bold text-purple-600 mb-2">5</div>
            <div class="text-gray-600">Categories</div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="text-3xl font-bold text-orange-600 mb-2">∞</div>
            <div class="text-gray-600">Possibilities</div>
        </div>
    </div>

    <!-- Featured Functions -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Featured Functions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center mb-4">
                    <svg class="w-8 h-8 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.959 8.959 0 01-4.906-1.471L3 21l2.529-5.094A8.959 8.959 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold">Real-Time Chat</h3>
                </div>
                <p class="text-gray-600 mb-4">Complete chat application with WebSocket simulation, emoji picker, and user management.</p>
                <a href="{{ route('functions.real-time-chat') }}" class="text-blue-500 hover:text-blue-600 font-medium">
                    Try it out →
                </a>
            </div>

            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center mb-4">
                    <svg class="w-8 h-8 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold">Image Editor</h3>
                </div>
                <p class="text-gray-600 mb-4">Browser-based image editing with filters, transformations, and effects.</p>
                <a href="{{ route('functions.image-editor') }}" class="text-green-500 hover:text-green-600 font-medium">
                    Try it out →
                </a>
            </div>

            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center mb-4">
                    <svg class="w-8 h-8 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold">Analytics Dashboard</h3>
                </div>
                <p class="text-gray-600 mb-4">Interactive dashboard with charts, metrics, and real-time data visualization.</p>
                <a href="{{ route('functions.dashboard') }}" class="text-purple-500 hover:text-purple-600 font-medium">
                    Try it out →
                </a>
            </div>
        </div>
    </div>

    <!-- All Functions Grid -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">All Functions</h2>
            <button onclick="showSuccess('All functions are accessible via the sidebar!')"
                    class="text-blue-500 hover:text-blue-600 font-medium">
                View All Categories
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($functions as $function)
            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $function['name'] }}</h3>
                <p class="text-gray-600 mb-4">{{ $function['description'] }}</p>
                <div class="flex items-center justify-between">
                    <a href="{{ route($function['route']) }}"
                       class="text-blue-500 hover:text-blue-600 font-medium">
                        View Example →
                    </a>
                    <button onclick="showInfo('{{ $function['name'] }} - {{ $function['description'] }}')"
                            class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Start Guide -->
    <div class="bg-white rounded-lg shadow-md p-8 mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Quick Start Guide</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">How to Use</h3>
                <ol class="space-y-3 text-gray-600">
                    <li class="flex items-start">
                        <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-3 mt-0.5">1</span>
                        Browse functions using the sidebar navigation
                    </li>
                    <li class="flex items-start">
                        <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-3 mt-0.5">2</span>
                        Click on any function to see a working demo
                    </li>
                    <li class="flex items-start">
                        <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-3 mt-0.5">3</span>
                        Copy the code from the examples
                    </li>
                    <li class="flex items-start">
                        <span class="bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm mr-3 mt-0.5">4</span>
                        Paste and customize in your Laravel projects
                    </li>
                </ol>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories</h3>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        UI Components (Accordion, Modal, Tabs, etc.)
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Data & Forms (Tables, Validation, Multi-step)
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Features (Chat, Image Editor, API Testing)
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Utilities (Calculator, QR Generator, Color Picker)
                    </li>
                </ul>
                <button onclick="showInfo('All categories are available in the sidebar navigation!')"
                        class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                    Explore All
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Welcome message
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        showInfo('Welcome to Function Library! Use the sidebar to explore all 25 functions.', {
            duration: 6000
        });
    }, 1000);
});
</script>
@endsection
