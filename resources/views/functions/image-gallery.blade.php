@extends('layouts.app')

@section('title', 'Image Gallery')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Image Gallery Component</h1>
        <p class="text-gray-600">Responsive image gallery with lightbox functionality</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        <div x-data="{
            showLightbox: false,
            currentImage: null,
            currentIndex: 0,
            images: {{ json_encode($images) }},
            openLightbox(image, index) {
                this.currentImage = image;
                this.currentIndex = index;
                this.showLightbox = true;
            },
            closeLightbox() {
                this.showLightbox = false;
                this.currentImage = null;
            },
            nextImage() {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
                this.currentImage = this.images[this.currentIndex];
            },
            prevImage() {
                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                this.currentImage = this.images[this.currentIndex];
            }
        }">

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($images as $index => $image)
                <div class="relative group cursor-pointer overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
                     @click="openLightbox({{ json_encode($image) }}, {{ $index }})">
                    <img src="{{ $image['src'] }}"
                         alt="{{ $image['alt'] }}"
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-opacity duration-300 flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Image Title -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                        <h3 class="text-white font-medium text-sm">{{ $image['title'] }}</h3>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Lightbox Modal -->
            <div x-show="showLightbox"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90"
                 @click.self="closeLightbox()"
                 @keydown.escape.window="closeLightbox()"
                 style="display: none;">

                <!-- Close Button -->
                <button @click="closeLightbox()"
                        class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Previous Button -->
                <button @click="prevImage()"
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Next Button -->
                <button @click="nextImage()"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Main Image -->
                <div class="max-w-4xl max-h-full mx-4">
                    <img :src="currentImage?.src"
                         :alt="currentImage?.alt"
                         class="max-w-full max-h-full object-contain">

                    <!-- Image Info -->
                    <div class="text-center mt-4">
                        <h3 class="text-white text-lg font-medium" x-text="currentImage?.title"></h3>
                        <p class="text-gray-300 text-sm mt-1">
                            Image <span x-text="currentIndex + 1"></span> of <span x-text="images.length"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Controls -->
        <div class="mt-6 flex justify-center space-x-4">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                Upload Images
            </button>
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm">
                View All
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Code Example</h2>

        <div class="bg-gray-100 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-800"><code>// Controller
public function imageGallery()
{
    $images = [
        ['id' => 1, 'src' => 'https://picsum.photos/300/200?random=1', 'alt' => 'Random Image 1', 'title' => 'Beautiful Landscape'],
        ['id' => 2, 'src' => 'https://picsum.photos/300/200?random=2', 'alt' => 'Random Image 2', 'title' => 'City Architecture'],
        // ... more images
    ];

    return view('functions.image-gallery', compact('images'));
}

// Blade Template
&lt;div x-data="{
    showLightbox: false,
    currentImage: null,
    currentIndex: 0,
    images: {{ json_encode($images) }},
    openLightbox(image, index) {
        this.currentImage = image;
        this.currentIndex = index;
        this.showLightbox = true;
    },
    closeLightbox() {
        this.showLightbox = false;
        this.currentImage = null;
    },
    nextImage() {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        this.currentImage = this.images[this.currentIndex];
    },
    prevImage() {
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        this.currentImage = this.images[this.currentIndex];
    }
}"&gt;

    &lt;!-- Gallery Grid --&gt;
    &lt;div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"&gt;
        &#64;foreach($images as $index => $image)
        &lt;div class="relative group cursor-pointer overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
             &#64;click="openLightbox({{ json_encode($image) }}, {{ $index }})"&gt;
            &lt;img src="{{ $image['src'] }}"
                 alt="{{ $image['alt'] }}"
                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"&gt;

            &lt;!-- Overlay --&gt;
            &lt;div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-opacity duration-300 flex items-center justify-center"&gt;
                &lt;div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300"&gt;
                    &lt;svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"&gt;
                        &lt;path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"&gt;&lt;/path&gt;
                    &lt;/svg&gt;
                &lt;/div&gt;
            &lt;/div&gt;

            &lt;!-- Image Title --&gt;
            &lt;div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4"&gt;
                &lt;h3 class="text-white font-medium text-sm"&gt;{{ $image['title'] }}&lt;/h3&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &#64;endforeach
    &lt;/div&gt;

    &lt;!-- Lightbox Modal --&gt;
    &lt;div x-show="showLightbox"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90"
         &#64;click.self="closeLightbox()"
         &#64;keydown.escape.window="closeLightbox()"&gt;

        &lt;!-- Navigation Buttons --&gt;
        &lt;button &#64;click="prevImage()"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10"&gt;
            &lt;svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"&gt;
                &lt;path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"&gt;&lt;/path&gt;
            &lt;/svg&gt;
        &lt;/button&gt;

        &lt;!-- Main Image --&gt;
        &lt;div class="max-w-4xl max-h-full mx-4"&gt;
            &lt;img :src="currentImage?.src"
                 :alt="currentImage?.alt"
                 class="max-w-full max-h-full object-contain"&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
        </div>
    </div>
</div>
@endsection
