@extends('layouts.app')

@section('title', 'Accordion')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Accordion Component</h1>
        <p class="text-gray-600">Expandable accordion component with smooth animations</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        <div class="space-y-4" x-data="{ activeAccordion: null }">
            @foreach($accordionData as $item)
            <div class="border border-gray-200 rounded-lg">
                <button
                    @click="activeAccordion = activeAccordion === {{ $item['id'] }} ? null : {{ $item['id'] }}"
                    class="w-full px-4 py-3 text-left flex justify-between items-center hover:bg-gray-50 focus:outline-none focus:bg-gray-50"
                    :class="{'bg-gray-50': activeAccordion === {{ $item['id'] }}}">
                    <span class="font-medium text-gray-800">{{ $item['title'] }}</span>
                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
                         :class="{'rotate-180': activeAccordion === {{ $item['id'] }}}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="activeAccordion === {{ $item['id'] }}"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="px-4 pb-4 text-gray-600">
                    {{ $item['content'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Code Example</h2>

        <div class="bg-gray-100 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-800"><code>// Controller
public function accordion()
{
    $accordionData = [
        [
            'id' => 1,
            'title' => 'What is Laravel?',
            'content' => 'Laravel is a PHP web application framework...'
        ],
        // ... more items
    ];

    return view('functions.accordion', compact('accordionData'));
}

// Blade Template
&lt;div class="space-y-4" x-data="{ activeAccordion: null }"&gt;
    &#64;foreach($accordionData as $item)
    &lt;div class="border border-gray-200 rounded-lg"&gt;
        &lt;button
            &#64;click="activeAccordion = activeAccordion === {{ $item['id'] }} ? null : {{ $item['id'] }}"
            class="w-full px-4 py-3 text-left flex justify-between items-center hover:bg-gray-50"&gt;
            &lt;span class="font-medium text-gray-800"&gt;{{ $item['title'] }}&lt;/span&gt;
            &lt;svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
                 :class="{'rotate-180': activeAccordion === {{ $item['id'] }}}"&gt;
                &lt;path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"&gt;&lt;/path&gt;
            &lt;/svg&gt;
        &lt;/button&gt;

        &lt;div x-show="activeAccordion === {{ $item['id'] }}"
             x-transition
             class="px-4 pb-4 text-gray-600"&gt;
            {{ $item['content'] }}
        &lt;/div&gt;
    &lt;/div&gt;
    &#64;endforeach
&lt;/div&gt;</code></pre>
        </div>
    </div>
</div>
@endsection
