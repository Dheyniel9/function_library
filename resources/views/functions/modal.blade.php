@extends('layouts.app')

@section('title', 'Modal')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Modal Component</h1>
        <p class="text-gray-600">Responsive modal dialogs with backdrop and animations</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        <div x-data="{
            showModal: false,
            modalTitle: '',
            modalContent: '',
            openModal(title, content) {
                this.modalTitle = title;
                this.modalContent = content;
                this.showModal = true;
            }
        }">
            <!-- Trigger Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                @foreach($items as $item)
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($item['description'], 50) }}</p>
                    <button @click="openModal('{{ $item['title'] }}', '{{ $item['description'] }}')"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                        View Details
                    </button>
                </div>
                @endforeach
            </div>

            <!-- Additional Modal Types -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-800">Different Modal Types</h3>

                <div class="flex flex-wrap gap-4">
                    <button @click="openModal('Confirmation', 'Are you sure you want to delete this item? This action cannot be undone.')"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                        Delete Confirmation
                    </button>

                    <button @click="openModal('Success Message', 'Your changes have been saved successfully!')"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                        Success Modal
                    </button>

                    <button @click="openModal('Warning', 'This action will affect multiple records. Please review before proceeding.')"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">
                        Warning Modal
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div x-show="showModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 overflow-y-auto"
                 style="display: none;">

                <!-- Background Overlay -->
                <div class="fixed inset-0 bg-black bg-opacity-50"
                     @click="showModal = false"></div>

                <!-- Modal Dialog -->
                <div class="flex items-center justify-center min-h-screen px-4 py-8">
                    <div x-show="showModal"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">

                        <!-- Modal Header -->
                        <div class="flex items-center justify-between p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800" x-text="modalTitle"></h3>
                            <button @click="showModal = false"
                                    class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="p-6">
                            <p class="text-gray-600" x-text="modalContent"></p>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-end space-x-4 p-6 border-t border-gray-200">
                            <button @click="showModal = false"
                                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                                Cancel
                            </button>
                            <button @click="showModal = false"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Confirm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Code Example</h2>

        <div class="bg-gray-100 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-800"><code>// Controller
public function modal()
{
    $items = [
        ['id' => 1, 'title' => 'Product 1', 'description' => 'This is the first product with detailed information.'],
        // ... more items
    ];

    return view('functions.modal', compact('items'));
}

// Blade Template
&lt;div x-data="{
    showModal: false,
    modalTitle: '',
    modalContent: '',
    openModal(title, content) {
        this.modalTitle = title;
        this.modalContent = content;
        this.showModal = true;
    }
}"&gt;
    &lt;!-- Trigger Button --&gt;
    &lt;button &#64;click="openModal('Title', 'Content')"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md"&gt;
        Open Modal
    &lt;/button&gt;

    &lt;!-- Modal --&gt;
    &lt;div x-show="showModal"
         x-transition
         class="fixed inset-0 z-50 overflow-y-auto"&gt;

        &lt;!-- Background Overlay --&gt;
        &lt;div class="fixed inset-0 bg-black bg-opacity-50"
             &#64;click="showModal = false"&gt;&lt;/div&gt;

        &lt;!-- Modal Dialog --&gt;
        &lt;div class="flex items-center justify-center min-h-screen px-4 py-8"&gt;
            &lt;div x-show="showModal"
                 x-transition
                 class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4"&gt;

                &lt;!-- Modal Header --&gt;
                &lt;div class="flex items-center justify-between p-6 border-b border-gray-200"&gt;
                    &lt;h3 class="text-lg font-semibold text-gray-800" x-text="modalTitle"&gt;&lt;/h3&gt;
                    &lt;button &#64;click="showModal = false"
                            class="text-gray-400 hover:text-gray-600"&gt;
                        &lt;svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"&gt;
                            &lt;path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"&gt;&lt;/path&gt;
                        &lt;/svg&gt;
                    &lt;/button&gt;
                &lt;/div&gt;

                &lt;!-- Modal Body --&gt;
                &lt;div class="p-6"&gt;
                    &lt;p class="text-gray-600" x-text="modalContent"&gt;&lt;/p&gt;
                &lt;/div&gt;

                &lt;!-- Modal Footer --&gt;
                &lt;div class="flex justify-end space-x-4 p-6 border-t border-gray-200"&gt;
                    &lt;button &#64;click="showModal = false"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md"&gt;
                        Cancel
                    &lt;/button&gt;
                    &lt;button &#64;click="showModal = false"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md"&gt;
                        Confirm
                    &lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
        </div>
    </div>
</div>
@endsection
