@extends('layouts.app')

@section('title', 'Flexbox Container')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Flexbox Container Examples</h1>
        
        <!-- Basic Flex Container -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Basic Flex Container</h2>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <div class="flex gap-4">
                    <div class="bg-blue-500 text-white p-4 rounded">Item 1</div>
                    <div class="bg-blue-500 text-white p-4 rounded">Item 2</div>
                    <div class="bg-blue-500 text-white p-4 rounded">Item 3</div>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.flex-container {
    display: flex;
    gap: 1rem;
}</code></pre>
            </div>
        </div>

        <!-- Flex Direction -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Flex Direction</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Row (Default)</h3>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex gap-2">
                            <div class="bg-green-500 text-white p-2 rounded text-sm">1</div>
                            <div class="bg-green-500 text-white p-2 rounded text-sm">2</div>
                            <div class="bg-green-500 text-white p-2 rounded text-sm">3</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Column</h3>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex flex-col gap-2">
                            <div class="bg-green-500 text-white p-2 rounded text-sm">1</div>
                            <div class="bg-green-500 text-white p-2 rounded text-sm">2</div>
                            <div class="bg-green-500 text-white p-2 rounded text-sm">3</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4 mt-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.flex-row {
    display: flex;
    flex-direction: row;
    gap: 0.5rem;
}

.flex-column {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}</code></pre>
            </div>
        </div>

        <!-- Justify Content -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Justify Content (Horizontal Alignment)</h2>
            <div class="space-y-4">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Flex Start</h3>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div class="flex justify-start gap-2">
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">A</div>
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">B</div>
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">C</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Center</h3>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div class="flex justify-center gap-2">
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">A</div>
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">B</div>
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">C</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Space Between</h3>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div class="flex justify-between">
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">A</div>
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">B</div>
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">C</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Space Around</h3>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div class="flex justify-around">
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">A</div>
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">B</div>
                            <div class="bg-purple-500 text-white p-2 rounded text-sm">C</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Align Items -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Align Items (Vertical Alignment)</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Flex Start</h3>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 h-32">
                        <div class="flex items-start h-full gap-2">
                            <div class="bg-yellow-500 text-white p-2 rounded text-sm">A</div>
                            <div class="bg-yellow-500 text-white p-2 rounded text-sm">B</div>
                            <div class="bg-yellow-500 text-white p-2 rounded text-sm">C</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Center</h3>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 h-32">
                        <div class="flex items-center h-full gap-2">
                            <div class="bg-yellow-500 text-white p-2 rounded text-sm">A</div>
                            <div class="bg-yellow-500 text-white p-2 rounded text-sm">B</div>
                            <div class="bg-yellow-500 text-white p-2 rounded text-sm">C</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Flex End</h3>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 h-32">
                        <div class="flex items-end h-full gap-2">
                            <div class="bg-yellow-500 text-white p-2 rounded text-sm">A</div>
                            <div class="bg-yellow-500 text-white p-2 rounded text-sm">B</div>
                            <div class="bg-yellow-500 text-white p-2 rounded text-sm">C</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flex Wrap -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Flex Wrap</h2>
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                <div class="flex flex-wrap gap-2">
                    <div class="bg-red-500 text-white p-2 rounded text-sm">Item 1</div>
                    <div class="bg-red-500 text-white p-2 rounded text-sm">Item 2</div>
                    <div class="bg-red-500 text-white p-2 rounded text-sm">Item 3</div>
                    <div class="bg-red-500 text-white p-2 rounded text-sm">Item 4</div>
                    <div class="bg-red-500 text-white p-2 rounded text-sm">Item 5</div>
                    <div class="bg-red-500 text-white p-2 rounded text-sm">Item 6</div>
                    <div class="bg-red-500 text-white p-2 rounded text-sm">Item 7</div>
                    <div class="bg-red-500 text-white p-2 rounded text-sm">Item 8</div>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.flex-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}</code></pre>
            </div>
        </div>

        <!-- Flex Grow/Shrink -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Flex Grow & Shrink</h2>
            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-4">
                <div class="flex gap-2">
                    <div class="bg-indigo-500 text-white p-2 rounded text-sm">Normal</div>
                    <div class="bg-indigo-600 text-white p-2 rounded text-sm flex-1">Flex-1 (Grows)</div>
                    <div class="bg-indigo-500 text-white p-2 rounded text-sm">Normal</div>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="font-medium text-gray-700 mb-2">CSS Code:</h4>
                <pre class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.flex-container {
    display: flex;
    gap: 0.5rem;
}

