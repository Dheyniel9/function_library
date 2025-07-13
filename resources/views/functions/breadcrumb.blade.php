@extends('layouts.app')

@section('title', 'Breadcrumb')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Navigation Breadcrumb</h1>

        <!-- Example Breadcrumbs -->
        <div class="space-y-6">
            <!-- Style 1: Default -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Style 1: Default</h2>
                <nav class="breadcrumb-default" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="#" class="text-blue-600 hover:text-blue-800">Home</a></li>
                        <li class="text-gray-500">/</li>
                        <li><a href="#" class="text-blue-600 hover:text-blue-800">Products</a></li>
                        <li class="text-gray-500">/</li>
                        <li><a href="#" class="text-blue-600 hover:text-blue-800">Electronics</a></li>
                        <li class="text-gray-500">/</li>
                        <li class="text-gray-500" aria-current="page">Smartphones</li>
                    </ol>
                </nav>
            </div>

            <!-- Style 2: With Icons -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Style 2: With Icons</h2>
                <nav class="breadcrumb-icons" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            <a href="#" class="text-blue-600 hover:text-blue-800">Home</a>
                        </li>
                        <li class="text-gray-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path>
                            </svg>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"></path>
                            </svg>
                            <a href="#" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                        </li>
                        <li class="text-gray-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path>
                            </svg>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"></path>
                            </svg>
                            <a href="#" class="text-blue-600 hover:text-blue-800">Settings</a>
                        </li>
                        <li class="text-gray-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path>
                            </svg>
                        </li>
                        <li class="text-gray-500" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>

            <!-- Style 3: Pill Style -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Style 3: Pill Style</h2>
                <nav class="breadcrumb-pills" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="#" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm hover:bg-blue-200">Home</a></li>
                        <li class="text-gray-400">›</li>
                        <li><a href="#" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm hover:bg-blue-200">Library</a></li>
                        <li class="text-gray-400">›</li>
                        <li><a href="#" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm hover:bg-blue-200">Books</a></li>
                        <li class="text-gray-400">›</li>
                        <li class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm" aria-current="page">JavaScript Guide</li>
                    </ol>
                </nav>
            </div>

            <!-- Style 4: Background Style -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Style 4: Background Style</h2>
                <nav class="breadcrumb-background bg-gray-100 rounded-lg p-3" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-1">
                        <li><a href="#" class="bg-white px-3 py-2 rounded text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600">Admin</a></li>
                        <li class="text-gray-500 px-1">/</li>
                        <li><a href="#" class="bg-white px-3 py-2 rounded text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600">Users</a></li>
                        <li class="text-gray-500 px-1">/</li>
                        <li><a href="#" class="bg-white px-3 py-2 rounded text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600">Management</a></li>
                        <li class="text-gray-500 px-1">/</li>
                        <li class="bg-blue-500 text-white px-3 py-2 rounded text-sm" aria-current="page">Edit User</li>
                    </ol>
                </nav>
            </div>

            <!-- Interactive Breadcrumb Builder -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Interactive Breadcrumb Builder</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Add Breadcrumb Item</h3>
                        <form id="breadcrumbForm" class="space-y-3">
                            <input type="text" id="breadcrumbText" placeholder="Item text"
                                   class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500">
                            <input type="url" id="breadcrumbLink" placeholder="Item link (optional)"
                                   class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500">
                            <div class="flex space-x-2">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                                    Add Item
                                </button>
                                <button type="button" onclick="clearBreadcrumbs()"
                                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">
                                    Clear All
                                </button>
                            </div>
                        </form>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Preview</h3>
                        <div class="bg-white border rounded-lg p-4 min-h-16">
                            <nav id="dynamicBreadcrumb" aria-label="Dynamic Breadcrumb">
                                <ol id="breadcrumbList" class="flex items-center space-x-2">
                                    <!-- Dynamic breadcrumb items will appear here -->
                                </ol>
                            </nav>
                        </div>

                        <div class="mt-3">
                            <button onclick="generateCode()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">
                                Generate HTML Code
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Generated Code Modal -->
    <div id="codeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl max-h-96 overflow-auto">
            <h3 class="text-xl font-semibold mb-4">Generated HTML Code</h3>
            <pre id="generatedCode" class="bg-gray-100 p-4 rounded text-sm overflow-x-auto"></pre>
            <div class="flex justify-end space-x-2 mt-4">
                <button onclick="copyCode()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Copy Code
                </button>
                <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">HTML Structure:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
