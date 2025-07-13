@extends('layouts.app')

@section('title', 'Image Editor')

@section('content')
<div class="max-w-full mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Browser-Based Image Editor</h1>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Tools Panel -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800">Tools</h2>

                    <!-- File Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image</label>
                        <input type="file" id="imageUpload" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <!-- Filters -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Filters</h3>
                        <div class="space-y-2">
                            <div>
                                <label class="block text-xs text-gray-600">Brightness</label>
                                <input type="range" id="brightness" min="0" max="200" value="100"
                                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-600">Contrast</label>
                                <input type="range" id="contrast" min="0" max="200" value="100"
                                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-600">Saturation</label>
                                <input type="range" id="saturation" min="0" max="200" value="100"
                                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-600">Blur</label>
                                <input type="range" id="blur" min="0" max="10" value="0"
                                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <!-- Transformations -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Transform</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <button onclick="rotateImage(-90)" class="bg-blue-500 hover:bg-blue-600 text-white text-xs py-2 px-3 rounded">
                                Rotate Left
                            </button>
                            <button onclick="rotateImage(90)" class="bg-blue-500 hover:bg-blue-600 text-white text-xs py-2 px-3 rounded">
                                Rotate Right
                            </button>
                            <button onclick="flipImage('horizontal')" class="bg-blue-500 hover:bg-blue-600 text-white text-xs py-2 px-3 rounded">
                                Flip H
                            </button>
                            <button onclick="flipImage('vertical')" class="bg-blue-500 hover:bg-blue-600 text-white text-xs py-2 px-3 rounded">
                                Flip V
                            </button>
                        </div>
                    </div>

                    <!-- Color Effects -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Effects</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <button onclick="applyFilter('grayscale')" class="bg-gray-500 hover:bg-gray-600 text-white text-xs py-2 px-3 rounded">
                                Grayscale
                            </button>
                            <button onclick="applyFilter('sepia')" class="bg-yellow-600 hover:bg-yellow-700 text-white text-xs py-2 px-3 rounded">
                                Sepia
                            </button>
                            <button onclick="applyFilter('invert')" class="bg-purple-500 hover:bg-purple-600 text-white text-xs py-2 px-3 rounded">
                                Invert
                            </button>
                            <button onclick="applyFilter('vintage')" class="bg-orange-500 hover:bg-orange-600 text-white text-xs py-2 px-3 rounded">
                                Vintage
                            </button>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Actions</h3>
                        <div class="space-y-2">
                            <button onclick="resetImage()" class="w-full bg-gray-500 hover:bg-gray-600 text-white text-xs py-2 px-3 rounded">
                                Reset
                            </button>
                            <button onclick="downloadImage()" class="w-full bg-green-500 hover:bg-green-600 text-white text-xs py-2 px-3 rounded">
                                Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Canvas Area -->
            <div class="lg:col-span-3">
                <div class="bg-gray-100 rounded-lg p-4 min-h-96 flex items-center justify-center">
                    <div id="canvasContainer" class="relative">
                        <canvas id="imageCanvas" class="max-w-full max-h-96 border border-gray-300 rounded"></canvas>

                        <!-- Placeholder -->
                        <div id="placeholder" class="flex flex-col items-center justify-center p-8 text-gray-500">
                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-lg font-medium">Upload an image to start editing</p>
                            <p class="text-sm">Supports JPG, PNG, GIF formats</p>
                        </div>
                    </div>
                </div>

                <!-- Image Info -->
                <div id="imageInfo" class="mt-4 text-sm text-gray-600 hidden">
                    <div class="flex items-center space-x-4">
                        <span>Dimensions: <span id="imageDimensions">-</span></span>
                        <span>Size: <span id="imageSize">-</span></span>
                        <span>Format: <span id="imageFormat">-</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Canvas Image Editor Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
class ImageEditor {
    constructor() {
        this.canvas = document.getElementById('imageCanvas');
        this.ctx = this.canvas.getContext('2d');
        this.originalImage = null;
        this.currentImage = null;
        this.filters = {
            brightness: 100,
            contrast: 100,
            saturation: 100,
            blur: 0
        };
        this.transforms = {
            rotation: 0,
            flipH: false,
            flipV: false
        };
        this.init();
    }

