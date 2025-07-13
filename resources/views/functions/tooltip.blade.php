@extends('layouts.app')

@section('title', 'Tooltip')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tooltip Component</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Examples -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Examples</h2>

                <div class="space-y-6">
                    <!-- Basic Tooltip -->
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-medium text-gray-700 mb-3">Basic Tooltip</h3>
                        <div class="flex items-center space-x-4">
                            <button class="tooltip-trigger bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors" data-tooltip="This is a basic tooltip">
                                Hover me
                            </button>
                            <span class="tooltip-trigger text-blue-500 cursor-help" data-tooltip="Tooltips work on any element">
                                Hover this text
                            </span>
                        </div>
                    </div>

                    <!-- Positioned Tooltips -->
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-medium text-gray-700 mb-3">Positioned Tooltips</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <button class="tooltip-trigger bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition-colors" data-tooltip="Tooltip on top" data-position="top">
                                Top
                            </button>
                            <button class="tooltip-trigger bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors" data-tooltip="Tooltip on bottom" data-position="bottom">
                                Bottom
                            </button>
                            <button class="tooltip-trigger bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition-colors" data-tooltip="Tooltip on left" data-position="left">
                                Left
                            </button>
                            <button class="tooltip-trigger bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded transition-colors" data-tooltip="Tooltip on right" data-position="right">
                                Right
                            </button>
                        </div>
                    </div>

                    <!-- Rich Content Tooltips -->
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-medium text-gray-700 mb-3">Rich Content</h3>
                        <div class="flex items-center space-x-4">
                            <button class="tooltip-trigger bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded transition-colors" data-tooltip="<strong>Bold text</strong><br>Line breaks work too!" data-html="true">
                                HTML Content
                            </button>
                            <button class="tooltip-trigger bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition-colors" data-tooltip="User: John Doe<br>Email: john@example.com<br>Role: Administrator" data-html="true">
                                User Info
                            </button>
                        </div>
                    </div>

                    <!-- Interactive Elements -->
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-medium text-gray-700 mb-3">Interactive Elements</h3>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <input type="text" class="tooltip-trigger border border-gray-300 rounded px-3 py-2" placeholder="Enter your name" data-tooltip="Please enter your full name">
                                <svg class="tooltip-trigger w-5 h-5 text-gray-400 cursor-help" data-tooltip="This field is required" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="email" class="tooltip-trigger border border-gray-300 rounded px-3 py-2" placeholder="Enter your email" data-tooltip="We'll never share your email">
                                <svg class="tooltip-trigger w-5 h-5 text-green-500 cursor-help" data-tooltip="Your email is secure" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuration -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Configuration</h2>

                <div class="space-y-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-medium text-gray-700 mb-3">Tooltip Settings</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium text-gray-700">Show Delay</label>
                                <input type="range" id="showDelay" min="0" max="1000" value="300" class="w-24">
                                <span id="showDelayValue" class="text-sm text-gray-600">300ms</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium text-gray-700">Hide Delay</label>
                                <input type="range" id="hideDelay" min="0" max="1000" value="100" class="w-24">
                                <span id="hideDelayValue" class="text-sm text-gray-600">100ms</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium text-gray-700">Animation</label>
                                <select id="animation" class="text-sm border border-gray-300 rounded px-2 py-1">
                                    <option value="fade">Fade</option>
                                    <option value="slide">Slide</option>
                                    <option value="scale">Scale</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-medium text-gray-700 mb-3">Test Tooltip</h3>
                        <button id="testTooltip" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors">
                            Test Current Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Tooltip Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
class TooltipManager {
    constructor() {
        this.tooltips = new Map();
        this.settings = {
            showDelay: 300,
            hideDelay: 100,
            animation: 'fade',
            offset: 10
        };
        this.init();
    }

    init() {
        this.bindEvents();
        this.createTooltipElement();
    }

    bindEvents() {
        document.addEventListener('mouseenter', (e) => {
            if (e.target.classList.contains('tooltip-trigger')) {
                this.showTooltip(e.target);
            }
        }, true);

        document.addEventListener('mouseleave', (e) => {
            if (e.target.classList.contains('tooltip-trigger')) {
                this.hideTooltip();
            }
        }, true);
    }

