@extends('layouts.app')

@section('title', 'Progress Tracker')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Project Progress Tracker</h1>
            <button onclick="createProject()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium">
                New Project
            </button>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Projects List -->
            <div class="xl:col-span-1">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Projects</h2>
                <div id="projectsList" class="space-y-3">
                    <!-- Projects will be loaded here -->
                </div>
            </div>

            <!-- Project Details -->
            <div class="xl:col-span-2">
                <div id="projectDetails" class="hidden">
                    <div class="flex items-center justify-between mb-4">
                        <h2 id="projectTitle" class="text-xl font-semibold text-gray-800">Project Title</h2>
                        <div class="flex items-center space-x-2">
                            <button onclick="editProject()" class="text-blue-500 hover:text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteProject()" class="text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Progress Overview -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Overall Progress</span>
                            <span id="overallProgress" class="text-sm font-bold text-blue-600">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div id="progressBar" class="bg-blue-500 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mt-4 text-center">
                            <div>
                                <div id="totalTasks" class="text-2xl font-bold text-gray-800">0</div>
                                <div class="text-xs text-gray-500">Total Tasks</div>
                            </div>
                            <div>
                                <div id="completedTasks" class="text-2xl font-bold text-green-600">0</div>
                                <div class="text-xs text-gray-500">Completed</div>
                            </div>
                            <div>
                                <div id="pendingTasks" class="text-2xl font-bold text-orange-600">0</div>
                                <div class="text-xs text-gray-500">Pending</div>
                            </div>
                        </div>
                    </div>

                    <!-- Task Management -->
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Tasks</h3>
                        <button onclick="addTask()" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                            Add Task
                        </button>
                    </div>

                    <!-- Task Filters -->
                    <div class="flex items-center space-x-4 mb-4">
                        <select id="taskFilter" onchange="filterTasks()" class="border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="all">All Tasks</option>
                            <option value="pending">Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                        <select id="priorityFilter" onchange="filterTasks()" class="border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="all">All Priorities</option>
                            <option value="high">High Priority</option>
                            <option value="medium">Medium Priority</option>
                            <option value="low">Low Priority</option>
                        </select>
                    </div>

                    <!-- Tasks List -->
                    <div id="tasksList" class="space-y-3">
                        <!-- Tasks will be loaded here -->
                    </div>
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="flex flex-col items-center justify-center p-8 text-gray-500">
                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <p class="text-lg font-medium">No project selected</p>
                    <p class="text-sm">Create a new project or select an existing one to start tracking progress</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit Project Modal -->
    <div id="projectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
            <h3 id="modalTitle" class="text-lg font-semibold mb-4">Create New Project</h3>
            <form id="projectForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Project Name</label>
                    <input type="text" id="projectName" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="projectDescription" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <input type="date" id="projectDueDate" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add/Edit Task Modal -->
    <div id="taskModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
            <h3 id="taskModalTitle" class="text-lg font-semibold mb-4">Add New Task</h3>
            <form id="taskForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                    <input type="text" id="taskName" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="taskDescription" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                        <select id="taskPriority" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="taskStatus" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="pending">Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <input type="date" id="taskDueDate" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeTaskModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Progress Tracker Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
class ProgressTracker {
    constructor() {
        this.projects = JSON.parse(localStorage.getItem('projects') || '[]');
        this.currentProject = null;
        this.editingTask = null;
        this.init();
    }

    init() {
        this.loadProjects();
        this.bindEvents();
    }

    createProject(projectData) {
        const project = {
            id: Date.now(),
            name: projectData.name,
            description: projectData.description,
            dueDate: projectData.dueDate,
            createdAt: new Date().toISOString(),
            tasks: []
        };

        this.projects.push(project);
        this.saveProjects();
        this.loadProjects();
        this.selectProject(project.id);
    }

    addTask(taskData) {
        if (!this.currentProject) return;

        const task = {
            id: Date.now(),
            name: taskData.name,
            description: taskData.description,
            priority: taskData.priority,
            status: taskData.status,
            dueDate: taskData.dueDate,
            createdAt: new Date().toISOString(),
            completedAt: taskData.status === 'completed' ? new Date().toISOString() : null
        };

        this.currentProject.tasks.push(task);
        this.saveProjects();
        this.updateProjectDisplay();
    }

    calculateProgress() {
        if (!this.currentProject || this.currentProject.tasks.length === 0) {
            return { total: 0, completed: 0, percentage: 0 };
        }

        const total = this.currentProject.tasks.length;
        const completed = this.currentProject.tasks.filter(task => task.status === 'completed').length;
        const percentage = Math.round((completed / total) * 100);

        return { total, completed, percentage };
    }