    init() {
        this.bindEvents();
    }

    loadImage(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                this.originalImage = img;
                this.currentImage = img;
                this.drawImage();
                this.updateImageInfo(file);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    drawImage() {
        if (!this.currentImage) return;

        // Set canvas size
        this.canvas.width = this.currentImage.width;
        this.canvas.height = this.currentImage.height;

        // Apply transforms
        this.ctx.save();
        this.ctx.translate(this.canvas.width / 2, this.canvas.height / 2);
        this.ctx.rotate(this.transforms.rotation * Math.PI / 180);
        this.ctx.scale(
            this.transforms.flipH ? -1 : 1,
            this.transforms.flipV ? -1 : 1
        );

        // Apply filters
        this.applyFilters();

        // Draw image
        this.ctx.drawImage(
            this.currentImage,
            -this.currentImage.width / 2,
            -this.currentImage.height / 2
        );

        this.ctx.restore();
    }

    applyFilters() {
        const { brightness, contrast, saturation, blur } = this.filters;

        this.ctx.filter = `
            brightness(${brightness}%)
            contrast(${contrast}%)
            saturate(${saturation}%)
            blur(${blur}px)
        `;
    }
}

const imageEditor = new ImageEditor();
        </code></pre>
    </div>
</div>

<script>
class ImageEditor {
    constructor() {
        this.canvas = document.getElementById('imageCanvas');
        this.ctx = this.canvas.getContext('2d');
        this.originalImage = null;
        this.currentImage = null;
        this.filters = {
            brightness: 100,
            contrast: 100,
            saturation: 100,
            blur: 0
        };
        this.transforms = {
            rotation: 0,
            flipH: false,
            flipV: false
        };
        this.effects = [];
        this.init();
    }

    init() {
        this.bindEvents();
        this.canvas.style.display = 'none';
    }

    bindEvents() {
        // File upload
        document.getElementById('imageUpload').addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                this.loadImage(file);
            }
        });

        // Filter controls
        ['brightness', 'contrast', 'saturation', 'blur'].forEach(filter => {
            document.getElementById(filter).addEventListener('input', (e) => {
                this.filters[filter] = e.target.value;
                this.applyFilters();
            });
        });
    }

    loadImage(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                this.originalImage = img;
                this.currentImage = img;
                this.resetFilters();
                this.drawImage();
                this.updateImageInfo(file);
                this.showCanvas();
                showSuccess('Image loaded successfully!');
            };
            img.onerror = () => {
                showError('Failed to load image. Please try a different file.');
            };
            img.src = e.target.result;
        };
        reader.onerror = () => {
            showError('Failed to read file. Please try again.');
        };
        reader.readAsDataURL(file);
    }

    showCanvas() {
        document.getElementById('placeholder').style.display = 'none';
        this.canvas.style.display = 'block';
        document.getElementById('imageInfo').classList.remove('hidden');
    }

    hideCanvas() {
        document.getElementById('placeholder').style.display = 'flex';
        this.canvas.style.display = 'none';
        document.getElementById('imageInfo').classList.add('hidden');
    }

    drawImage() {
        if (!this.currentImage) return;

        // Calculate canvas size maintaining aspect ratio
        const maxWidth = 800;
        const maxHeight = 600;
        let { width, height } = this.currentImage;

        if (width > maxWidth || height > maxHeight) {
            const ratio = Math.min(maxWidth / width, maxHeight / height);
            width *= ratio;
            height *= ratio;
        }

        this.canvas.width = width;
        this.canvas.height = height;

        // Apply transforms
        this.ctx.save();
        this.ctx.translate(width / 2, height / 2);
        this.ctx.rotate(this.transforms.rotation * Math.PI / 180);
        this.ctx.scale(
            this.transforms.flipH ? -1 : 1,
            this.transforms.flipV ? -1 : 1
        );

        // Apply filters
        this.applyFilters();

        // Draw image
        this.ctx.drawImage(
            this.currentImage,
            -width / 2,
            -height / 2,
            width,
            height
        );

        this.ctx.restore();
    }

    applyFilters() {
        const { brightness, contrast, saturation, blur } = this.filters;

        let filterString = `brightness(${brightness}%) contrast(${contrast}%) saturate(${saturation}%) blur(${blur}px)`;

        // Add effects
        this.effects.forEach(effect => {
            filterString += ` ${effect}`;
        });

        this.ctx.filter = filterString;
    }

    resetFilters() {
        this.filters = {
            brightness: 100,
            contrast: 100,
            saturation: 100,
            blur: 0
        };
        this.transforms = {
            rotation: 0,
            flipH: false,
            flipV: false
        };
        this.effects = [];

        // Reset UI controls
        document.getElementById('brightness').value = 100;
        document.getElementById('contrast').value = 100;
        document.getElementById('saturation').value = 100;
        document.getElementById('blur').value = 0;
    }

    updateImageInfo(file) {
        document.getElementById('imageDimensions').textContent =
            `${this.originalImage.width} × ${this.originalImage.height}`;
        document.getElementById('imageSize').textContent =
            `${(file.size / 1024).toFixed(1)} KB`;
        document.getElementById('imageFormat').textContent =
            file.type.split('/')[1].toUpperCase();
    }
}

