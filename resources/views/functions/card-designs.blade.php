@extends('layouts.app')

@section('title', 'Card Designs')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Card Design Collection</h1>
        <p class="text-gray-600">Explore various card designs and layouts for your applications</p>
    </div>

    <!-- Card Style Selector -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Card Styles</h2>
        <div class="flex flex-wrap gap-2 mb-4">
            <button onclick="switchCardStyle('default')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" id="card-default">Default</button>
            <button onclick="switchCardStyle('minimalistic')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600" id="card-minimalistic">Minimalistic</button>
            <button onclick="switchCardStyle('modern')" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600" id="card-modern">Modern</button>
            <button onclick="switchCardStyle('glassmorphism')" class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600" id="card-glassmorphism">Glassmorphism</button>
            <button onclick="switchCardStyle('neumorphism')" class="px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600" id="card-neumorphism">Neumorphism</button>
            <button onclick="switchCardStyle('dark')" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900" id="card-dark">Dark</button>
        </div>
    </div>

    <!-- Card Showcase -->
    <div id="card-showcase" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($cardData as $card)
        <div class="card-item d-flex flex-col bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 p-2">
            <div class="card-image">
                <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" class="w-full h-48 object-cover">
                <div class="card-badge">{{ $card['badge'] }}</div>
            </div>
            <div class="card-content">
                <div class="card-header">
                    <h3 class="card-title">{{ $card['title'] }}</h3>
                    <p class="card-subtitle">{{ $card['subtitle'] }}</p>
                </div>
                <p class="card-description">{{ $card['description'] }}</p>
                <div class="card-rating">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $card['rating'] ? 'active' : '' }}">★</span>
                    @endfor
                    <span class="rating-text">{{ $card['rating'] }}</span>
                </div>
                <div class="card-tags">
                    @foreach($card['tags'] as $tag)
                    <span class="card-tag">{{ $tag }}</span>
                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="card-price">{{ $card['price'] }}</div>
                    <button class="card-button">Buy Now</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Additional Card Variants -->
    <div class="space-y-8">
        <!-- Profile Cards -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Profile Cards</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="profile-card">
                    <div class="profile-image">
                        <img src="https://picsum.photos/100/100?random=10" alt="Profile" class="w-20 h-20 rounded-full mx-auto">
                    </div>
                    <div class="profile-info">
                        <h3 class="text-lg font-semibold text-gray-800">John Doe</h3>
                        <p class="text-sm text-gray-600">Frontend Developer</p>
                        <div class="social-links">
                            <a href="#" class="social-link">LinkedIn</a>
                            <a href="#" class="social-link">Twitter</a>
                            <a href="#" class="social-link">GitHub</a>
                        </div>
                        <button class="profile-button">Follow</button>
                    </div>
                </div>

                <div class="profile-card">
                    <div class="profile-image">
                        <img src="https://picsum.photos/100/100?random=11" alt="Profile" class="w-20 h-20 rounded-full mx-auto">
                    </div>
                    <div class="profile-info">
                        <h3 class="text-lg font-semibold text-gray-800">Jane Smith</h3>
                        <p class="text-sm text-gray-600">UI/UX Designer</p>
                        <div class="social-links">
                            <a href="#" class="social-link">Dribbble</a>
                            <a href="#" class="social-link">Behance</a>
                            <a href="#" class="social-link">Instagram</a>
                        </div>
                        <button class="profile-button">Follow</button>
                    </div>
                </div>

                <div class="profile-card">
                    <div class="profile-image">
                        <img src="https://picsum.photos/100/100?random=12" alt="Profile" class="w-20 h-20 rounded-full mx-auto">
                    </div>
                    <div class="profile-info">
                        <h3 class="text-lg font-semibold text-gray-800">Bob Johnson</h3>
                        <p class="text-sm text-gray-600">Full Stack Developer</p>
                        <div class="social-links">
                            <a href="#" class="social-link">GitHub</a>
                            <a href="#" class="social-link">Stack Overflow</a>
                            <a href="#" class="social-link">Medium</a>
                        </div>
                        <button class="profile-button">Follow</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistic Cards -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Statistic Cards</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">12,345</h3>
                        <p class="stat-label">Users</p>
                        <p class="stat-change positive">+12%</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">$89,432</h3>
                        <p class="stat-label">Revenue</p>
                        <p class="stat-change positive">+8%</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4l1-12z"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">2,156</h3>
                        <p class="stat-label">Orders</p>
                        <p class="stat-change positive">+15%</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">94.3%</h3>
                        <p class="stat-label">Satisfaction</p>
                        <p class="stat-change negative">-2%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Feature Cards</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Lightning Fast</h3>
                        <p class="feature-description">Optimized performance for blazing fast user experience</p>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Secure</h3>
                        <p class="feature-description">Enterprise-grade security with advanced encryption</p>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">User Friendly</h3>
                        <p class="feature-description">Intuitive interface designed for the best user experience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Card Implementation Example:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code id="card-code">
