@extends('layouts.app')

@section('title', 'Pagination')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Pagination Component</h1>
        <p class="text-gray-600">Custom pagination component with navigation controls</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        <!-- Items Display -->
        <div class="mb-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-sm text-gray-600">
                        Showing {{ $pagination['from'] }} to {{ $pagination['to'] }} of {{ $pagination['total'] }} results
                    </p>
                </div>
                <div>
                    <span class="text-sm text-gray-600">Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($items as $item)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <h3 class="font-semibold text-gray-800 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $item['description'] }}</p>
                    <p class="text-gray-500 text-xs">Created: {{ $item['created_at'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination Controls -->
        <div class="flex items-center justify-between border-t border-gray-200 pt-6">
            <div class="flex items-center space-x-2">
                <!-- Previous Page -->
                <a href="{{ $pagination['current_page'] > 1 ? '?page=' . ($pagination['current_page'] - 1) : '#' }}"
                   class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 {{ $pagination['current_page'] <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Previous
                </a>

                <!-- First Page -->
                @if($pagination['current_page'] > 3)
                <a href="?page=1" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">1</a>
                @if($pagination['current_page'] > 4)
                <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700">...</span>
                @endif
                @endif

                <!-- Page Numbers -->
                @for($i = max(1, $pagination['current_page'] - 2); $i <= min($pagination['last_page'], $pagination['current_page'] + 2); $i++)
                <a href="?page={{ $i }}"
                   class="inline-flex items-center px-3 py-2 border rounded-md text-sm font-medium {{ $i == $pagination['current_page'] ? 'bg-blue-500 text-white border-blue-500' : 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50' }}">
                    {{ $i }}
                </a>
                @endfor

                <!-- Last Page -->
                @if($pagination['current_page'] < $pagination['last_page'] - 2)
                @if($pagination['current_page'] < $pagination['last_page'] - 3)
                <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700">...</span>
                @endif
                <a href="?page={{ $pagination['last_page'] }}" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">{{ $pagination['last_page'] }}</a>
                @endif

                <!-- Next Page -->
                <a href="{{ $pagination['current_page'] < $pagination['last_page'] ? '?page=' . ($pagination['current_page'] + 1) : '#' }}"
                   class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 {{ $pagination['current_page'] >= $pagination['last_page'] ? 'opacity-50 cursor-not-allowed' : '' }}">
                    Next
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Quick Navigation -->
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-700">Go to page:</span>
                <input type="number"
                       id="pageInput"
                       min="1"
                       max="{{ $pagination['last_page'] }}"
                       value="{{ $pagination['current_page'] }}"
                       class="w-16 px-2 py-1 border border-gray-300 rounded-md text-sm text-center">
                <button onclick="goToPage()"
                        class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm hover:bg-blue-600">Go</button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Code Example</h2>

        <div class="bg-gray-100 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-800"><code>// Controller
public function pagination()
{
    $allItems = [];
    for ($i = 1; $i <= 100; $i++) {
        $allItems[] = [
            'id' => $i,
            'title' => 'Item ' . $i,
            'description' => 'This is item number ' . $i . ' with some description.',
            'created_at' => now()->subDays(rand(1, 30))->format('Y-m-d'),
        ];
    }

    $currentPage = request()->get('page', 1);
    $perPage = 10;
    $total = count($allItems);
    $offset = ($currentPage - 1) * $perPage;
    $items = array_slice($allItems, $offset, $perPage);

    $pagination = [
        'current_page' => $currentPage,
        'per_page' => $perPage,
        'total' => $total,
        'last_page' => ceil($total / $perPage),
        'from' => $offset + 1,
        'to' => min($offset + $perPage, $total),
    ];

    return view('functions.pagination', compact('items', 'pagination'));
}

// Blade Template
&lt;div class="flex items-center justify-between border-t border-gray-200 pt-6"&gt;
    &lt;div class="flex items-center space-x-2"&gt;
        &lt;!-- Previous Page --&gt;
        &lt;a href="{{ $pagination['current_page'] > 1 ? '?page=' . ($pagination['current_page'] - 1) : '#' }}"
           class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 {{ $pagination['current_page'] <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"&gt;
            Previous
        &lt;/a&gt;

        &lt;!-- Page Numbers --&gt;
        &#64;for($i = max(1, $pagination['current_page'] - 2); $i <= min($pagination['last_page'], $pagination['current_page'] + 2); $i++)
        &lt;a href="?page={{ $i }}"
           class="inline-flex items-center px-3 py-2 border rounded-md text-sm font-medium {{ $i == $pagination['current_page'] ? 'bg-blue-500 text-white border-blue-500' : 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50' }}"&gt;
            {{ $i }}
        &lt;/a&gt;
        &#64;endfor

        &lt;!-- Next Page --&gt;
        &lt;a href="{{ $pagination['current_page'] < $pagination['last_page'] ? '?page=' . ($pagination['current_page'] + 1) : '#' }}"
           class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 {{ $pagination['current_page'] >= $pagination['last_page'] ? 'opacity-50 cursor-not-allowed' : '' }}"&gt;
            Next
        &lt;/a&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
        </div>
    </div>
</div>

<script>
function goToPage() {
    const pageInput = document.getElementById('pageInput');
    const page = parseInt(pageInput.value);
    const maxPage = {{ $pagination['last_page'] }};

    if (page >= 1 && page <= maxPage) {
        window.location.href = '?page=' + page;
    } else {
        alert('Please enter a valid page number between 1 and ' + maxPage);
    }
}
</script>
@endsection
