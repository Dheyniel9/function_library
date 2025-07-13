@extends('layouts.app')

@section('title', 'Advanced Filter')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Advanced Filter Component</h1>
        <p class="text-gray-600">Multi-criteria filtering system with real-time results</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        <div x-data="{
            products: {{ json_encode($products) }},
            filteredProducts: {{ json_encode($products) }},
            filters: {
                category: '',
                brand: '',
                minPrice: '',
                maxPrice: '',
                minRating: ''
            },
            applyFilters() {
                this.filteredProducts = this.products.filter(product => {
                    if (this.filters.category && product.category !== this.filters.category) return false;
                    if (this.filters.brand && product.brand !== this.filters.brand) return false;
                    if (this.filters.minPrice && product.price < this.filters.minPrice) return false;
                    if (this.filters.maxPrice && product.price > this.filters.maxPrice) return false;
                    if (this.filters.minRating && product.rating < this.filters.minRating) return false;
                    return true;
                });
            },
            clearFilters() {
                this.filters = {
                    category: '',
                    brand: '',
                    minPrice: '',
                    maxPrice: '',
                    minRating: ''
                };
                this.filteredProducts = this.products;
            }
        }">
            <!-- Filter Section -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Filters</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select x-model="filters.category" @change="applyFilters()" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                        <select x-model="filters.brand" @change="applyFilters()" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Min Price</label>
                        <input type="number" x-model="filters.minPrice" @input="applyFilters()"
                               class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="0">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Max Price</label>
                        <input type="number" x-model="filters.maxPrice" @input="applyFilters()"
                               class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="9999">
                    </div>

                    <!-- Rating Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Min Rating</label>
                        <select x-model="filters.minRating" @change="applyFilters()" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="">Any Rating</option>
                            <option value="4">4+ Stars</option>
                            <option value="3">3+ Stars</option>
                            <option value="2">2+ Stars</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button @click="clearFilters()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                        Clear Filters
                    </button>
                </div>
            </div>

            <!-- Results Section -->
            <div class="mb-4">
                <p class="text-gray-600">
                    Showing <span x-text="filteredProducts.length"></span> of <span x-text="products.length"></span> products
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="product in filteredProducts" :key="product.id">
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <h4 class="font-semibold text-gray-800 mb-2" x-text="product.name"></h4>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium">Category:</span> <span x-text="product.category"></span></p>
                            <p><span class="font-medium">Brand:</span> <span x-text="product.brand"></span></p>
                            <p><span class="font-medium">Price:</span> $<span x-text="product.price"></span></p>
                            <p><span class="font-medium">Rating:</span> <span x-text="product.rating"></span> ⭐</p>
                        </div>
                    </div>
                </template>
            </div>

            <!-- No Results -->
            <div x-show="filteredProducts.length === 0" class="text-center py-8">
                <p class="text-gray-500 text-lg">No products match your filters.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Code Example</h2>

        <div class="bg-gray-100 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-800"><code>// Controller
public function advancedFilter()
{
    $products = [
        ['id' => 1, 'name' => 'iPhone 15', 'category' => 'Electronics', 'price' => 999, 'brand' => 'Apple', 'rating' => 4.5],
        // ... more products
    ];

    $categories = array_unique(array_column($products, 'category'));
    $brands = array_unique(array_column($products, 'brand'));

    return view('functions.advanced-filter', compact('products', 'categories', 'brands'));
}

// Alpine.js Filter Logic
&lt;div x-data="{
    products: {{ json_encode($products) }},
    filteredProducts: {{ json_encode($products) }},
    filters: {
        category: '',
        brand: '',
        minPrice: '',
        maxPrice: '',
        minRating: ''
    },
    applyFilters() {
        this.filteredProducts = this.products.filter(product => {
            if (this.filters.category && product.category !== this.filters.category) return false;
            if (this.filters.brand && product.brand !== this.filters.brand) return false;
            if (this.filters.minPrice && product.price < this.filters.minPrice) return false;
            if (this.filters.maxPrice && product.price > this.filters.maxPrice) return false;
            if (this.filters.minRating && product.rating < this.filters.minRating) return false;
            return true;
        });
    }
}"&gt;</code></pre>
        </div>
    </div>
</div>
@endsection
