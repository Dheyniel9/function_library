@extends('layouts.app')

@section('title', 'Data Table')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Data Table Component</h1>
        <p class="text-gray-600">Sortable data table with actions and responsive design</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created At
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $user['id'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $user['name'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $user['email'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $user['role'] == 'Admin' ? 'bg-red-100 text-red-800' :
                                   ($user['role'] == 'Editor' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                {{ $user['role'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $user['created_at'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">View</button>
                                <button class="text-green-600 hover:text-green-900">Edit</button>
                                <button class="text-red-600 hover:text-red-900">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Code Example</h2>

        <div class="bg-gray-100 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-800"><code>// Controller
public function dataTable()
{
    $users = [
        ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'Admin'],
        // ... more users
    ];

    return view('functions.data-table', compact('users'));
}

// Blade Template
&lt;div class="overflow-x-auto"&gt;
    &lt;table class="min-w-full table-auto"&gt;
        &lt;thead&gt;
            &lt;tr class="bg-gray-50"&gt;
                &lt;th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"&gt;
                    Name
                &lt;/th&gt;
                &lt;th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"&gt;
                    Email
                &lt;/th&gt;
                &lt;th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"&gt;
                    Actions
                &lt;/th&gt;
            &lt;/tr&gt;
        &lt;/thead&gt;
        &lt;tbody class="bg-white divide-y divide-gray-200"&gt;
            &#64;foreach($users as $user)
            &lt;tr class="hover:bg-gray-50"&gt;
                &lt;td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"&gt;
                    {{ $user['name'] }}
                &lt;/td&gt;
                &lt;td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"&gt;
                    {{ $user['email'] }}
                &lt;/td&gt;
                &lt;td class="px-6 py-4 whitespace-nowrap text-sm font-medium"&gt;
                    &lt;div class="flex space-x-2"&gt;
                        &lt;button class="text-blue-600 hover:text-blue-900"&gt;View&lt;/button&gt;
                        &lt;button class="text-green-600 hover:text-green-900"&gt;Edit&lt;/button&gt;
                        &lt;button class="text-red-600 hover:text-red-900"&gt;Delete&lt;/button&gt;
                    &lt;/div&gt;
                &lt;/td&gt;
            &lt;/tr&gt;
            &#64;endforeach
        &lt;/tbody&gt;
    &lt;/table&gt;
&lt;/div&gt;</code></pre>
        </div>
    </div>
</div>
@endsection
