@extends('layouts.app')

@section('title', 'Responsive Container')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Responsive Container Layouts</h1>
        <p class="text-gray-600 mb-8">Learn responsive design patterns and create containers that adapt perfectly to all screen sizes.</p>

        <!-- Responsive Breakpoints Demo -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-6">Responsive Breakpoints</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-red-200 p-4 rounded-lg text-center">
                    <div class="font-semibold text-red-800">Mobile</div>
                    <div class="text-sm text-red-600">< 768px</div>
                    <div class="block md:hidden mt-2 text-xs bg-red-300 p-2 rounded">Active</div>
                </div>
                <div class="bg-yellow-200 p-4 rounded-lg text-center">
                    <div class="font-semibold text-yellow-800">Tablet</div>
                    <div class="text-sm text-yellow-600">768px - 1023px</div>
                    <div class="hidden md:block lg:hidden mt-2 text-xs bg-yellow-300 p-2 rounded">Active</div>
                </div>
                <div class="bg-green-200 p-4 rounded-lg text-center">
                    <div class="font-semibold text-green-800">Desktop</div>
                    <div class="text-sm text-green-600">1024px - 1279px</div>
                    <div class="hidden lg:block xl:hidden mt-2 text-xs bg-green-300 p-2 rounded">Active</div>
                </div>
                <div class="bg-blue-200 p-4 rounded-lg text-center">
                    <div class="font-semibold text-blue-800">Large</div>
                    <div class="text-sm text-blue-600">≥ 1280px</div>
                    <div class="hidden xl:block mt-2 text-xs bg-blue-300 p-2 rounded">Active</div>
                </div>
            </div>
        </div>

        <!-- Container Types -->
        <div class="space-y-8 mb-8">
            <!-- Fluid Container -->
            <div class="bg-white border rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Fluid Container (Full Width)</h3>
                <div class="bg-blue-50 border-2 border-dashed border-blue-300 p-6 rounded-lg">
                    <div class="bg-blue-500 text-white p-4 rounded">
                        <h4 class="font-semibold">Fluid Container</h4>
                        <p class="text-sm opacity-90">This container spans the full width of its parent and adapts to any screen size.</p>
                    </div>
                </div>
                <div class="mt-4 text-sm text-gray-600">
                    <code class="bg-gray-100 px-2 py-1 rounded">width: 100%</code>
                </div>
            </div>

            <!-- Fixed Container -->
            <div class="bg-white border rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Fixed Container (Max Width)</h3>
                <div class="bg-green-50 border-2 border-dashed border-green-300 p-6 rounded-lg">
                    <div class="max-w-4xl mx-auto bg-green-500 text-white p-4 rounded">
                        <h4 class="font-semibold">Fixed Container</h4>
                        <p class="text-sm opacity-90">This container has a maximum width and centers itself on larger screens.</p>
                    </div>
                </div>
                <div class="mt-4 text-sm text-gray-600">
                    <code class="bg-gray-100 px-2 py-1 rounded">max-width: 1024px; margin: 0 auto;</code>
                </div>
            </div>

            <!-- Responsive Container -->
            <div class="bg-white border rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Responsive Container (Breakpoint-based)</h3>
                <div class="bg-purple-50 border-2 border-dashed border-purple-300 p-6 rounded-lg">
                    <div class="w-full sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl mx-auto bg-purple-500 text-white p-4 rounded">
                        <h4 class="font-semibold">Responsive Container</h4>
                        <p class="text-sm opacity-90">This container changes its max-width based on screen size breakpoints.</p>
                    </div>
                </div>
                <div class="mt-4 text-sm text-gray-600">
                    <code class="bg-gray-100 px-2 py-1 rounded">sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl</code>
                </div>
            </div>
        </div>

        <!-- Interactive Responsive Designer -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-6">Interactive Responsive Designer</h2>
            
            <!-- Device Simulator -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-2 mb-4">
                    <button onclick="setViewport(375, 667)" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Mobile</button>
                    <button onclick="setViewport(768, 1024)" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Tablet</button>
                    <button onclick="setViewport(1024, 768)" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Desktop</button>
                    <button onclick="setViewport(1440, 900)" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Large</button>
                    <button onclick="setViewport('100%', 'auto')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Full</button>
                </div>

                <div class="bg-gray-300 p-4 rounded-lg">
                    <div id="viewport" class="mx-auto bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300" style="width: 100%; min-height: 400px;">
                        <div class="bg-gray-800 text-white p-2 text-center text-sm">
                            <span id="viewportSize">Current Viewport</span>
                        </div>
                        <div class="p-6">
                            <div id="responsiveContent" class="space-y-4">
                                <!-- Content will be generated here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Controls -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Container Type:</label>
                        <select id="containerType" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="fluid">Fluid (100%)</option>
                            <option value="fixed">Fixed (max-width)</option>
                            <option value="responsive">Responsive (breakpoints)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Max Width (px):</label>
                        <input type="range" id="maxWidth" min="320" max="1200" value="1024" class="w-full">
                        <span id="maxWidthValue" class="text-sm text-gray-600">1024px</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Padding:</label>
                        <input type="range" id="padding" min="0" max="48" value="16" class="w-full">
                        <span id="paddingValue" class="text-sm text-gray-600">16px</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Content Layout:</label>
                        <select id="contentLayout" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="single">Single Column</option>
                            <option value="two-column">Two Column</option>
                            <option value="three-column">Three Column</option>
                            <option value="sidebar">Sidebar Layout</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Behavior:</label>
                        <select id="mobileBehavior" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="stack">Stack Vertically</option>
                            <option value="scroll">Horizontal Scroll</option>
                            <option value="hide">Hide Secondary Content</option>
                        </select>
                    </div>

                    <button onclick="updateResponsiveDesign()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 w-full">
                        Update Design
                    </button>
                </div>
            </div>

            <!-- Generated CSS -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Generated CSS:</label>
                <pre id="responsiveCSS" class="bg-gray-800 text-green-400 p-4 rounded-md overflow-x-auto text-sm"></pre>
            </div>
        </div>

        <!-- Common Responsive Patterns -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-6">Common Responsive Patterns</h2>
            
            <div class="space-y-6">
                <!-- Card Grid Pattern -->
                <div class="bg-white border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Card Grid Pattern</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border">
                            <h4 class="font-semibold text-blue-800">Card 1</h4>
                            <p class="text-sm text-blue-600 mt-2">Responsive card that adapts to screen size</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border">
                            <h4 class="font-semibold text-green-800">Card 2</h4>
                            <p class="text-sm text-green-600 mt-2">Responsive card that adapts to screen size</p>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg border">
                            <h4 class="font-semibold text-purple-800">Card 3</h4>
                            <p class="text-sm text-purple-600 mt-2">Responsive card that adapts to screen size</p>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        <code class="bg-gray-100 px-2 py-1 rounded">grid-cols-1 sm:grid-cols-2 lg:grid-cols-3</code>
                    </div>
                </div>

                <!-- Sidebar Pattern -->
                <div class="bg-white border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Sidebar Pattern</h3>
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="lg:w-1/4 bg-gray-100 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800">Sidebar</h4>
                            <p class="text-sm text-gray-600 mt-2">Collapses to top on mobile</p>
                        </div>
                        <div class="lg:w-3/4 bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-blue-800">Main Content</h4>
                            <p class="text-sm text-blue-600 mt-2">Takes full width on mobile, 3/4 on desktop</p>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        <code class="bg-gray-100 px-2 py-1 rounded">flex-col lg:flex-row</code>
                    </div>
                </div>

                <!-- Hero Section Pattern -->
                <div class="bg-white border rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Hero Section Pattern</h3>
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-8 rounded-lg">
                        <div class="text-center">
                            <h4 class="text-2xl md:text-4xl font-bold mb-4">Responsive Hero</h4>
                            <p class="text-lg md:text-xl opacity-90 mb-6">Text scales with screen size</p>
                            <button class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                                Call to Action
                            </button>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        <code class="bg-gray-100 px-2 py-1 rounded">text-2xl md:text-4xl</code>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responsive Testing Tools -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-6">Responsive Testing Tools</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold mb-3">Browser DevTools</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>• F12 → Toggle device toolbar</li>
                        <li>• Test different screen sizes</li>
                        <li>• Inspect responsive breakpoints</li>
                        <li>• Network throttling</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-3">Online Tools</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>• Responsive Design Checker</li>
                        <li>• Mobile-Friendly Test</li>
                        <li>• Cross-browser testing</li>
                        <li>• Performance testing</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Best Practices -->
        <div class="bg-white border rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Responsive Design Best Practices</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold mb-3 text-green-600">Do's</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>✓ Use mobile-first approach</li>
                        <li>✓ Test on real devices</li>
                        <li>✓ Use flexible units (%, em, rem)</li>
                        <li>✓ Optimize images for different screens</li>
                        <li>✓ Consider touch interactions</li>
                        <li>✓ Use semantic HTML</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-3 text-red-600">Don'ts</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>✗ Don't use fixed widths</li>
                        <li>✗ Don't ignore performance</li>
                        <li>✗ Don't forget accessibility</li>
                        <li>✗ Don't use too many breakpoints</li>
                        <li>✗ Don't assume screen orientation</li>
                        <li>✗ Don't neglect older devices</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Implementation Guide -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Implementation Guide:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