.flex-grow {
    flex: 1; /* flex-grow: 1; flex-shrink: 1; flex-basis: 0%; */
}</code></pre>
            </div>
        </div>

        <!-- Interactive Flexbox Playground -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Interactive Flexbox Playground</h2>
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Flex Direction:</label>
                        <select id="flexDirection" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="row">Row</option>
                            <option value="column">Column</option>
                            <option value="row-reverse">Row Reverse</option>
                            <option value="column-reverse">Column Reverse</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Justify Content:</label>
                        <select id="justifyContent" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="flex-start">Flex Start</option>
                            <option value="center">Center</option>
                            <option value="flex-end">Flex End</option>
                            <option value="space-between">Space Between</option>
                            <option value="space-around">Space Around</option>
                            <option value="space-evenly">Space Evenly</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Align Items:</label>
                        <select id="alignItems" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="stretch">Stretch</option>
                            <option value="flex-start">Flex Start</option>
                            <option value="center">Center</option>
                            <option value="flex-end">Flex End</option>
                            <option value="baseline">Baseline</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Flex Wrap:</label>
                        <select id="flexWrap" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="nowrap">No Wrap</option>
                            <option value="wrap">Wrap</option>
                            <option value="wrap-reverse">Wrap Reverse</option>
                        </select>
                    </div>
                </div>
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-white" style="min-height: 200px;">
                    <div id="flexPlayground" class="flex gap-2 h-full">
                        <div class="bg-blue-500 text-white p-4 rounded flex items-center justify-center">Item 1</div>
                        <div class="bg-green-500 text-white p-4 rounded flex items-center justify-center">Item 2</div>
                        <div class="bg-purple-500 text-white p-4 rounded flex items-center justify-center">Item 3</div>
                        <div class="bg-red-500 text-white p-4 rounded flex items-center justify-center">Item 4</div>
                    </div>
                </div>
                
                <div class="mt-4 bg-gray-100 rounded-lg p-4">
                    <h4 class="font-medium text-gray-700 mb-2">Generated CSS:</h4>
                    <pre id="generatedCSS" class="bg-gray-800 text-green-400 p-3 rounded text-sm overflow-x-auto"><code>.flex-container {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: stretch;
    flex-wrap: nowrap;
    gap: 0.5rem;
}</code></pre>
                </div>
            </div>
        </div>

        <!-- Common Flexbox Patterns -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Common Flexbox Patterns</h2>
            
            <!-- Card Layout -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Card Layout</h3>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <div class="flex flex-wrap gap-4">
                        <div class="flex-1 min-w-64 bg-white rounded-lg shadow-sm p-4">
                            <h4 class="font-semibold mb-2">Card 1</h4>
                            <p class="text-gray-600">This is a flexible card that adapts to available space.</p>
                        </div>
                        <div class="flex-1 min-w-64 bg-white rounded-lg shadow-sm p-4">
                            <h4 class="font-semibold mb-2">Card 2</h4>
                            <p class="text-gray-600">This card will grow and shrink with the container.</p>
                        </div>
                        <div class="flex-1 min-w-64 bg-white rounded-lg shadow-sm p-4">
                            <h4 class="font-semibold mb-2">Card 3</h4>
                            <p class="text-gray-600">All cards maintain equal width when possible.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Holy Grail Layout -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Holy Grail Layout</h3>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <div class="flex flex-col h-64">
                        <div class="bg-blue-500 text-white p-2 text-center">Header</div>
                        <div class="flex flex-1">
                            <div class="w-48 bg-green-500 text-white p-2">Sidebar</div>
                            <div class="flex-1 bg-white p-2">Main Content</div>
                            <div class="w-48 bg-yellow-500 text-white p-2">Aside</div>
                        </div>
                        <div class="bg-red-500 text-white p-2 text-center">Footer</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const flexDirection = document.getElementById('flexDirection');
    const justifyContent = document.getElementById('justifyContent');
    const alignItems = document.getElementById('alignItems');
    const flexWrap = document.getElementById('flexWrap');
    const flexPlayground = document.getElementById('flexPlayground');
    const generatedCSS = document.getElementById('generatedCSS');
    
    function updateFlexbox() {
        const direction = flexDirection.value;
        const justify = justifyContent.value;
        const align = alignItems.value;
        const wrap = flexWrap.value;
        
        // Apply styles
        flexPlayground.style.flexDirection = direction;
        flexPlayground.style.justifyContent = justify;
        flexPlayground.style.alignItems = align;
        flexPlayground.style.flexWrap = wrap;
        
        // Update CSS display
        const cssCode = `.flex-container {
    display: flex;
    flex-direction: ${direction};
    justify-content: ${justify};
    align-items: ${align};
    flex-wrap: ${wrap};
    gap: 0.5rem;
}`;
        
        generatedCSS.innerHTML = `<code>${cssCode}</code>`;
    }
    
    // Bind events
    flexDirection.addEventListener('change', updateFlexbox);
    justifyContent.addEventListener('change', updateFlexbox);
    alignItems.addEventListener('change', updateFlexbox);
    flexWrap.addEventListener('change', updateFlexbox);
    
    // Initialize
    updateFlexbox();
    
    setTimeout(() => {
        showInfo('Flexbox container examples loaded! Try the interactive playground.');
    }, 1000);
});
</script>
@endsection