    showTooltip(element) {
        const content = element.dataset.tooltip;
        const position = element.dataset.position || 'top';
        const isHtml = element.dataset.html === 'true';

        if (!content) return;

        clearTimeout(this.hideTimeout);
        this.showTimeout = setTimeout(() => {
            this.displayTooltip(element, content, position, isHtml);
        }, this.settings.showDelay);
    }

    displayTooltip(element, content, position, isHtml) {
        const rect = element.getBoundingClientRect();
        const tooltip = document.getElementById('tooltip');

        if (isHtml) {
            tooltip.innerHTML = content;
        } else {
            tooltip.textContent = content;
        }

        tooltip.className = `tooltip-element ${this.settings.animation}`;
        tooltip.style.display = 'block';

        const tooltipRect = tooltip.getBoundingClientRect();
        const { top, left } = this.calculatePosition(rect, tooltipRect, position);

        tooltip.style.top = top + 'px';
        tooltip.style.left = left + 'px';
        tooltip.classList.add('show');
    }

    calculatePosition(elementRect, tooltipRect, position) {
        const offset = this.settings.offset;
        let top, left;

        switch (position) {
            case 'top':
                top = elementRect.top - tooltipRect.height - offset;
                left = elementRect.left + (elementRect.width - tooltipRect.width) / 2;
                break;
            case 'bottom':
                top = elementRect.bottom + offset;
                left = elementRect.left + (elementRect.width - tooltipRect.width) / 2;
                break;
            case 'left':
                top = elementRect.top + (elementRect.height - tooltipRect.height) / 2;
                left = elementRect.left - tooltipRect.width - offset;
                break;
            case 'right':
                top = elementRect.top + (elementRect.height - tooltipRect.height) / 2;
                left = elementRect.right + offset;
                break;
        }

        return { top, left };
    }

    hideTooltip() {
        clearTimeout(this.showTimeout);
        this.hideTimeout = setTimeout(() => {
            const tooltip = document.getElementById('tooltip');
            tooltip.classList.remove('show');
            setTimeout(() => {
                tooltip.style.display = 'none';
            }, 200);
        }, this.settings.hideDelay);
    }
}

const tooltipManager = new TooltipManager();
        </code></pre>
    </div>
</div>

<!-- Tooltip Element -->
<div id="tooltip" class="tooltip-element"></div>

<style>
.tooltip-element {
    position: fixed;
    background: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 14px;
    line-height: 1.4;
    max-width: 250px;
    z-index: 1000;
    display: none;
    opacity: 0;
    transform: translateY(-5px);
    transition: opacity 0.2s, transform 0.2s;
    pointer-events: none;
}

.tooltip-element.show {
    opacity: 1;
    transform: translateY(0);
}

.tooltip-element.fade {
    transition: opacity 0.2s, transform 0.2s;
}

.tooltip-element.slide {
    transition: opacity 0.2s, transform 0.2s ease-out;
}

.tooltip-element.scale {
    transition: opacity 0.2s, transform 0.2s ease-out;
    transform-origin: center bottom;
}

.tooltip-element.scale:not(.show) {
    transform: scale(0.8);
}

.tooltip-element::before {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-top-color: rgba(0, 0, 0, 0.9);
}
</style>

<script>
class TooltipManager {
    constructor() {
        this.tooltips = new Map();
        this.settings = {
            showDelay: 300,
            hideDelay: 100,
            animation: 'fade',
            offset: 10
        };
        this.init();
    }

    init() {
        this.bindEvents();
        this.createTooltipElement();
        this.bindControls();
    }

    createTooltipElement() {
        if (!document.getElementById('tooltip')) {
            const tooltip = document.createElement('div');
            tooltip.id = 'tooltip';
            tooltip.className = 'tooltip-element';
            document.body.appendChild(tooltip);
        }
    }

    bindEvents() {
        document.addEventListener('mouseenter', (e) => {
            if (e.target.classList.contains('tooltip-trigger')) {
                this.showTooltip(e.target);
            }
        }, true);

        document.addEventListener('mouseleave', (e) => {
            if (e.target.classList.contains('tooltip-trigger')) {
                this.hideTooltip();
            }
        }, true);
    }