/* Mobile-First Responsive Design */
.container {
    width: 100%;
    padding: 16px;
    margin: 0 auto;
}

/* Tablet */
@media (min-width: 768px) {
    .container {
        max-width: 768px;
        padding: 24px;
    }
}

/* Desktop */
@media (min-width: 1024px) {
    .container {
        max-width: 1024px;
        padding: 32px;
    }
}

/* Large Desktop */
@media (min-width: 1280px) {
    .container {
        max-width: 1280px;
    }
}

/* Responsive Grid */
.responsive-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 16px;
}

@media (min-width: 768px) {
    .responsive-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .responsive-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Tailwind CSS Responsive */
.tailwind-responsive {
    @apply w-full px-4 mx-auto;
    @apply sm:max-w-sm sm:px-6;
    @apply md:max-w-md md:px-8;
    @apply lg:max-w-lg lg:px-10;
    @apply xl:max-w-xl xl:px-12;
}
        </code></pre>
    </div>
</div>

<script>
// Responsive Designer Functions
function setViewport(width, height) {
    const viewport = document.getElementById('viewport');
    const sizeDisplay = document.getElementById('viewportSize');
    
    if (width === '100%') {
        viewport.style.width = '100%';
        viewport.style.height = 'auto';
        sizeDisplay.textContent = 'Full Width';
    } else {
        viewport.style.width = width + 'px';
        viewport.style.height = height + 'px';
        sizeDisplay.textContent = `${width}px × ${height}px`;
    }
    
    updateResponsiveDesign();
}

function updateResponsiveDesign() {
    const containerType = document.getElementById('containerType').value;
    const maxWidth = document.getElementById('maxWidth').value;
    const padding = document.getElementById('padding').value;
    const contentLayout = document.getElementById('contentLayout').value;
    const mobileBehavior = document.getElementById('mobileBehavior').value;
    
    // Update value displays
    document.getElementById('maxWidthValue').textContent = maxWidth + 'px';
    document.getElementById('paddingValue').textContent = padding + 'px';
    
    // Generate content based on layout
    const content = generateContent(contentLayout, mobileBehavior);
    document.getElementById('responsiveContent').innerHTML = content;
    
    // Apply container styles
    const container = document.getElementById('responsiveContent');
    container.style.padding = padding + 'px';
    
    switch (containerType) {
        case 'fluid':
            container.style.width = '100%';
            container.style.maxWidth = 'none';
            break;
        case 'fixed':
            container.style.width = '100%';
            container.style.maxWidth = maxWidth + 'px';
            break;
        case 'responsive':
            container.style.width = '100%';
            container.style.maxWidth = 'none';
            break;
    }
    
    // Generate CSS
    generateResponsiveCSS();
}

function generateContent(layout, mobileBehavior) {
    switch (layout) {
        case 'single':
            return `
                <div class="bg-blue-100 p-4 rounded-lg">
                    <h3 class="font-semibold text-blue-800">Main Content</h3>
                    <p class="text-sm text-blue-600 mt-2">This is a single column layout that works well on all screen sizes.</p>
                </div>
            `;
        case 'two-column':
            const twoColClass = mobileBehavior === 'stack' ? 'flex-col md:flex-row' : 'flex-row';
            return `
                <div class="flex ${twoColClass} gap-4">
                    <div class="flex-1 bg-green-100 p-4 rounded-lg">
                        <h3 class="font-semibold text-green-800">Column 1</h3>
                        <p class="text-sm text-green-600 mt-2">First column content</p>
                    </div>
                    <div class="flex-1 bg-purple-100 p-4 rounded-lg">
                        <h3 class="font-semibold text-purple-800">Column 2</h3>
                        <p class="text-sm text-purple-600 mt-2">Second column content</p>
                    </div>
                </div>
            `;
        case 'three-column':
            return `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-red-100 p-4 rounded-lg">
                        <h3 class="font-semibold text-red-800">Column 1</h3>
                        <p class="text-sm text-red-600 mt-2">First column</p>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <h3 class="font-semibold text-yellow-800">Column 2</h3>
                        <p class="text-sm text-yellow-600 mt-2">Second column</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-lg">
                        <h3 class="font-semibold text-indigo-800">Column 3</h3>
                        <p class="text-sm text-indigo-600 mt-2">Third column</p>
                    </div>
                </div>
            `;
        case 'sidebar':
            return `
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="lg:w-1/4 bg-gray-100 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-800">Sidebar</h3>
                        <p class="text-sm text-gray-600 mt-2">Navigation or secondary content</p>
                    </div>
                    <div class="lg:w-3/4 bg-blue-100 p-4 rounded-lg">
                        <h3 class="font-semibold text-blue-800">Main Content</h3>
                        <p class="text-sm text-blue-600 mt-2">Primary content area</p>
                    </div>
                </div>
            `;
        default:
            return '';
    }
}

function generateResponsiveCSS() {
    const containerType = document.getElementById('containerType').value;
    const maxWidth = document.getElementById('maxWidth').value;
    const padding = document.getElementById('padding').value;
    const contentLayout = document.getElementById('contentLayout').value;
    
    let css = `/* Responsive Container */\n.container {\n    width: 100%;\n    padding: ${padding}px;\n    margin: 0 auto;\n`;
    
    if (containerType === 'fixed') {
        css += `    max-width: ${maxWidth}px;\n`;
    } else if (containerType === 'responsive') {
        css += `}\n\n/* Responsive Breakpoints */\n@media (min-width: 768px) {\n    .container {\n        max-width: 768px;\n    }\n}\n\n@media (min-width: 1024px) {\n    .container {\n        max-width: 1024px;\n    }\n}\n\n@media (min-width: 1280px) {\n    .container {\n        max-width: 1280px;\n`;
    }
    
    css += `}\n\n/* Content Layout */\n`;
    
    switch (contentLayout) {
        case 'two-column':
            css += `.two-column {\n    display: flex;\n    flex-direction: column;\n    gap: 16px;\n}\n\n@media (min-width: 768px) {\n    .two-column {\n        flex-direction: row;\n    }\n}`;
            break;
        case 'three-column':
            css += `.three-column {\n    display: grid;\n    grid-template-columns: 1fr;\n    gap: 16px;\n}\n\n@media (min-width: 768px) {\n    .three-column {\n        grid-template-columns: repeat(3, 1fr);\n    }\n}`;
            break;
        case 'sidebar':
            css += `.sidebar-layout {\n    display: flex;\n    flex-direction: column;\n    gap: 16px;\n}\n\n@media (min-width: 1024px) {\n    .sidebar-layout {\n        flex-direction: row;\n    }\n    .sidebar {\n        width: 25%;\n    }\n    .main-content {\n        width: 75%;\n    }\n}`;
            break;
    }
    
    document.getElementById('responsiveCSS').textContent = css;
}

// Initialize responsive designer
document.addEventListener('DOMContentLoaded', function() {
    // Event listeners
    document.getElementById('containerType').addEventListener('change', updateResponsiveDesign);
    document.getElementById('maxWidth').addEventListener('input', updateResponsiveDesign);
    document.getElementById('padding').addEventListener('input', updateResponsiveDesign);
    document.getElementById('contentLayout').addEventListener('change', updateResponsiveDesign);
    document.getElementById('mobileBehavior').addEventListener('change', updateResponsiveDesign);
    
    // Initial setup
    updateResponsiveDesign();
    
    setTimeout(() => {
        showInfo('Responsive container loaded! Test different viewport sizes and layouts.');
    }, 1000);
});
</script>
@endsection
