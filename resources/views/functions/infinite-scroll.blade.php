@extends('layouts.app')

@section('title', 'Infinite Scroll')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Infinite Scroll</h1>

        <!-- Content Container -->
        <div id="content-container" class="space-y-4">
            <!-- Initial content will be loaded here -->
        </div>

        <!-- Loading indicator -->
        <div id="loading" class="text-center py-8" style="display: none;">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
            <p class="text-gray-600 mt-2">Loading more content...</p>
        </div>

        <!-- End of content message -->
        <div id="end-message" class="text-center py-8" style="display: none;">
            <p class="text-gray-600">You've reached the end!</p>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">JavaScript Code:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// Infinite Scroll Implementation
let currentPage = 1;
let isLoading = false;
let hasMoreContent = true;

function loadContent(page) {
    if (isLoading || !hasMoreContent) return;

    isLoading = true;
    document.getElementById('loading').style.display = 'block';

    // Simulate API call with setTimeout
    setTimeout(() => {
        const container = document.getElementById('content-container');

        // Generate sample content
        for (let i = 1; i <= 10; i++) {
            const item = createContentItem(((page - 1) * 10) + i);
            container.appendChild(item);
        }

        // Simulate reaching end after 5 pages
        if (page >= 5) {
            hasMoreContent = false;
            document.getElementById('end-message').style.display = 'block';
        }

        isLoading = false;
        document.getElementById('loading').style.display = 'none';
    }, 1000);
}

function createContentItem(index) {
    const div = document.createElement('div');
    div.className = 'bg-gray-50 border rounded-lg p-6 hover:shadow-md transition-shadow';

    div.innerHTML = `
        &lt;div class="flex items-center space-x-4"&gt;
            &lt;div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl"&gt;
                ${index}
            &lt;/div&gt;
            &lt;div&gt;
                &lt;h3 class="text-lg font-semibold text-gray-800"&gt;Content Item ${index}&lt;/h3&gt;
                &lt;p class="text-gray-600"&gt;This is sample content for item number ${index}. It demonstrates infinite scrolling functionality.&lt;/p&gt;
                &lt;span class="text-sm text-blue-500"&gt;Posted ${Math.floor(Math.random() * 30) + 1} days ago&lt;/span&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    `;

    return div;
}

// Scroll event listener
window.addEventListener('scroll', () => {
    if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 1000)) {
        currentPage++;
        loadContent(currentPage);
    }
});

// Load initial content
loadContent(currentPage);
        </code></pre>
    </div>
</div>

<script>
// Infinite Scroll Implementation
let currentPage = 1;
let isLoading = false;
let hasMoreContent = true;

function loadContent(page) {
    if (isLoading || !hasMoreContent) return;

    isLoading = true;
    document.getElementById('loading').style.display = 'block';

    // Simulate API call with setTimeout
    setTimeout(() => {
        const container = document.getElementById('content-container');

        // Generate sample content
        for (let i = 1; i <= 10; i++) {
            const item = createContentItem(((page - 1) * 10) + i);
            container.appendChild(item);
        }

        // Simulate reaching end after 5 pages
        if (page >= 5) {
            hasMoreContent = false;
            document.getElementById('end-message').style.display = 'block';
        }

        isLoading = false;
        document.getElementById('loading').style.display = 'none';
    }, 1000);
}

function createContentItem(index) {
    const div = document.createElement('div');
    div.className = 'bg-gray-50 border rounded-lg p-6 hover:shadow-md transition-shadow';

    div.innerHTML = `
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl">
                ${index}
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Content Item ${index}</h3>
                <p class="text-gray-600">This is sample content for item number ${index}. It demonstrates infinite scrolling functionality.</p>
                <span class="text-sm text-blue-500">Posted ${Math.floor(Math.random() * 30) + 1} days ago</span>
            </div>
        </div>
    `;

    return div;
}

// Scroll event listener
window.addEventListener('scroll', () => {
    if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 1000)) {
        currentPage++;
        loadContent(currentPage);
    }
});

// Load initial content
loadContent(currentPage);
</script>
@endsection