<!-- Default Card HTML -->
&lt;div class="card-item"&gt;
    &lt;div class="card-image"&gt;
        &lt;img src="image.jpg" alt="Card Image" class="w-full h-48 object-cover"&gt;
        &lt;div class="card-badge"&gt;New&lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="card-content"&gt;
        &lt;div class="card-header"&gt;
            &lt;h3 class="card-title"&gt;Card Title&lt;/h3&gt;
            &lt;p class="card-subtitle"&gt;Subtitle&lt;/p&gt;
        &lt;/div&gt;
        &lt;p class="card-description"&gt;Card description text&lt;/p&gt;
        &lt;div class="card-footer"&gt;
            &lt;div class="card-price"&gt;$99.99&lt;/div&gt;
            &lt;button class="card-button"&gt;Buy Now&lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
        </code></pre>
    </div>
</div>

<style>
/* Default Card Styles */
.card-item {
    @apply bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105;
}

.card-image {
    @apply relative;
}

.card-badge {
    @apply absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold;
}

.card-content {
    @apply p-4;
}

.card-header {
    @apply mb-2;
}

.card-title {
    @apply text-lg font-semibold text-gray-800;
}

.card-subtitle {
    @apply text-sm text-gray-600;
}

.card-description {
    @apply text-gray-600 text-sm mb-4;
}

.card-rating {
    @apply flex items-center mb-4;
}

.star {
    @apply text-gray-300 text-lg;
}

.star.active {
    @apply text-yellow-400;
}

.rating-text {
    @apply ml-2 text-sm text-gray-600;
}

.card-tags {
    @apply flex flex-wrap gap-2 mb-4;
}

.card-tag {
    @apply bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs;
}

.card-footer {
    @apply flex justify-between items-center;
}

.card-price {
    @apply text-xl font-bold text-green-600;
}

.card-button {
    @apply bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600;
}

/* Minimalistic Card Styles */
.card-minimalistic .card-item {
    @apply bg-white border border-gray-200 rounded-none shadow-none hover:shadow-sm;
}

.card-minimalistic .card-badge {
    @apply bg-black text-white rounded-none px-3 py-1 text-xs uppercase tracking-wider;
}

.card-minimalistic .card-title {
    @apply text-base font-normal text-gray-900;
}

.card-minimalistic .card-subtitle {
    @apply text-xs uppercase tracking-wider text-gray-500;
}

.card-minimalistic .card-description {
    @apply text-gray-700 text-sm leading-relaxed;
}

.card-minimalistic .card-button {
    @apply bg-black text-white px-6 py-2 rounded-none hover:bg-gray-800 text-sm uppercase tracking-wider;
}

/* Modern Card Styles */
.card-modern .card-item {
    @apply bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg hover:shadow-xl border-0;
}

.card-modern .card-badge {
    @apply bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg px-3 py-1 text-xs font-medium;
}

.card-modern .card-title {
    @apply text-xl font-bold text-gray-800;
}

.card-modern .card-subtitle {
    @apply text-sm text-blue-600 font-medium;
}

.card-modern .card-button {
    @apply bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-purple-700 font-medium;
}

/* Glassmorphism Card Styles */
.card-glassmorphism .card-item {
    @apply bg-white bg-opacity-20 backdrop-blur-lg rounded-2xl shadow-2xl border border-white border-opacity-30 hover:bg-opacity-30;
}

.card-glassmorphism .card-badge {
    @apply bg-white bg-opacity-30 text-gray-800 rounded-full px-3 py-1 text-xs font-medium backdrop-blur-sm;
}