    bindControls() {
        const showDelaySlider = document.getElementById('showDelay');
        const hideDelaySlider = document.getElementById('hideDelay');
        const animationSelect = document.getElementById('animation');
        const testButton = document.getElementById('testTooltip');

        showDelaySlider.addEventListener('input', (e) => {
            this.settings.showDelay = parseInt(e.target.value);
            document.getElementById('showDelayValue').textContent = e.target.value + 'ms';
        });

        hideDelaySlider.addEventListener('input', (e) => {
            this.settings.hideDelay = parseInt(e.target.value);
            document.getElementById('hideDelayValue').textContent = e.target.value + 'ms';
        });

        animationSelect.addEventListener('change', (e) => {
            this.settings.animation = e.target.value;
        });

        testButton.addEventListener('click', () => {
            testButton.dataset.tooltip = `Show: ${this.settings.showDelay}ms, Hide: ${this.settings.hideDelay}ms, Animation: ${this.settings.animation}`;
            this.showTooltip(testButton);
        });
    }

    showTooltip(element) {
        const content = element.dataset.tooltip;
        const position = element.dataset.position || 'top';
        const isHtml = element.dataset.html === 'true';

        if (!content) return;

        clearTimeout(this.hideTimeout);
        this.showTimeout = setTimeout(() => {
            this.displayTooltip(element, content, position, isHtml);
        }, this.settings.showDelay);
    }

    displayTooltip(element, content, position, isHtml) {
        const rect = element.getBoundingClientRect();
        const tooltip = document.getElementById('tooltip');

        if (isHtml) {
            tooltip.innerHTML = content;
        } else {
            tooltip.textContent = content;
        }

        tooltip.className = `tooltip-element ${this.settings.animation}`;
        tooltip.style.display = 'block';

        // Wait for display to calculate dimensions
        setTimeout(() => {
            const tooltipRect = tooltip.getBoundingClientRect();
            const { top, left } = this.calculatePosition(rect, tooltipRect, position);

            tooltip.style.top = top + 'px';
            tooltip.style.left = left + 'px';
            tooltip.classList.add('show');
        }, 1);
    }

    calculatePosition(elementRect, tooltipRect, position) {
        const offset = this.settings.offset;
        let top, left;

        switch (position) {
            case 'top':
                top = elementRect.top - tooltipRect.height - offset + window.scrollY;
                left = elementRect.left + (elementRect.width - tooltipRect.width) / 2 + window.scrollX;
                break;
            case 'bottom':
                top = elementRect.bottom + offset + window.scrollY;
                left = elementRect.left + (elementRect.width - tooltipRect.width) / 2 + window.scrollX;
                break;
            case 'left':
                top = elementRect.top + (elementRect.height - tooltipRect.height) / 2 + window.scrollY;
                left = elementRect.left - tooltipRect.width - offset + window.scrollX;
                break;
            case 'right':
                top = elementRect.top + (elementRect.height - tooltipRect.height) / 2 + window.scrollY;
                left = elementRect.right + offset + window.scrollX;
                break;
        }

        // Keep tooltip within viewport
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;

        if (left < 0) left = 10;
        if (left + tooltipRect.width > viewportWidth) left = viewportWidth - tooltipRect.width - 10;
        if (top < 0) top = 10;
        if (top + tooltipRect.height > viewportHeight) top = viewportHeight - tooltipRect.height - 10;

        return { top, left };
    }

    hideTooltip() {
        clearTimeout(this.showTimeout);
        this.hideTimeout = setTimeout(() => {
            const tooltip = document.getElementById('tooltip');
            tooltip.classList.remove('show');
            setTimeout(() => {
                tooltip.style.display = 'none';
            }, 200);
        }, this.settings.hideDelay);
    }

    updateSettings(newSettings) {
        this.settings = { ...this.settings, ...newSettings };
    }
}

// Initialize tooltip manager
const tooltipManager = new TooltipManager();

// Show success message
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        showInfo('Hover over elements to see tooltips in action!');
    }, 1000);
});
</script>
@endsection
