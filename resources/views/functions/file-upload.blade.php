@extends('layouts.app')

@section('title', 'File Upload')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">File Upload with Preview</h1>

        <!-- Drag & Drop Upload Area -->
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center" id="drop-zone">
            <div class="mb-4">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <p class="text-xl text-gray-600 mb-2">Drag and drop files here</p>
            <p class="text-gray-500 mb-4">or</p>
            <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg" onclick="document.getElementById('file-input').click()">
                Browse Files
            </button>
            <input type="file" id="file-input" class="hidden" multiple accept="image/*,.pdf,.doc,.docx">
        </div>

        <!-- File Preview Area -->
        <div id="file-preview" class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" style="display: none;">
            <!-- File previews will be added here -->
        </div>

        <!-- Upload Progress -->
        <div id="upload-progress" class="mt-6" style="display: none;">
            <div class="bg-gray-200 rounded-full h-4">
                <div id="progress-bar" class="bg-blue-500 h-4 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
            <p class="text-sm text-gray-600 mt-2">Uploading... <span id="progress-text">0%</span></p>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">JavaScript Code:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// Drag & Drop File Upload
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('file-input');
const filePreview = document.getElementById('file-preview');

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-blue-500', 'bg-blue-50');
});

dropZone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-blue-500', 'bg-blue-50');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-blue-500', 'bg-blue-50');
    const files = e.dataTransfer.files;
    handleFiles(files);
});

fileInput.addEventListener('change', (e) => {
    handleFiles(e.target.files);
});

function handleFiles(files) {
    filePreview.style.display = 'grid';
    filePreview.innerHTML = '';

    Array.from(files).forEach(file => {
        const fileItem = createFilePreview(file);
        filePreview.appendChild(fileItem);
    });

    simulateUpload();
}

function createFilePreview(file) {
    const div = document.createElement('div');
    div.className = 'bg-white border rounded-lg p-4';

    if (file.type.startsWith('image/')) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = 'w-full h-32 object-cover rounded mb-2';
        div.appendChild(img);
    }

    const fileName = document.createElement('p');
    fileName.textContent = file.name;
    fileName.className = 'text-sm font-medium text-gray-800 truncate';
    div.appendChild(fileName);

    const fileSize = document.createElement('p');
    fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
    fileSize.className = 'text-xs text-gray-500';
    div.appendChild(fileSize);

    return div;
}

function simulateUpload() {
    const progressContainer = document.getElementById('upload-progress');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');

    progressContainer.style.display = 'block';

    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 20;
        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);
        }

        progressBar.style.width = progress + '%';
        progressText.textContent = Math.round(progress) + '%';

        if (progress === 100) {
            setTimeout(() => {
                progressContainer.style.display = 'none';
            }, 1000);
        }
    }, 200);
}
        </code></pre>
    </div>
</div>

<script>
// Drag & Drop File Upload
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('file-input');
const filePreview = document.getElementById('file-preview');

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-blue-500', 'bg-blue-50');
});

dropZone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-blue-500', 'bg-blue-50');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-blue-500', 'bg-blue-50');
    const files = e.dataTransfer.files;
    handleFiles(files);
});

fileInput.addEventListener('change', (e) => {
    handleFiles(e.target.files);
});

function handleFiles(files) {
    filePreview.style.display = 'grid';
    filePreview.innerHTML = '';

    Array.from(files).forEach(file => {
        const fileItem = createFilePreview(file);
        filePreview.appendChild(fileItem);
    });

    simulateUpload();
}

function createFilePreview(file) {
    const div = document.createElement('div');
    div.className = 'bg-white border rounded-lg p-4';

    if (file.type.startsWith('image/')) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = 'w-full h-32 object-cover rounded mb-2';
        div.appendChild(img);
    }

    const fileName = document.createElement('p');
    fileName.textContent = file.name;
    fileName.className = 'text-sm font-medium text-gray-800 truncate';
    div.appendChild(fileName);

    const fileSize = document.createElement('p');
    fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
    fileSize.className = 'text-xs text-gray-500';
    div.appendChild(fileSize);

    return div;
}

function simulateUpload() {
    const progressContainer = document.getElementById('upload-progress');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');

    progressContainer.style.display = 'block';

    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 20;
        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);
        }

        progressBar.style.width = progress + '%';
        progressText.textContent = Math.round(progress) + '%';

        if (progress === 100) {
            setTimeout(() => {
                progressContainer.style.display = 'none';
            }, 1000);
        }
    }, 200);
}
</script>
@endsection
