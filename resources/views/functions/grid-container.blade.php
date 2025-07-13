@extends('layouts.app')

@section('title', 'Grid Container')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">CSS Grid Container Layouts</h1>
        <p class="text-gray-600 mb-8">Master CSS Grid with these interactive examples and templates for modern web layouts.</p>

        <!-- Grid Layout Types -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Basic Grid -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Basic Grid (3x3)</h3>
                <div class="grid grid-cols-3 gap-2 mb-4">
                    <div class="bg-blue-200 p-4 rounded text-center">1</div>
                    <div class="bg-blue-300 p-4 rounded text-center">2</div>
                    <div class="bg-blue-400 p-4 rounded text-center">3</div>
                    <div class="bg-blue-500 p-4 rounded text-center text-white">4</div>
                    <div class="bg-blue-600 p-4 rounded text-center text-white">5</div>
                    <div class="bg-blue-700 p-4 rounded text-center text-white">6</div>
                    <div class="bg-blue-800 p-4 rounded text-center text-white">7</div>
                    <div class="bg-blue-900 p-4 rounded text-center text-white">8</div>
                    <div class="bg-indigo-500 p-4 rounded text-center text-white">9</div>
                </div>
                <code class="text-sm text-gray-600">grid-cols-3 gap-2</code>
            </div>

            <!-- Responsive Grid -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Responsive Grid</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    <div class="bg-green-200 p-4 rounded text-center">Item 1</div>
                    <div class="bg-green-300 p-4 rounded text-center">Item 2</div>
                    <div class="bg-green-400 p-4 rounded text-center">Item 3</div>
                    <div class="bg-green-500 p-4 rounded text-center text-white">Item 4</div>
                </div>
                <code class="text-sm text-gray-600">grid-cols-1 md:grid-cols-2 lg:grid-cols-4</code>
            </div>

            <!-- Auto-fit Grid -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Auto-fit Grid</h3>
                <div class="grid gap-4 mb-4" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));">
                    <div class="bg-purple-200 p-4 rounded text-center">Auto 1</div>
                    <div class="bg-purple-300 p-4 rounded text-center">Auto 2</div>
                    <div class="bg-purple-400 p-4 rounded text-center">Auto 3</div>
                    <div class="bg-purple-500 p-4 rounded text-center text-white">Auto 4</div>
                    <div class="bg-purple-600 p-4 rounded text-center text-white">Auto 5</div>
                </div>
                <code class="text-sm text-gray-600">repeat(auto-fit, minmax(150px, 1fr))</code>
            </div>

            <!-- Grid Areas -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Grid Areas Layout</h3>
                <div class="grid gap-2 mb-4" style="grid-template-areas: 'header header header' 'sidebar main main' 'footer footer footer'; grid-template-rows: auto 1fr auto;">
                    <div class="bg-red-200 p-4 rounded text-center" style="grid-area: header;">Header</div>
                    <div class="bg-red-300 p-4 rounded text-center" style="grid-area: sidebar;">Sidebar</div>
                    <div class="bg-red-400 p-4 rounded text-center" style="grid-area: main;">Main Content</div>
                    <div class="bg-red-500 p-4 rounded text-center text-white" style="grid-area: footer;">Footer</div>
                </div>
                <code class="text-sm text-gray-600">grid-template-areas</code>
            </div>
        </div>

        <!-- Interactive Grid Generator -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-6">Interactive Grid Generator</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Controls -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Columns:</label>
                        <input type="range" id="gridColumns" min="1" max="6" value="3" class="w-full">
                        <span id="columnsValue" class="text-sm text-gray-600">3</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rows:</label>
                        <input type="range" id="gridRows" min="1" max="6" value="3" class="w-full">
                        <span id="rowsValue" class="text-sm text-gray-600">3</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gap:</label>
                        <input type="range" id="gridGap" min="0" max="32" value="8" class="w-full">
                        <span id="gapValue" class="text-sm text-gray-600">8px</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Align Items:</label>
                        <select id="alignItems" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="stretch">Stretch</option>
                            <option value="start">Start</option>
                            <option value="center">Center</option>
                            <option value="end">End</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Justify Items:</label>
                        <select id="justifyItems" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="stretch">Stretch</option>
                            <option value="start">Start</option>
                            <option value="center">Center</option>
                            <option value="end">End</option>
                        </select>
                    </div>

                    <button onclick="generateCSS()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 w-full">
                        Generate CSS Code
                    </button>
                </div>

                <!-- Preview -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview:</label>
                    <div id="gridPreview" class="border border-gray-300 rounded-lg p-4 min-h-64 bg-white">
                        <!-- Grid items will be generated here -->
                    </div>
                </div>
            </div>

            <!-- Generated CSS -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Generated CSS:</label>
                <pre id="generatedCSS" class="bg-gray-800 text-green-400 p-4 rounded-md overflow-x-auto text-sm"></pre>
            </div>
        </div>

        <!-- Common Grid Patterns -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-6">Common Grid Patterns</h2>

            <div class="space-y-6">
                <!-- Card Grid -->
                <div class="bg-white border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Card Grid Layout</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 border">
                            <h4 class="font-semibold text-blue-800 mb-2">Feature 1</h4>
                            <p class="text-blue-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 border">
                            <h4 class="font-semibold text-green-800 mb-2">Feature 2</h4>
                            <p class="text-green-600 text-sm">Sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-6 border">
                            <h4 class="font-semibold text-purple-800 mb-2">Feature 3</h4>
                            <p class="text-purple-600 text-sm">Ut enim ad minim veniam, quis nostrud exercitation.</p>
                        </div>
                    </div>
                </div>

                <!-- Masonry-like Grid -->
                <div class="bg-white border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Masonry-like Grid</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-yellow-100 rounded-lg p-4 h-32">
                            <h4 class="font-semibold text-yellow-800">Short Card</h4>
                        </div>
                        <div class="bg-pink-100 rounded-lg p-4 h-48">
                            <h4 class="font-semibold text-pink-800">Medium Card</h4>
                            <p class="text-pink-600 text-sm mt-2">This card has more content and takes up more vertical space.</p>
                        </div>
                        <div class="bg-indigo-100 rounded-lg p-4 h-40">
                            <h4 class="font-semibold text-indigo-800">Regular Card</h4>
                            <p class="text-indigo-600 text-sm mt-2">Standard height card with some content.</p>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Layout -->
                <div class="bg-white border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Dashboard Layout</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div class="bg-blue-100 rounded-lg p-4 md:col-span-2">
                            <h4 class="font-semibold text-blue-800">Main Chart</h4>
                            <div class="h-32 bg-blue-200 rounded mt-2"></div>
                        </div>
                        <div class="bg-green-100 rounded-lg p-4">
                            <h4 class="font-semibold text-green-800">Stats 1</h4>
                            <div class="text-2xl font-bold text-green-600 mt-2">$12,345</div>
                        </div>
                        <div class="bg-purple-100 rounded-lg p-4">
                            <h4 class="font-semibold text-purple-800">Stats 2</h4>
                            <div class="text-2xl font-bold text-purple-600 mt-2">567</div>
                        </div>
                        <div class="bg-orange-100 rounded-lg p-4 md:col-span-2">
                            <h4 class="font-semibold text-orange-800">Recent Activity</h4>
                            <div class="space-y-2 mt-2">
                                <div class="h-4 bg-orange-200 rounded"></div>
                                <div class="h-4 bg-orange-200 rounded w-3/4"></div>
                                <div class="h-4 bg-orange-200 rounded w-1/2"></div>
                            </div>
                        </div>
                        <div class="bg-red-100 rounded-lg p-4 md:col-span-2">
                            <h4 class="font-semibold text-red-800">Notifications</h4>
                            <div class="space-y-2 mt-2">
                                <div class="h-3 bg-red-200 rounded"></div>
                                <div class="h-3 bg-red-200 rounded w-4/5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Cheat Sheet -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">CSS Grid Cheat Sheet</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold mb-3">Container Properties</h3>
                    <div class="space-y-2 text-sm">
                        <div><code class="bg-gray-200 px-2 py-1 rounded">display: grid</code> - Create grid container</div>
                        <div><code class="bg-gray-200 px-2 py-1 rounded">grid-template-columns</code> - Define columns</div>
                        <div><code class="bg-gray-200 px-2 py-1 rounded">grid-template-rows</code> - Define rows</div>
                        <div><code class="bg-gray-200 px-2 py-1 rounded">gap</code> - Set grid gap</div>
                        <div><code class="bg-gray-200 px-2 py-1 rounded">justify-items</code> - Align items horizontally</div>
                        <div><code class="bg-gray-200 px-2 py-1 rounded">align-items</code> - Align items vertically</div>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold mb-3">Item Properties</h3>
                    <div class="space-y-2 text-sm">
                        <div><code class="bg-gray-200 px-2 py-1 rounded">grid-column</code> - Column placement</div>
                        <div><code class="bg-gray-200 px-2 py-1 rounded">grid-row</code> - Row placement</div>
                        <div><code class="bg-gray-200 px-2 py-1 rounded">grid-area</code> - Named grid area</div>
                        <div><code class="bg-gray-200 px-2 py-1 rounded">justify-self</code> - Self horizontal alignment</div>
                        <div><code class="bg-gray-200 px-2 py-1 rounded">align-self</code> - Self vertical alignment</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Implementation Guide -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Implementation Guide:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// Basic Grid Setup