// Global functions
let imageEditor = new ImageEditor();

function rotateImage(degrees) {
    if (!imageEditor.originalImage) {
        showWarning('Please upload an image first!');
        return;
    }

    imageEditor.transforms.rotation += degrees;
    imageEditor.drawImage();
    showInfo(`Image rotated ${degrees > 0 ? 'right' : 'left'} by ${Math.abs(degrees)}°`);
}

function flipImage(direction) {
    if (!imageEditor.originalImage) {
        showWarning('Please upload an image first!');
        return;
    }

    if (direction === 'horizontal') {
        imageEditor.transforms.flipH = !imageEditor.transforms.flipH;
        showInfo('Image flipped horizontally');
    } else {
        imageEditor.transforms.flipV = !imageEditor.transforms.flipV;
        showInfo('Image flipped vertically');
    }
    imageEditor.drawImage();
}

function applyFilter(filterType) {
    if (!imageEditor.originalImage) {
        showWarning('Please upload an image first!');
        return;
    }

    // Remove existing effects of the same type
    imageEditor.effects = imageEditor.effects.filter(effect =>
        !effect.includes(filterType)
    );

    // Add new effect
    switch(filterType) {
        case 'grayscale':
            imageEditor.effects.push('grayscale(100%)');
            showInfo('Grayscale filter applied');
            break;
        case 'sepia':
            imageEditor.effects.push('sepia(100%)');
            showInfo('Sepia filter applied');
            break;
        case 'invert':
            imageEditor.effects.push('invert(100%)');
            showInfo('Invert filter applied');
            break;
        case 'vintage':
            imageEditor.effects.push('sepia(50%) contrast(120%) brightness(90%)');
            showInfo('Vintage filter applied');
            break;
    }

    imageEditor.drawImage();
}

function resetImage() {
    if (imageEditor.originalImage) {
        imageEditor.resetFilters();
        imageEditor.drawImage();
        showSuccess('Image reset to original!');
    } else {
        showWarning('No image loaded to reset!');
    }
}

function downloadImage() {
    if (imageEditor.canvas && imageEditor.originalImage) {
        const link = document.createElement('a');
        link.download = 'edited-image.png';
        link.href = imageEditor.canvas.toDataURL();
        link.click();
        showSuccess('Image downloaded successfully!');
    } else {
        showWarning('No image to download!');
    }
}

// Drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const canvasContainer = document.getElementById('canvasContainer');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        canvasContainer.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        canvasContainer.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        canvasContainer.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        canvasContainer.classList.add('bg-blue-50', 'border-blue-300');
    }

    function unhighlight(e) {
        canvasContainer.classList.remove('bg-blue-50', 'border-blue-300');
    }

    canvasContainer.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                imageEditor.loadImage(file);
            } else {
                showError('Please drop an image file!');
            }
        }
    }
});
</script>
@endsection