.card-glassmorphism .card-title {
    @apply text-lg font-semibold text-gray-800;
}

.card-glassmorphism .card-subtitle {
    @apply text-sm text-gray-600;
}

.card-glassmorphism .card-button {
    @apply bg-white bg-opacity-30 text-gray-800 px-6 py-2 rounded-full hover:bg-opacity-50 backdrop-blur-sm;
}

/* Neumorphism Card Styles */
.card-neumorphism .card-item {
    @apply bg-gray-100 rounded-3xl border-0 hover:shadow-inner;
    box-shadow: 20px 20px 60px #bebebe, -20px -20px 60px #ffffff;
}

.card-neumorphism .card-badge {
    @apply bg-gray-200 text-gray-700 rounded-full px-3 py-1 text-xs font-medium;
    box-shadow: inset 5px 5px 10px #bebebe, inset -5px -5px 10px #ffffff;
}

.card-neumorphism .card-title {
    @apply text-lg font-semibold text-gray-800;
}

.card-neumorphism .card-button {
    @apply bg-gray-200 text-gray-800 px-6 py-2 rounded-full hover:bg-gray-300;
    box-shadow: 5px 5px 10px #bebebe, -5px -5px 10px #ffffff;
}

/* Dark Card Styles */
.card-dark .card-item {
    @apply bg-gray-800 rounded-lg shadow-lg hover:shadow-xl border border-gray-700;
}

.card-dark .card-badge {
    @apply bg-purple-600 text-white rounded-full px-3 py-1 text-xs font-medium;
}

.card-dark .card-title {
    @apply text-lg font-semibold text-white;
}

.card-dark .card-subtitle {
    @apply text-sm text-gray-400;
}

.card-dark .card-description {
    @apply text-gray-300 text-sm;
}

.card-dark .card-price {
    @apply text-green-400;
}

.card-dark .card-button {
    @apply bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700;
}

/* Profile Card Styles */
.profile-card {
    @apply bg-white rounded-lg shadow-md p-6 text-center;
}

.profile-image {
    @apply mb-4;
}

.profile-info h3 {
    @apply text-lg font-semibold text-gray-800 mb-1;
}

.profile-info p {
    @apply text-gray-600 mb-4;
}

.social-links {
    @apply flex justify-center gap-4 mb-4;
}

.social-link {
    @apply text-blue-500 hover:text-blue-600 text-sm;
}

.profile-button {
    @apply bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600;
}

/* Statistic Card Styles */
.stat-card {
    @apply bg-white rounded-lg shadow-md p-6 flex items-center;
}

.stat-icon {
    @apply mr-4;
}

.stat-number {
    @apply text-2xl font-bold text-gray-800;
}

.stat-label {
    @apply text-sm text-gray-600;
}

.stat-change {
    @apply text-sm font-medium;
}

.stat-change.positive {
    @apply text-green-500;
}

.stat-change.negative {
    @apply text-red-500;
}

/* Feature Card Styles */
.feature-card {
    @apply bg-white rounded-lg shadow-md p-6 text-center;
}

.feature-icon {
    @apply mb-4;
}

.feature-title {
    @apply text-lg font-semibold text-gray-800 mb-2;
}

.feature-description {
    @apply text-gray-600 text-sm;
}

/* Background for glassmorphism effect */
.card-glassmorphism {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.card-glassmorphism::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    z-index: -1;
}
</style>

<script>
function switchCardStyle(style) {
    const showcase = document.getElementById('card-showcase');
    const buttons = document.querySelectorAll('[id^="card-"]');

    // Remove all card style classes
    showcase.className = showcase.className.replace(/card-\w+/g, '');

    // Add new style class
    showcase.classList.add(`card-${style}`);

    // Update button states
    buttons.forEach(btn => {
        btn.classList.remove('bg-blue-600', 'bg-gray-600', 'bg-purple-600', 'bg-indigo-600', 'bg-pink-600', 'bg-gray-900');
        btn.classList.add('bg-blue-500', 'bg-gray-500', 'bg-purple-500', 'bg-indigo-500', 'bg-pink-500', 'bg-gray-800');
    });

    // Highlight active button
    const activeBtn = document.getElementById(`card-${style}`);
    if (activeBtn) {
        const colorMap = {
            'default': 'blue',
            'minimalistic': 'gray',
            'modern': 'purple',
            'glassmorphism': 'indigo',
            'neumorphism': 'pink',
            'dark': 'gray'
        };
        const color = colorMap[style] || 'blue';
        const shade = style === 'dark' ? '900' : '600';

        activeBtn.classList.remove(`bg-${color}-500`, `bg-${color}-800`);
        activeBtn.classList.add(`bg-${color}-${shade}`);
    }

    // Update code example
    updateCodeExample(style);
}