.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(3, 1fr);
    gap: 16px;
}

// Responsive Grid
.responsive-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

// Grid Areas Layout
.layout-grid {
    display: grid;
    grid-template-areas:
        "header header header"
        "sidebar main main"
        "footer footer footer";
    grid-template-rows: auto 1fr auto;
    gap: 10px;
    min-height: 100vh;
}

.header { grid-area: header; }
.sidebar { grid-area: sidebar; }
.main { grid-area: main; }
.footer { grid-area: footer; }

// Advanced Grid Functions
.advanced-grid {
    display: grid;
    grid-template-columns:
        minmax(200px, 1fr)
        repeat(2, minmax(0, 300px))
        minmax(200px, 1fr);
    gap: clamp(16px, 4vw, 32px);
}

// Grid Item Spanning
.span-item {
    grid-column: span 2;
    grid-row: span 2;
}

// Tailwind CSS Grid Classes
.tailwind-grid {
    @apply grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6;
}

.tailwind-responsive {
    @apply grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-4;
}
        </code></pre>
    </div>
</div>

<script>
// Interactive Grid Generator
function updateGrid() {
    const columns = document.getElementById('gridColumns').value;
    const rows = document.getElementById('gridRows').value;
    const gap = document.getElementById('gridGap').value;
    const alignItems = document.getElementById('alignItems').value;
    const justifyItems = document.getElementById('justifyItems').value;

    // Update value displays
    document.getElementById('columnsValue').textContent = columns;
    document.getElementById('rowsValue').textContent = rows;
    document.getElementById('gapValue').textContent = gap + 'px';

    // Generate grid items
    const preview = document.getElementById('gridPreview');
    const totalItems = columns * rows;

    let gridHTML = '';
    for (let i = 1; i <= totalItems; i++) {
        const colors = ['bg-blue-200', 'bg-green-200', 'bg-purple-200', 'bg-yellow-200', 'bg-pink-200', 'bg-indigo-200'];
        const colorClass = colors[(i - 1) % colors.length];
        gridHTML += `<div class="${colorClass} p-4 rounded text-center">${i}</div>`;
    }

    preview.innerHTML = gridHTML;
    preview.style.display = 'grid';
    preview.style.gridTemplateColumns = `repeat(${columns}, 1fr)`;
    preview.style.gridTemplateRows = `repeat(${rows}, 1fr)`;
    preview.style.gap = gap + 'px';
    preview.style.alignItems = alignItems;
    preview.style.justifyItems = justifyItems;
}

