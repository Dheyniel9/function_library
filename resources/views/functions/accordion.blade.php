@extends('layouts.app')

@section('title', 'Accordion')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="h2 font-weight-bold text-dark mb-3">
                        <i class="fas fa-list mr-2 text-primary"></i>
                        Accordion Component
                    </h1>
                    <p class="text-muted mb-0">
                        <i class="fas fa-info-circle mr-1"></i>
                        Expandable accordion component with Bootstrap 4 and vanilla JavaScript
                    </p>
                </div>
            </div>

            <!-- Sample Data Accordion -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-database mr-2"></i>
                        Sample Data Accordion
                    </h2>
                </div>
                <div class="card-body">
                    <div id="sampleAccordion">
                        <div class="accordion-item">
                            <div class="accordion-header" id="sampleHeading1">
                                <button class="accordion-button" type="button" data-target="#sampleCollapse1" aria-expanded="true" aria-controls="sampleCollapse1">
                                    <i class="fas fa-question-circle mr-2"></i>
                                    What is Laravel?
                                </button>
                            </div>
                            <div id="sampleCollapse1" class="accordion-collapse collapse show" aria-labelledby="sampleHeading1" data-parent="#sampleAccordion">
                                <div class="accordion-body">
                                    <p>Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the model-view-controller (MVC) architectural pattern.</p>
                                    <p>It provides a rich set of features including:</p>
                                    <ul>
                                        <li>Eloquent ORM for database interactions</li>
                                        <li>Artisan command-line interface</li>
                                        <li>Blade templating engine</li>
                                        <li>Built-in authentication and authorization</li>
                                        <li>Robust routing system</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header" id="sampleHeading2">
                                <button class="accordion-button collapsed" type="button" data-target="#sampleCollapse2" aria-expanded="false" aria-controls="sampleCollapse2">
                                    <i class="fas fa-code mr-2"></i>
                                    How to create a Laravel project?
                                </button>
                            </div>
                            <div id="sampleCollapse2" class="accordion-collapse collapse" aria-labelledby="sampleHeading2" data-parent="#sampleAccordion">
                                <div class="accordion-body">
                                    <p>You can create a new Laravel project using Composer:</p>
                                    <div class="bg-dark text-light p-3 rounded">
                                        <code>composer create-project laravel/laravel my-project</code>
                                    </div>
                                    <p class="mt-3">Alternatively, you can use the Laravel installer:</p>
                                    <div class="bg-dark text-light p-3 rounded">
                                        <code>laravel new my-project</code>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header" id="sampleHeading3">
                                <button class="accordion-button collapsed" type="button" data-target="#sampleCollapse3" aria-expanded="false" aria-controls="sampleCollapse3">
                                    <i class="fas fa-server mr-2"></i>
                                    Laravel Requirements
                                </button>
                            </div>
                            <div id="sampleCollapse3" class="accordion-collapse collapse" aria-labelledby="sampleHeading3" data-parent="#sampleAccordion">
                                <div class="accordion-body">
                                    <p>Laravel has several system requirements:</p>
                                    <ul>
                                        <li>PHP >= 8.0</li>
                                        <li>OpenSSL PHP Extension</li>
                                        <li>PDO PHP Extension</li>
                                        <li>Mbstring PHP Extension</li>
                                        <li>Tokenizer PHP Extension</li>
                                        <li>XML PHP Extension</li>
                                        <li>Ctype PHP Extension</li>
                                        <li>JSON PHP Extension</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header" id="sampleHeading4">
                                <button class="accordion-button collapsed" type="button" data-target="#sampleCollapse4" aria-expanded="false" aria-controls="sampleCollapse4">
                                    <i class="fas fa-palette mr-2"></i>
                                    Bootstrap 4 Features
                                </button>
                            </div>
                            <div id="sampleCollapse4" class="accordion-collapse collapse" aria-labelledby="sampleHeading4" data-parent="#sampleAccordion">
                                <div class="accordion-body">
                                    <p>Bootstrap 4 comes with many powerful features:</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold">CSS Features</h6>
                                            <ul>
                                                <li>Flexbox grid system</li>
                                                <li>Responsive design utilities</li>
                                                <li>Custom CSS properties</li>
                                                <li>Improved typography</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold">JavaScript Components</h6>
                                            <ul>
                                                <li>Modal dialogs</li>
                                                <li>Dropdown menus</li>
                                                <li>Carousel sliders</li>
                                                <li>Tooltip and popover</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dynamic Accordion (if you have $accordionData) -->
            @if(isset($accordionData) && !empty($accordionData))
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-cog mr-2"></i>
                        Dynamic Accordion
                    </h2>
                </div>
                <div class="card-body">
                    <div id="dynamicAccordion">
                        @foreach($accordionData as $index => $item)
                        <div class="accordion-item">
                            <div class="accordion-header" id="dynamicHeading{{ $item['id'] ?? $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button"
                                        data-target="#dynamicCollapse{{ $item['id'] ?? $index }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="dynamicCollapse{{ $item['id'] ?? $index }}">
                                    <i class="fas fa-chevron-right accordion-icon mr-2"></i>
                                    {{ $item['title'] }}
                                </button>
                            </div>
                            <div id="dynamicCollapse{{ $item['id'] ?? $index }}"
                                 class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                 aria-labelledby="dynamicHeading{{ $item['id'] ?? $index }}"
                                 data-parent="#dynamicAccordion">
                                <div class="accordion-body">
                                    {{ $item['content'] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Interactive Accordion Controls -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-gamepad mr-2"></i>
                        Interactive Controls
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="font-weight-bold">Accordion Controls</h6>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary" id="expandAll">
                                    <i class="fas fa-expand mr-1"></i>Expand All
                                </button>
                                <button type="button" class="btn btn-outline-primary" id="collapseAll">
                                    <i class="fas fa-compress mr-1"></i>Collapse All
                                </button>
                                <button type="button" class="btn btn-outline-primary" id="toggleFirst">
                                    <i class="fas fa-exchange-alt mr-1"></i>Toggle First
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="font-weight-bold">Animation Speed</h6>
                            <div class="form-group">
                                <input type="range" class="form-control-range" id="animationSpeed" min="100" max="1000" value="300">
                                <small class="form-text text-muted">Current speed: <span id="speedValue">300</span>ms</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Code Example -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-code mr-2"></i>
                        Code Example
                    </h2>
                </div>
                <div class="card-body">
                    <div class="bg-dark text-light p-3 rounded">
                        <pre class="mb-0"><code>// Controller
public function accordion()
{
    $accordionData = [
        ['id' => 1, 'title' => 'What is Laravel?', 'content' => 'Laravel is a PHP web application framework...'],
        ['id' => 2, 'title' => 'How to install Laravel?', 'content' => 'You can install Laravel using Composer...'],
        // Add more items...
    ];
    return view('functions.accordion', compact('accordionData'));
}

// Blade Template
&lt;div id="accordionExample"&gt;
    &#64;foreach($accordionData as $item)
        &lt;div class="accordion-item"&gt;
            &lt;div class="accordion-header" id="heading{{ $item['id'] }}"&gt;
                &lt;button class="accordion-button" type="button"
                    data-target="#collapse{{ $item['id'] }}"
                    aria-expanded="false" aria-controls="collapse{{ $item['id'] }}"&gt;
                    {{ $item['title'] }}
                &lt;/button&gt;
            &lt;/div&gt;
            &lt;div id="collapse{{ $item['id'] }}" class="accordion-collapse collapse"
                aria-labelledby="heading{{ $item['id'] }}" data-parent="#accordionExample"&gt;
                &lt;div class="accordion-body"&gt;
                    {{ $item['content'] }}
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &#64;endforeach
&lt;/div&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Accordion CSS -->
<style>
    /* Accordion Container */
    .accordion-item {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        margin-bottom: 10px;
        background-color: #ffffff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .accordion-item:hover {
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    /* Accordion Header */
    .accordion-header {
        margin-bottom: 0;
    }

    .accordion-button {
        width: 100%;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        font-weight: 500;
        color: #495057;
        text-align: left;
        background-color: #f8f9fa;
        border: none;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        position: relative;
    }

    .accordion-button:hover {
        background-color: #e9ecef;
        color: #007bff;
    }

    .accordion-button:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .accordion-button:not(.collapsed) {
        background-color: #007bff;
        color: #ffffff;
    }

    .accordion-button:not(.collapsed):hover {
        background-color: #0056b3;
    }

    /* Accordion Icon */
    .accordion-icon {
        transition: transform 0.3s ease;
    }

    .accordion-button:not(.collapsed) .accordion-icon {
        transform: rotate(90deg);
    }

    /* Accordion Body */
    .accordion-collapse {
        overflow: hidden;
        transition: height 0.3s ease;
    }

    .accordion-collapse.collapse {
        height: 0;
        display: block;
    }

    .accordion-collapse.collapse.show {
        height: auto;
        display: block;
    }

    .accordion-body {
        padding: 1.25rem;
        border-top: 1px solid #dee2e6;
        background-color: #ffffff;
        border-radius: 0 0 0.375rem 0.375rem;
        overflow-y: auto;
    }

    /* Animation Classes */
    .accordion-collapse.collapsing {
        height: 0;
        overflow: hidden;
        transition: height 0.3s ease;
        display: block;
    }

    /* Custom Scrollbar for Long Content */
    .accordion-body {
        max-height: none;
        overflow-y: visible;
    }

    /* Only apply scrollbar when content is too long */
    .accordion-body.long-content {
        max-height: 400px;
        overflow-y: auto;
    }

    .accordion-body::-webkit-scrollbar {
        width: 6px;
    }

    .accordion-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .accordion-body::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    .accordion-body::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .accordion-button {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }

        .accordion-body {
            padding: 1rem;
        }
    }

    /* Button Active States */
    .btn-outline-primary.active {
        background-color: #007bff;
        border-color: #007bff;
        color: #ffffff;
    }

    /* Range Slider Styling */
    .form-control-range {
        width: 100%;
        background-color: transparent;
        -webkit-appearance: none;
        appearance: none;
        height: 6px;
        border-radius: 3px;
        background: #ddd;
        outline: none;
    }

    .form-control-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #007bff;
        cursor: pointer;
    }

    .form-control-range::-moz-range-thumb {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #007bff;
        cursor: pointer;
        border: none;
    }
</style>

<!-- Accordion JavaScript - FIXED VERSION -->
<script>
    class AccordionManager {
        constructor() {
            this.accordions = document.querySelectorAll('[id$="Accordion"]');
            this.animationSpeed = 300;
            this.init();
        }

        init() {
            this.setupEventListeners();
            this.setupControls();
            this.initializeAccordions();
        }

        setupEventListeners() {
            // Handle accordion button clicks
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('accordion-button') || e.target.closest('.accordion-button')) {
                    e.preventDefault();
                    const button = e.target.classList.contains('accordion-button') ? e.target : e.target.closest('.accordion-button');
                    this.toggleAccordion(button);
                }
            });

            // Handle keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.target.classList.contains('accordion-button')) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.toggleAccordion(e.target);
                    }
                }
            });
        }

        setupControls() {
            // Expand All button
            const expandAllBtn = document.getElementById('expandAll');
            if (expandAllBtn) {
                expandAllBtn.addEventListener('click', () => {
                    this.expandAll();
                });
            }

            // Collapse All button
            const collapseAllBtn = document.getElementById('collapseAll');
            if (collapseAllBtn) {
                collapseAllBtn.addEventListener('click', () => {
                    this.collapseAll();
                });
            }

            // Toggle First button
            const toggleFirstBtn = document.getElementById('toggleFirst');
            if (toggleFirstBtn) {
                toggleFirstBtn.addEventListener('click', () => {
                    this.toggleFirst();
                });
            }

            // Animation speed slider
            const animationSpeedSlider = document.getElementById('animationSpeed');
            const speedValue = document.getElementById('speedValue');
            if (animationSpeedSlider && speedValue) {
                animationSpeedSlider.addEventListener('input', (e) => {
                    this.animationSpeed = parseInt(e.target.value);
                    speedValue.textContent = this.animationSpeed;
                    this.updateAnimationSpeed();
                });
            }
        }

        initializeAccordions() {
            // FIXED: Properly initialize accordion states
            this.accordions.forEach(accordion => {
                const collapses = accordion.querySelectorAll('.accordion-collapse');
                collapses.forEach(collapse => {
                    if (collapse.classList.contains('show')) {
                        // FIXED: Ensure expanded items are fully visible
                        collapse.style.height = 'auto';
                        collapse.style.display = 'block';
                        collapse.style.overflow = 'visible';
                    } else {
                        // FIXED: Ensure collapsed items are properly hidden
                        collapse.style.height = '0px';
                        collapse.style.display = 'block';
                        collapse.style.overflow = 'hidden';
                    }
                });
            });
        }

        toggleAccordion(button) {
            const targetId = button.getAttribute('data-target');
            const target = document.querySelector(targetId);
            const parentAccordion = button.closest('[id$="Accordion"]');

            if (!target) return;

            const isExpanded = button.getAttribute('aria-expanded') === 'true';

            if (isExpanded) {
                this.collapseItem(button, target);
            } else {
                // Collapse other items in the same accordion
                if (parentAccordion) {
                    const otherButtons = parentAccordion.querySelectorAll('.accordion-button:not(.collapsed)');
                    otherButtons.forEach(otherButton => {
                        if (otherButton !== button) {
                            const otherTargetId = otherButton.getAttribute('data-target');
                            const otherTarget = document.querySelector(otherTargetId);
                            if (otherTarget) {
                                this.collapseItem(otherButton, otherTarget);
                            }
                        }
                    });
                }

                this.expandItem(button, target);
            }
        }

        expandItem(button, target) {
            button.classList.remove('collapsed');
            button.setAttribute('aria-expanded', 'true');

            // FIXED: Clear any existing height and prepare for animation
            target.style.height = '0px';
            target.style.display = 'block';
            target.style.overflow = 'hidden';

            // Remove collapse class and add collapsing
            target.classList.remove('collapse');
            target.classList.add('collapsing');

            // Force reflow
            target.offsetHeight;

            // FIXED: Calculate height and animate properly
            const height = target.scrollHeight;
            target.style.height = height + 'px';

            setTimeout(() => {
                target.classList.remove('collapsing');
                target.classList.add('collapse', 'show');
                // FIXED: Set to auto and make content visible
                target.style.height = 'auto';
                target.style.overflow = 'visible';
            }, this.animationSpeed);
        }

        collapseItem(button, target) {
            button.classList.add('collapsed');
            button.setAttribute('aria-expanded', 'false');

            // FIXED: Get current height and set overflow
            const currentHeight = target.offsetHeight;
            target.style.height = currentHeight + 'px';
            target.style.overflow = 'hidden';

            // Remove show class and add collapsing
            target.classList.remove('show');
            target.classList.add('collapsing');

            // Force reflow
            target.offsetHeight;

            // Animate to 0 height
            target.style.height = '0px';

            setTimeout(() => {
                target.classList.remove('collapsing');
                target.classList.add('collapse');
                // FIXED: Keep height at 0 and maintain hidden overflow
                target.style.height = '0px';
                target.style.overflow = 'hidden';
            }, this.animationSpeed);
        }

        expandAll() {
            this.accordions.forEach(accordion => {
                const buttons = accordion.querySelectorAll('.accordion-button.collapsed');
                buttons.forEach(button => {
                    const targetId = button.getAttribute('data-target');
                    const target = document.querySelector(targetId);
                    if (target) {
                        this.expandItem(button, target);
                    }
                });
            });

            if (typeof showNotification === 'function') {
                showNotification('All accordion items expanded!', 'success');
            }
        }

        collapseAll() {
            this.accordions.forEach(accordion => {
                const buttons = accordion.querySelectorAll('.accordion-button:not(.collapsed)');
                buttons.forEach(button => {
                    const targetId = button.getAttribute('data-target');
                    const target = document.querySelector(targetId);
                    if (target) {
                        this.collapseItem(button, target);
                    }
                });
            });

            if (typeof showNotification === 'function') {
                showNotification('All accordion items collapsed!', 'info');
            }
        }

        toggleFirst() {
            const firstButton = document.querySelector('.accordion-button');
            if (firstButton) {
                this.toggleAccordion(firstButton);
            }
        }

        updateAnimationSpeed() {
            // Update CSS transition duration
            const style = document.createElement('style');
            style.textContent = `
                .accordion-collapse.collapsing {
                    transition: height ${this.animationSpeed}ms ease;
                }
            `;
            document.head.appendChild(style);
        }
    }

    // Initialize accordion manager when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        window.accordionManager = new AccordionManager();

        // Show notification when loaded
        setTimeout(() => {
            if (typeof showNotification === 'function') {
                showNotification('Accordion component loaded! Try expanding and collapsing items.', 'info');
            }
        }, 1000);
    });
</script>
@endsection