function updateCodeExample(style) {
    const codeElement = document.getElementById('card-code');
    const examples = {
        'default': `<!-- Default Card HTML -->
&lt;div class="card-item"&gt;
    &lt;div class="card-image"&gt;
        &lt;img src="image.jpg" alt="Card Image" class="w-full h-48 object-cover"&gt;
        &lt;div class="card-badge"&gt;New&lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="card-content"&gt;
        &lt;div class="card-header"&gt;
            &lt;h3 class="card-title"&gt;Card Title&lt;/h3&gt;
            &lt;p class="card-subtitle"&gt;Subtitle&lt;/p&gt;
        &lt;/div&gt;
        &lt;p class="card-description"&gt;Card description text&lt;/p&gt;
        &lt;div class="card-footer"&gt;
            &lt;div class="card-price"&gt;$99.99&lt;/div&gt;
            &lt;button class="card-button"&gt;Buy Now&lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;`,
        'minimalistic': `<!-- Minimalistic Card CSS -->
.card-item {
    @apply bg-white border border-gray-200 rounded-none shadow-none hover:shadow-sm;
}

.card-badge {
    @apply bg-black text-white rounded-none px-3 py-1 text-xs uppercase tracking-wider;
}

.card-button {
    @apply bg-black text-white px-6 py-2 rounded-none hover:bg-gray-800 text-sm uppercase tracking-wider;
}`,
        'modern': `<!-- Modern Card CSS -->
.card-item {
    @apply bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg hover:shadow-xl border-0;
}

.card-badge {
    @apply bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg px-3 py-1 text-xs font-medium;
}

.card-button {
    @apply bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-purple-700 font-medium;
}`,
        'glassmorphism': `<!-- Glassmorphism Card CSS -->
.card-item {
    @apply bg-white bg-opacity-20 backdrop-blur-lg rounded-2xl shadow-2xl border border-white border-opacity-30 hover:bg-opacity-30;
}

.card-badge {
    @apply bg-white bg-opacity-30 text-gray-800 rounded-full px-3 py-1 text-xs font-medium backdrop-blur-sm;
}

.card-button {
    @apply bg-white bg-opacity-30 text-gray-800 px-6 py-2 rounded-full hover:bg-opacity-50 backdrop-blur-sm;
}`,
        'neumorphism': `<!-- Neumorphism Card CSS -->
.card-item {
    @apply bg-gray-100 rounded-3xl border-0 hover:shadow-inner;
    box-shadow: 20px 20px 60px #bebebe, -20px -20px 60px #ffffff;
}

.card-badge {
    @apply bg-gray-200 text-gray-700 rounded-full px-3 py-1 text-xs font-medium;
    box-shadow: inset 5px 5px 10px #bebebe, inset -5px -5px 10px #ffffff;
}

.card-button {
    @apply bg-gray-200 text-gray-800 px-6 py-2 rounded-full hover:bg-gray-300;
    box-shadow: 5px 5px 10px #bebebe, -5px -5px 10px #ffffff;
}`,
        'dark': `<!-- Dark Card CSS -->
.card-item {
    @apply bg-gray-800 rounded-lg shadow-lg hover:shadow-xl border border-gray-700;
}

.card-badge {
    @apply bg-purple-600 text-white rounded-full px-3 py-1 text-xs font-medium;
}

.card-button {
    @apply bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700;
}`
    };

    codeElement.textContent = examples[style] || examples['default'];
}

// Initialize with default style
document.addEventListener('DOMContentLoaded', function() {
    switchCardStyle('default');

    setTimeout(() => {
        showInfo('Card designs loaded! Try different styles to see various card layouts.');
    }, 1000);
});
</script>
@endsection
