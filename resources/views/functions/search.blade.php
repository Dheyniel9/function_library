@extends('layouts.app')

@section('title', 'Search')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Search Component</h1>
        <p class="text-gray-600">Real-time search functionality with filtering and highlighting</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        <!-- Search Form -->
        <form method="GET" action="{{ route('functions.search') }}" class="mb-6">
            <div class="flex gap-4">
                <div class="flex-1">
                    <input type="text"
                           name="q"
                           value="{{ $query }}"
                           placeholder="Search users by name, email, or department..."
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           x-data="{ query: '{{ $query }}' }"
                           x-model="query">
                </div>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium">
                    Search
                </button>
                @if($query)
                <a href="{{ route('functions.search') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium">
                    Clear
                </a>
                @endif
            </div>
        </form>

        <!-- Search Results -->
        <div>
            @if($query)
            <div class="mb-4">
                <p class="text-gray-600">
                    @if(count($users) > 0)
                    Found {{ count($users) }} result{{ count($users) != 1 ? 's' : '' }} for "<strong>{{ $query }}</strong>"
                    @else
                    No results found for "<strong>{{ $query }}</strong>"
                    @endif
                </p>
            </div>
            @endif

            @if(count($users) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($users as $user)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-medium">
                            {{ strtoupper(substr($user['name'], 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">
                                @if($query)
                                    {!! str_ireplace($query, '<mark class="bg-yellow-200">' . $query . '</mark>', $user['name']) !!}
                                @else
                                    {{ $user['name'] }}
                                @endif
                            </h3>
                            <p class="text-sm text-gray-600">
                                @if($query)
                                    {!! str_ireplace($query, '<mark class="bg-yellow-200">' . $query . '</mark>', $user['email']) !!}
                                @else
                                    {{ $user['email'] }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            @if($query)
                                {!! str_ireplace($query, '<mark class="bg-yellow-200">' . $query . '</mark>', $user['department']) !!}
                            @else
                                {{ $user['department'] }}
                            @endif
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @elseif($query)
            <div class="text-center py-8">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-gray-500 text-lg">No results found</p>
                <p class="text-gray-400 text-sm mt-1">Try adjusting your search terms</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($users as $user)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-medium">
                            {{ strtoupper(substr($user['name'], 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $user['name'] }}</h3>
                            <p class="text-sm text-gray-600">{{ $user['email'] }}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $user['department'] }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Code Example</h2>

        <div class="bg-gray-100 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-800"><code>// Controller
public function search()
{
    $query = request()->get('q');
    $allUsers = [
        ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'department' => 'IT'],
        ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'department' => 'HR'],
        // ... more users
    ];

    $users = $allUsers;
    if ($query) {
        $users = array_filter($allUsers, function($user) use ($query) {
            return stripos($user['name'], $query) !== false ||
                   stripos($user['email'], $query) !== false ||
                   stripos($user['department'], $query) !== false;
        });
    }

    return view('functions.search', compact('users', 'query'));
}

// Blade Template
&lt;form method="GET" action="{{ route('functions.search') }}" class="mb-6"&gt;
    &lt;div class="flex gap-4"&gt;
        &lt;div class="flex-1"&gt;
            &lt;input type="text"
                   name="q"
                   value="{{ $query }}"
                   placeholder="Search users by name, email, or department..."
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"&gt;
        &lt;/div&gt;
        &lt;button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium"&gt;
            Search
        &lt;/button&gt;
        &#64;if($query)
        &lt;a href="{{ route('functions.search') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium"&gt;
            Clear
        &lt;/a&gt;
        &#64;endif
    &lt;/div&gt;
&lt;/form&gt;

&lt;!-- Search Results with Highlighting --&gt;
&lt;h3 class="font-semibold text-gray-800"&gt;
    &#64;if($query)
        {!! str_ireplace($query, '&lt;mark class="bg-yellow-200"&gt;' . $query . '&lt;/mark&gt;', $user['name']) !!}
    &#64;else
        {{ $user['name'] }}
    &#64;endif
&lt;/h3&gt;</code></pre>
        </div>
    </div>
</div>
@endsection