    updateTaskStatus(taskId, newStatus) {
        const task = this.currentProject.tasks.find(t => t.id === taskId);
        if (task) {
            task.status = newStatus;
            task.completedAt = newStatus === 'completed' ? new Date().toISOString() : null;
            this.saveProjects();
            this.updateProjectDisplay();
        }
    }

    filterTasks(status, priority) {
        if (!this.currentProject) return [];

        return this.currentProject.tasks.filter(task => {
            const statusMatch = status === 'all' || task.status === status;
            const priorityMatch = priority === 'all' || task.priority === priority;
            return statusMatch && priorityMatch;
        });
    }

    saveProjects() {
        localStorage.setItem('projects', JSON.stringify(this.projects));
    }
}

const progressTracker = new ProgressTracker();
        </code></pre>
    </div>
</div>

<script>
class ProgressTracker {
    constructor() {
        this.projects = JSON.parse(localStorage.getItem('projects') || '[]');
        this.currentProject = null;
        this.editingProject = null;
        this.editingTask = null;
        this.init();
    }

    init() {
        this.loadProjects();
        this.bindEvents();
    }

    bindEvents() {
        // Project form submission
        document.getElementById('projectForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveProject();
        });

        // Task form submission
        document.getElementById('taskForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveTask();
        });

        // Close modals when clicking outside
        document.getElementById('projectModal').addEventListener('click', (e) => {
            if (e.target.id === 'projectModal') {
                this.closeModal();
            }
        });

        document.getElementById('taskModal').addEventListener('click', (e) => {
            if (e.target.id === 'taskModal') {
                this.closeTaskModal();
            }
        });
    }

    loadProjects() {
        const projectsList = document.getElementById('projectsList');

        if (this.projects.length === 0) {
            projectsList.innerHTML = `
                <div class="text-center p-4 text-gray-500">
                    <p>No projects yet</p>
                    <p class="text-sm">Create your first project to get started</p>
                </div>
            `;
            return;
        }

        projectsList.innerHTML = this.projects.map(project => {
            const progress = this.calculateProjectProgress(project);
            return `
                <div class="bg-gray-50 rounded-lg p-4 cursor-pointer hover:bg-gray-100 transition-colors ${
                    this.currentProject && this.currentProject.id === project.id ? 'ring-2 ring-blue-500' : ''
                }" onclick="progressTracker.selectProject(${project.id})">
                    <h3 class="font-semibold text-gray-800">${project.name}</h3>
                    <p class="text-sm text-gray-600 mb-2">${project.description}</p>
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-gray-500">
                            ${project.tasks.length} tasks
                        </div>
                        <div class="text-xs font-medium ${
                            progress.percentage === 100 ? 'text-green-600' :
                            progress.percentage > 0 ? 'text-blue-600' : 'text-gray-600'
                        }">
                            ${progress.percentage}%
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1 mt-2">
                        <div class="bg-blue-500 h-1 rounded-full transition-all duration-300" style="width: ${progress.percentage}%"></div>
                    </div>
                </div>
            `;
        }).join('');
    }

    selectProject(projectId) {
        this.currentProject = this.projects.find(p => p.id === projectId);
        this.updateProjectDisplay();
    }

    updateProjectDisplay() {
        if (!this.currentProject) {
            document.getElementById('projectDetails').classList.add('hidden');
            document.getElementById('emptyState').classList.remove('hidden');
            return;
        }

        document.getElementById('emptyState').classList.add('hidden');
        document.getElementById('projectDetails').classList.remove('hidden');

        // Update project title
        document.getElementById('projectTitle').textContent = this.currentProject.name;

        // Update progress
        const progress = this.calculateProjectProgress(this.currentProject);
        document.getElementById('overallProgress').textContent = `${progress.percentage}%`;
        document.getElementById('progressBar').style.width = `${progress.percentage}%`;
        document.getElementById('totalTasks').textContent = progress.total;
        document.getElementById('completedTasks').textContent = progress.completed;
        document.getElementById('pendingTasks').textContent = progress.total - progress.completed;

        // Update tasks
        this.displayTasks();

        // Update projects list to show selection
        this.loadProjects();
    }

    displayTasks() {
        if (!this.currentProject) return;

        const statusFilter = document.getElementById('taskFilter').value;
        const priorityFilter = document.getElementById('priorityFilter').value;

        const filteredTasks = this.currentProject.tasks.filter(task => {
            const statusMatch = statusFilter === 'all' || task.status === statusFilter;
            const priorityMatch = priorityFilter === 'all' || task.priority === priorityFilter;
            return statusMatch && priorityMatch;
        });

        const tasksList = document.getElementById('tasksList');

        if (filteredTasks.length === 0) {
            tasksList.innerHTML = `
                <div class="text-center p-4 text-gray-500">
                    <p>No tasks found</p>
                    <p class="text-sm">Add a task to get started</p>
                </div>
            `;
            return;
        }

        tasksList.innerHTML = filteredTasks.map(task => {
            const priorityColors = {
                high: 'bg-red-100 text-red-800',
                medium: 'bg-yellow-100 text-yellow-800',
                low: 'bg-green-100 text-green-800'
            };

            const statusColors = {
                pending: 'bg-gray-100 text-gray-800',
                'in-progress': 'bg-blue-100 text-blue-800',
                completed: 'bg-green-100 text-green-800'
            };

            return `
                <div class="bg-white border border-gray-200 rounded-lg p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <input type="checkbox" ${task.status === 'completed' ? 'checked' : ''}
                                       onchange="progressTracker.toggleTaskStatus(${task.id}, this.checked)"
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <h4 class="font-semibold text-gray-800 ${task.status === 'completed' ? 'line-through text-gray-500' : ''}">${task.name}</h4>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">${task.description}</p>
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 rounded text-xs font-medium ${priorityColors[task.priority]}">
                                    ${task.priority.charAt(0).toUpperCase() + task.priority.slice(1)}
                                </span>
                                <span class="px-2 py-1 rounded text-xs font-medium ${statusColors[task.status]}">
                                    ${task.status.replace('-', ' ').charAt(0).toUpperCase() + task.status.replace('-', ' ').slice(1)}
                                </span>
                                ${task.dueDate ? `<span class="text-xs text-gray-500">Due: ${new Date(task.dueDate).toLocaleDateString()}</span>` : ''}
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <button onclick="progressTracker.editTask(${task.id})" class="text-blue-500 hover:text-blue-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="progressTracker.deleteTask(${task.id})" class="text-red-500 hover:text-red-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

    calculateProjectProgress(project) {
        if (!project || project.tasks.length === 0) {
            return { total: 0, completed: 0, percentage: 0 };
        }

        const total = project.tasks.length;
        const completed = project.tasks.filter(task => task.status === 'completed').length;
        const percentage = Math.round((completed / total) * 100);

        return { total, completed, percentage };
    }

    toggleTaskStatus(taskId, isCompleted) {
        const task = this.currentProject.tasks.find(t => t.id === taskId);
        if (task) {
            task.status = isCompleted ? 'completed' : 'pending';
            task.completedAt = isCompleted ? new Date().toISOString() : null;
            this.saveProjects();
            this.updateProjectDisplay();
        }
    }

    saveProject() {
        const name = document.getElementById('projectName').value;
        const description = document.getElementById('projectDescription').value;
        const dueDate = document.getElementById('projectDueDate').value;

        if (!name) {
            alert('Please enter a project name');
            return;
        }

        if (this.editingProject) {
            // Update existing project
            this.editingProject.name = name;
            this.editingProject.description = description;
            this.editingProject.dueDate = dueDate;
        } else {
            // Create new project
            const project = {
                id: Date.now(),
                name,
                description,
                dueDate,
                createdAt: new Date().toISOString(),
                tasks: []
            };
            this.projects.push(project);
            this.currentProject = project;
        }

        this.saveProjects();
        this.loadProjects();
        this.updateProjectDisplay();
        this.closeModal();
    }

    saveTask() {
        const name = document.getElementById('taskName').value;
        const description = document.getElementById('taskDescription').value;
        const priority = document.getElementById('taskPriority').value;
        const status = document.getElementById('taskStatus').value;
        const dueDate = document.getElementById('taskDueDate').value;

        if (!name) {
            alert('Please enter a task name');
            return;
        }

        if (this.editingTask) {
            // Update existing task
            this.editingTask.name = name;
            this.editingTask.description = description;
            this.editingTask.priority = priority;
            this.editingTask.status = status;
            this.editingTask.dueDate = dueDate;
            this.editingTask.completedAt = status === 'completed' ? new Date().toISOString() : null;
        } else {
            // Create new task
            const task = {
                id: Date.now(),
                name,
                description,
                priority,
                status,
                dueDate,
                createdAt: new Date().toISOString(),
                completedAt: status === 'completed' ? new Date().toISOString() : null
            };
            this.currentProject.tasks.push(task);
        }

        this.saveProjects();
        this.updateProjectDisplay();
        this.closeTaskModal();
    }

    editProject() {
        if (!this.currentProject) return;

        this.editingProject = this.currentProject;
        document.getElementById('modalTitle').textContent = 'Edit Project';
        document.getElementById('projectName').value = this.currentProject.name;
        document.getElementById('projectDescription').value = this.currentProject.description;
        document.getElementById('projectDueDate').value = this.currentProject.dueDate;

        document.getElementById('projectModal').classList.remove('hidden');
        document.getElementById('projectModal').classList.add('flex');
    }

    editTask(taskId) {
        const task = this.currentProject.tasks.find(t => t.id === taskId);
        if (!task) return;

        this.editingTask = task;
        document.getElementById('taskModalTitle').textContent = 'Edit Task';
        document.getElementById('taskName').value = task.name;
        document.getElementById('taskDescription').value = task.description;
        document.getElementById('taskPriority').value = task.priority;
        document.getElementById('taskStatus').value = task.status;
        document.getElementById('taskDueDate').value = task.dueDate;

        document.getElementById('taskModal').classList.remove('hidden');
        document.getElementById('taskModal').classList.add('flex');
    }

    deleteProject() {
        if (!this.currentProject) return;

        if (confirm('Are you sure you want to delete this project?')) {
            this.projects = this.projects.filter(p => p.id !== this.currentProject.id);
            this.currentProject = null;
            this.saveProjects();
            this.loadProjects();
            this.updateProjectDisplay();
        }
    }

    deleteTask(taskId) {
        if (confirm('Are you sure you want to delete this task?')) {
            this.currentProject.tasks = this.currentProject.tasks.filter(t => t.id !== taskId);
            this.saveProjects();
            this.updateProjectDisplay();
        }
    }

    closeModal() {
        this.editingProject = null;
        document.getElementById('projectModal').classList.add('hidden');
        document.getElementById('projectModal').classList.remove('flex');
        document.getElementById('projectForm').reset();
    }

    closeTaskModal() {
        this.editingTask = null;
        document.getElementById('taskModal').classList.add('hidden');
        document.getElementById('taskModal').classList.remove('flex');
        document.getElementById('taskForm').reset();
    }

    saveProjects() {
        localStorage.setItem('projects', JSON.stringify(this.projects));
    }
}

// Initialize progress tracker
const progressTracker = new ProgressTracker();

// Global functions
function createProject() {
    progressTracker.editingProject = null;
    document.getElementById('modalTitle').textContent = 'Create New Project';
    document.getElementById('projectForm').reset();
    document.getElementById('projectModal').classList.remove('hidden');
    document.getElementById('projectModal').classList.add('flex');
}

function addTask() {
    if (!progressTracker.currentProject) {
        alert('Please select a project first');
        return;
    }

    progressTracker.editingTask = null;
    document.getElementById('taskModalTitle').textContent = 'Add New Task';
    document.getElementById('taskForm').reset();
    document.getElementById('taskModal').classList.remove('hidden');
    document.getElementById('taskModal').classList.add('flex');
}

function filterTasks() {
    progressTracker.displayTasks();
}

function editProject() {
    progressTracker.editProject();
}

function deleteProject() {
    progressTracker.deleteProject();
}

function closeModal() {
    progressTracker.closeModal();
}

function closeTaskModal() {
    progressTracker.closeTaskModal();
}

// Initialize with sample data if no projects exist
document.addEventListener('DOMContentLoaded', function() {
    if (progressTracker.projects.length === 0) {
        // Add sample project
        const sampleProject = {
            id: Date.now(),
            name: 'Sample Project',
            description: 'This is a sample project to demonstrate the progress tracker',
            dueDate: '2024-12-31',
            createdAt: new Date().toISOString(),
            tasks: [
                {
                    id: Date.now() + 1,
                    name: 'Project Planning',
                    description: 'Define project scope and requirements',
                    priority: 'high',
                    status: 'completed',
                    dueDate: '2024-01-15',
                    createdAt: new Date().toISOString(),
                    completedAt: new Date().toISOString()
                },
                {
                    id: Date.now() + 2,
                    name: 'Design Phase',
                    description: 'Create wireframes and mockups',
                    priority: 'medium',
                    status: 'in-progress',
                    dueDate: '2024-02-01',
                    createdAt: new Date().toISOString(),
                    completedAt: null
                },
                {
                    id: Date.now() + 3,
                    name: 'Development',
                    description: 'Implement the core functionality',
                    priority: 'high',
                    status: 'pending',
                    dueDate: '2024-03-01',
                    createdAt: new Date().toISOString(),
                    completedAt: null
                }
            ]
        };

        progressTracker.projects.push(sampleProject);
        progressTracker.saveProjects();
        progressTracker.loadProjects();
    }
});
</script>
@endsection
