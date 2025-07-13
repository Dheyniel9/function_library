@extends('layouts.app')

@section('title', 'Drag & Drop')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Drag & Drop Sortable List</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Todo List -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">To Do</h2>
                <ul id="todo-list" class="sortable-list min-h-48 bg-gray-50 rounded-lg p-4 space-y-2">
                    <li class="sortable-item bg-white p-3 rounded shadow cursor-move border-l-4 border-red-500">
                        <div class="flex items-center justify-between">
                            <span>Design new landing page</span>
                            <div class="text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </li>
                    <li class="sortable-item bg-white p-3 rounded shadow cursor-move border-l-4 border-red-500">
                        <div class="flex items-center justify-between">
                            <span>Fix responsive issues</span>
                            <div class="text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </li>
                    <li class="sortable-item bg-white p-3 rounded shadow cursor-move border-l-4 border-red-500">
                        <div class="flex items-center justify-between">
                            <span>Update documentation</span>
                            <div class="text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- In Progress List -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">In Progress</h2>
                <ul id="progress-list" class="sortable-list min-h-48 bg-gray-50 rounded-lg p-4 space-y-2">
                    <li class="sortable-item bg-white p-3 rounded shadow cursor-move border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <span>Implement user authentication</span>
                            <div class="text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
            <!-- Done List -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Done</h2>
                <ul id="done-list" class="sortable-list min-h-48 bg-gray-50 rounded-lg p-4 space-y-2">
                    <li class="sortable-item bg-white p-3 rounded shadow cursor-move border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <span>Setup development environment</span>
                            <div class="text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </li>
                    <li class="sortable-item bg-white p-3 rounded shadow cursor-move border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <span>Create project structure</span>
                            <div class="text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Backlog List -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Backlog</h2>
                <ul id="backlog-list" class="sortable-list min-h-48 bg-gray-50 rounded-lg p-4 space-y-2">
                    <li class="sortable-item bg-white p-3 rounded shadow cursor-move border-l-4 border-gray-500">
                        <div class="flex items-center justify-between">
                            <span>Add payment integration</span>
                            <div class="text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </li>
                    <li class="sortable-item bg-white p-3 rounded shadow cursor-move border-l-4 border-gray-500">
                        <div class="flex items-center justify-between">
                            <span>Performance optimization</span>
                            <div class="text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">JavaScript Code:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// Drag & Drop Functionality
let draggedElement = null;

document.addEventListener('DOMContentLoaded', function() {
    const sortableItems = document.querySelectorAll('.sortable-item');
    const sortableLists = document.querySelectorAll('.sortable-list');

    sortableItems.forEach(item => {
        item.draggable = true;

        item.addEventListener('dragstart', function(e) {
            draggedElement = this;
            this.classList.add('opacity-50');
        });

        item.addEventListener('dragend', function(e) {
            this.classList.remove('opacity-50');
            draggedElement = null;
        });
    });

    sortableLists.forEach(list => {
        list.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('bg-blue-100');
        });

        list.addEventListener('dragleave', function(e) {
            this.classList.remove('bg-blue-100');
        });

        list.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('bg-blue-100');

            if (draggedElement) {
                // Update border color based on list
                const listId = this.id;
                const borderColors = {
                    'todo-list': 'border-red-500',
                    'progress-list': 'border-yellow-500',
                    'done-list': 'border-green-500',
                    'backlog-list': 'border-gray-500'
                };

                // Remove old border color
                Object.values(borderColors).forEach(color => {
                    draggedElement.classList.remove(color);
                });

                // Add new border color
                draggedElement.classList.add(borderColors[listId]);

                this.appendChild(draggedElement);
            }
        });
    });
});
        </code></pre>
    </div>
</div>

<script>
// Drag & Drop Functionality
let draggedElement = null;

document.addEventListener('DOMContentLoaded', function() {
    const sortableItems = document.querySelectorAll('.sortable-item');
    const sortableLists = document.querySelectorAll('.sortable-list');

    sortableItems.forEach(item => {
        item.draggable = true;

        item.addEventListener('dragstart', function(e) {
            draggedElement = this;
            this.classList.add('opacity-50');
        });

        item.addEventListener('dragend', function(e) {
            this.classList.remove('opacity-50');
            draggedElement = null;
        });
    });

    sortableLists.forEach(list => {
        list.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('bg-blue-100');
        });

        list.addEventListener('dragleave', function(e) {
            this.classList.remove('bg-blue-100');
        });

        list.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('bg-blue-100');

            if (draggedElement) {
                // Update border color based on list
                const listId = this.id;
                const borderColors = {
                    'todo-list': 'border-red-500',
                    'progress-list': 'border-yellow-500',
                    'done-list': 'border-green-500',
                    'backlog-list': 'border-gray-500'
                };

                // Remove old border color
                Object.values(borderColors).forEach(color => {
                    draggedElement.classList.remove(color);
                });

                // Add new border color
                draggedElement.classList.add(borderColors[listId]);

                this.appendChild(draggedElement);
            }
        });
    });
});
</script>
@endsection