function generateCSS() {
    const columns = document.getElementById('gridColumns').value;
    const rows = document.getElementById('gridRows').value;
    const gap = document.getElementById('gridGap').value;
    const alignItems = document.getElementById('alignItems').value;
    const justifyItems = document.getElementById('justifyItems').value;

    const css = `.grid-container {
    display: grid;
    grid-template-columns: repeat(${columns}, 1fr);
    grid-template-rows: repeat(${rows}, 1fr);
    gap: ${gap}px;
    align-items: ${alignItems};
    justify-items: ${justifyItems};
}

.grid-item {
    padding: 16px;
    background: #f3f4f6;
    border-radius: 8px;
    text-align: center;
}

/* Tailwind CSS equivalent */
.tailwind-grid {
    @apply grid grid-cols-${columns} grid-rows-${rows} gap-${Math.floor(gap/4)} items-${alignItems} justify-items-${justifyItems};
}`;

    document.getElementById('generatedCSS').textContent = css;
}

// Initialize grid generator
document.addEventListener('DOMContentLoaded', function() {
    // Event listeners for controls
    document.getElementById('gridColumns').addEventListener('input', updateGrid);
    document.getElementById('gridRows').addEventListener('input', updateGrid);
    document.getElementById('gridGap').addEventListener('input', updateGrid);
    document.getElementById('alignItems').addEventListener('change', updateGrid);
    document.getElementById('justifyItems').addEventListener('change', updateGrid);

    // Initial setup
    updateGrid();
    generateCSS();

    setTimeout(() => {
        showInfo('Grid container loaded! Try the interactive generator to create custom grid layouts.');
    }, 1000);
});
</script>
@endsection
