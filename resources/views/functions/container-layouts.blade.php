@extends('layouts.app')

@section('title', 'Container Layouts')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Container Layout Examples</h1>

        <!-- Fixed Width Container -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Fixed Width Container</h2>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold mb-2">Fixed Width: 1024px</h3>
                    <p class="text-gray-600">This container has a maximum width of 1024px and centers itself on larger screens.</p>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.container-fixed {
    max-width: 1024px;
    margin: 0 auto;
    padding: 0 1rem;
}</code></pre>
            </div>
        </div>

        <!-- Fluid Container -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Fluid Container</h2>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                <div class="w-full bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold mb-2">Fluid Width: 100%</h3>
                    <p class="text-gray-600">This container expands to fill the entire width of its parent container.</p>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.container-fluid {
    width: 100%;
    padding: 0 1rem;
}</code></pre>
            </div>
        </div>

        <!-- Responsive Container -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Responsive Container</h2>
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-4">
                <div class="responsive-container bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold mb-2">Responsive Width</h3>
                    <p class="text-gray-600">This container adapts its width based on screen size breakpoints.</p>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.container-responsive {
    width: 100%;
    padding: 0 1rem;
    margin: 0 auto;
}

@media (min-width: 640px) {
    .container-responsive { max-width: 640px; }
}

@media (min-width: 768px) {
    .container-responsive { max-width: 768px; }
}

@media (min-width: 1024px) {
    .container-responsive { max-width: 1024px; }
}

@media (min-width: 1280px) {
    .container-responsive { max-width: 1280px; }
}</code></pre>
            </div>
        </div>

        <!-- Centered Container -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Centered Container</h2>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                <div class="flex justify-center">
                    <div class="w-96 bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-2">Centered: 384px</h3>
                        <p class="text-gray-600">This container is centered horizontally with a fixed width.</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.container-centered {
    width: 384px;
    margin: 0 auto;
    padding: 1rem;
}

/* Alternative with flexbox */
.container-centered-flex {
    display: flex;
    justify-content: center;
}

.container-centered-flex > div {
    width: 384px;
    padding: 1rem;
}</code></pre>
            </div>
        </div>

        <!-- Grid Container -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Grid Container</h2>
            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-semibold mb-2">Grid Item 1</h3>
                        <p class="text-gray-600">Content for first grid item.</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-semibold mb-2">Grid Item 2</h3>
                        <p class="text-gray-600">Content for second grid item.</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-semibold mb-2">Grid Item 3</h3>
                        <p class="text-gray-600">Content for third grid item.</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.container-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1rem;
    padding: 1rem;
}

/* Responsive grid */
@media (min-width: 768px) {
    .container-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .container-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}</code></pre>
            </div>
        </div>

        <!-- Sidebar Container -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Sidebar Container</h2>
            <div class="bg-pink-50 border border-pink-200 rounded-lg p-4 mb-4">
                <div class="flex gap-4">
                    <div class="w-64 bg-gray-800 text-white rounded-lg p-4">
                        <h3 class="font-semibold mb-4">Sidebar</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Dashboard</a></li>
                            <li><a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Products</a></li>
                            <li><a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Orders</a></li>
                            <li><a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Settings</a></li>
                        </ul>
                    </div>
                    <div class="flex-1 bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-semibold mb-2">Main Content</h3>
                        <p class="text-gray-600">This is the main content area that takes up the remaining space.</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.container-sidebar {
    display: flex;
    gap: 1rem;
    min-height: 100vh;
}

.sidebar {
    width: 256px;
    background-color: #1f2937;
    padding: 1rem;
    border-radius: 0.5rem;
}

.main-content {
    flex: 1;
    background-color: white;
    padding: 1rem;
    border-radius: 0.5rem;
}</code></pre>
            </div>
        </div>

        <!-- Interactive Demo -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Interactive Container Demo</h2>
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Container Type:</label>
                    <select id="containerType" class="border border-gray-300 rounded-md px-3 py-2">
                        <option value="fixed">Fixed Width</option>
                        <option value="fluid">Fluid Width</option>
                        <option value="responsive">Responsive</option>
                        <option value="centered">Centered</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Container Width:</label>
                    <input type="range" id="containerWidth" class="w-full" min="300" max="1200" value="800">
                    <span id="widthValue" class="text-sm text-gray-600">800px</span>
                </div>

                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-white">
                    <div id="demoContainer" class="bg-blue-100 border border-blue-300 rounded-lg p-4 transition-all duration-300" style="width: 800px; margin: 0 auto;">
                        <h3 class="font-semibold mb-2">Demo Container</h3>
                        <p class="text-gray-600">Adjust the settings above to see how the container behaves.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.responsive-container {
    width: 100%;
    padding: 0 1rem;
    margin: 0 auto;
}

@media (min-width: 640px) {
    .responsive-container { max-width: 640px; }
}

@media (min-width: 768px) {
    .responsive-container { max-width: 768px; }
}

@media (min-width: 1024px) {
    .responsive-container { max-width: 1024px; }
}

@media (min-width: 1280px) {
    .responsive-container { max-width: 1280px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const containerType = document.getElementById('containerType');
    const containerWidth = document.getElementById('containerWidth');
    const widthValue = document.getElementById('widthValue');
    const demoContainer = document.getElementById('demoContainer');

    function updateContainer() {
        const type = containerType.value;
        const width = containerWidth.value;
        widthValue.textContent = width + 'px';

        // Reset styles
        demoContainer.style.width = '';
        demoContainer.style.margin = '';
        demoContainer.style.maxWidth = '';

        switch(type) {
            case 'fixed':
                demoContainer.style.width = width + 'px';
                demoContainer.style.margin = '0 auto';
                break;
            case 'fluid':
                demoContainer.style.width = '100%';
                demoContainer.style.margin = '0';
                break;
            case 'responsive':
                demoContainer.style.width = '100%';
                demoContainer.style.maxWidth = width + 'px';
                demoContainer.style.margin = '0 auto';
                break;
            case 'centered':
                demoContainer.style.width = width + 'px';
                demoContainer.style.margin = '0 auto';
                break;
        }
    }

    containerType.addEventListener('change', updateContainer);
    containerWidth.addEventListener('input', updateContainer);

    // Initialize
    updateContainer();

    setTimeout(() => {
        showInfo('Container layouts loaded! Try the interactive demo.');
    }, 1000);
});
</script>
@endsection