&lt;!-- Basic Breadcrumb --&gt;
&lt;nav aria-label="Breadcrumb"&gt;
    &lt;ol class="flex items-center space-x-2"&gt;
        &lt;li&gt;&lt;a href="#" class="text-blue-600 hover:text-blue-800"&gt;Home&lt;/a&gt;&lt;/li&gt;
        &lt;li class="text-gray-500"&gt;/&lt;/li&gt;
        &lt;li&gt;&lt;a href="#" class="text-blue-600 hover:text-blue-800"&gt;Products&lt;/a&gt;&lt;/li&gt;
        &lt;li class="text-gray-500"&gt;/&lt;/li&gt;
        &lt;li class="text-gray-500" aria-current="page"&gt;Current Page&lt;/li&gt;
    &lt;/ol&gt;
&lt;/nav&gt;

&lt;!-- With Icons --&gt;
&lt;nav aria-label="Breadcrumb"&gt;
    &lt;ol class="flex items-center space-x-2"&gt;
        &lt;li class="flex items-center"&gt;
            &lt;svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"&gt;
                &lt;path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17..."&gt;&lt;/path&gt;
            &lt;/svg&gt;
            &lt;a href="#" class="text-blue-600 hover:text-blue-800"&gt;Home&lt;/a&gt;
        &lt;/li&gt;
        &lt;li class="text-gray-500"&gt;
            &lt;svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"&gt;
                &lt;path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10..."&gt;&lt;/path&gt;
            &lt;/svg&gt;
        &lt;/li&gt;
        &lt;li class="text-gray-500" aria-current="page"&gt;Current Page&lt;/li&gt;
    &lt;/ol&gt;
&lt;/nav&gt;
        </code></pre>
    </div>
</div>

<script>
let breadcrumbItems = [];

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('breadcrumbForm').addEventListener('submit', handleAddBreadcrumb);
});

function handleAddBreadcrumb(e) {
    e.preventDefault();

    const text = document.getElementById('breadcrumbText').value;
    const link = document.getElementById('breadcrumbLink').value;

    if (!text) {
        alert('Please enter item text');
        return;
    }

    breadcrumbItems.push({
        text: text,
        link: link || null
    });

    renderBreadcrumb();

    // Clear form
    document.getElementById('breadcrumbText').value = '';
    document.getElementById('breadcrumbLink').value = '';
}

function renderBreadcrumb() {
    const breadcrumbList = document.getElementById('breadcrumbList');
    breadcrumbList.innerHTML = '';

    breadcrumbItems.forEach((item, index) => {
        // Create list item
        const li = document.createElement('li');

        if (index === breadcrumbItems.length - 1) {
            // Last item (current page)
            li.className = 'text-gray-500';
            li.setAttribute('aria-current', 'page');
            li.textContent = item.text;
        } else {
            // Regular item
            if (item.link) {
                const link = document.createElement('a');
                link.href = item.link;
                link.className = 'text-blue-600 hover:text-blue-800';
                link.textContent = item.text;
                li.appendChild(link);
            } else {
                li.className = 'text-blue-600';
                li.textContent = item.text;
            }
        }

        breadcrumbList.appendChild(li);

        // Add separator (except for last item)
        if (index < breadcrumbItems.length - 1) {
            const separator = document.createElement('li');
            separator.className = 'text-gray-500';
            separator.textContent = '/';
            breadcrumbList.appendChild(separator);
        }
    });
}

function clearBreadcrumbs() {
    breadcrumbItems = [];
    renderBreadcrumb();
}

function generateCode() {
    if (breadcrumbItems.length === 0) {
        alert('Please add some breadcrumb items first');
        return;
    }

    let html = '<nav aria-label="Breadcrumb">\n    <ol class="flex items-center space-x-2">\n';

    breadcrumbItems.forEach((item, index) => {
        if (index === breadcrumbItems.length - 1) {
            // Last item
            html += `        <li class="text-gray-500" aria-current="page">${item.text}</li>\n`;
        } else {
            // Regular item
            if (item.link) {
                html += `        <li><a href="${item.link}" class="text-blue-600 hover:text-blue-800">${item.text}</a></li>\n`;
            } else {
                html += `        <li class="text-blue-600">${item.text}</li>\n`;
            }

            // Add separator
            html += '        <li class="text-gray-500">/</li>\n';
        }
    });

    html += '    </ol>\n</nav>';

    document.getElementById('generatedCode').textContent = html;
    document.getElementById('codeModal').classList.remove('hidden');
    document.getElementById('codeModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('codeModal').classList.add('hidden');
    document.getElementById('codeModal').classList.remove('flex');
}

function copyCode() {
    const code = document.getElementById('generatedCode').textContent;
    navigator.clipboard.writeText(code).then(() => {
        alert('Code copied to clipboard!');
    });
}

// Close modal when clicking outside
document.getElementById('codeModal').addEventListener('click', function(e) {
    if (e.target.id === 'codeModal') {
        closeModal();
    }
});
</script>
@endsection
