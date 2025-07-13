@extends('layouts.app')

@section('title', 'Tabs')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Tabs Component</h1>
        <p class="text-gray-600">Tabbed interface component with smooth transitions</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        <div x-data="{ activeTab: 'profile' }">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8">
                    @foreach($tabsData as $key => $tab)
                    <button @click="activeTab = '{{ $key }}'"
                            :class="{ 'border-blue-500 text-blue-600': activeTab === '{{ $key }}', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== '{{ $key }}' }"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        {{ $tab['title'] }}
                    </button>
                    @endforeach
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="mt-6">
                @foreach($tabsData as $key => $tab)
                <div x-show="activeTab === '{{ $key }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform translate-y-4"
                     class="space-y-4">

                    <h3 class="text-lg font-semibold text-gray-800">{{ $tab['title'] }} Content</h3>
                    <p class="text-gray-600">{{ $tab['content'] }}</p>

                    @if($key === 'profile')
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                JD
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">John Doe</h4>
                                <p class="text-gray-600">Software Developer</p>
                                <p class="text-sm text-gray-500">john.doe@example.com</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h5 class="font-medium text-gray-800">Experience</h5>
                                <p class="text-gray-600">5+ years</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h5 class="font-medium text-gray-800">Location</h5>
                                <p class="text-gray-600">New York, NY</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($key === 'settings')
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">Email Notifications</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">SMS Notifications</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">Push Notifications</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                    @endif

                    @if($key === 'notifications')
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3 p-4 bg-blue-50 rounded-lg">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800">System Update</h5>
                                <p class="text-sm text-gray-600">New features available in version 2.1</p>
                                <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-4 bg-green-50 rounded-lg">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800">Task Completed</h5>
                                <p class="text-sm text-gray-600">Your profile has been updated successfully</p>
                                <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($key === 'security')
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-800 mb-2">Password Security</h5>
                            <p class="text-sm text-gray-600 mb-3">Last changed: 30 days ago</p>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                                Change Password
                            </button>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-800 mb-2">Two-Factor Authentication</h5>
                            <p class="text-sm text-gray-600 mb-3">Add an extra layer of security to your account</p>
                            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm">
                                Enable 2FA
                            </button>
                        </div>
                    </div>
                    @endif

                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Code Example</h2>

        <div class="bg-gray-100 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-800"><code>// Controller
public function tabs()
{
    $tabsData = [
        'profile' => [
            'title' => 'Profile',
            'content' => 'This is the profile tab content with user information.'
        ],
        'settings' => [
            'title' => 'Settings',
            'content' => 'This is the settings tab content with configuration options.'
        ],
        'notifications' => [
            'title' => 'Notifications',
            'content' => 'This is the notifications tab content with alerts and messages.'
        ],
        'security' => [
            'title' => 'Security',
            'content' => 'This is the security tab content with password and authentication settings.'
        ]
    ];

    return view('functions.tabs', compact('tabsData'));
}

// Blade Template
&lt;div x-data="{ activeTab: 'profile' }"&gt;
    &lt;!-- Tab Navigation --&gt;
    &lt;div class="border-b border-gray-200"&gt;
        &lt;nav class="flex space-x-8"&gt;
            &#64;foreach($tabsData as $key => $tab)
            &lt;button &#64;click="activeTab = '{{ $key }}'"
                    :class="{ 'border-blue-500 text-blue-600': activeTab === '{{ $key }}', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== '{{ $key }}' }"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200"&gt;
                {{ $tab['title'] }}
            &lt;/button&gt;
            &#64;endforeach
        &lt;/nav&gt;
    &lt;/div&gt;

    &lt;!-- Tab Content --&gt;
    &lt;div class="mt-6"&gt;
        &#64;foreach($tabsData as $key => $tab)
        &lt;div x-show="activeTab === '{{ $key }}'"
             x-transition
             class="space-y-4"&gt;
            &lt;h3 class="text-lg font-semibold text-gray-800"&gt;{{ $tab['title'] }} Content&lt;/h3&gt;
            &lt;p class="text-gray-600"&gt;{{ $tab['content'] }}&lt;/p&gt;
        &lt;/div&gt;
        &#64;endforeach
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
        </div>
    </div>
</div>
@endsection
