@extends('layouts.app')

@section('title', 'Color Picker')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Advanced Color Picker</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Color Picker -->
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Color Selection</h2>

                    <!-- Color Display -->
                    <div class="space-y-4">
                        <div class="relative">
                            <div id="colorDisplay" class="w-full h-32 rounded-lg border-2 border-gray-300 bg-red-500" style="background-color: #ff0000;"></div>
                            <div class="absolute top-2 right-2 bg-white bg-opacity-80 rounded px-2 py-1 text-sm font-mono">
                                <span id="colorDisplayText">#ff0000</span>
                            </div>
                        </div>

                        <!-- Color Picker Canvas -->
                        <div class="space-y-3">
                            <div class="relative">
                                <canvas id="colorCanvas" width="300" height="200" class="w-full border rounded cursor-crosshair"></canvas>
                                <div id="colorPointer" class="absolute w-3 h-3 border-2 border-white rounded-full pointer-events-none transform -translate-x-1/2 -translate-y-1/2" style="left: 50%; top: 50%;"></div>
                            </div>

                            <!-- Hue Slider -->
                            <div class="relative">
                                <canvas id="hueCanvas" width="300" height="20" class="w-full border rounded cursor-pointer"></canvas>
                                <div id="huePointer" class="absolute w-3 h-6 border-2 border-white rounded pointer-events-none transform -translate-x-1/2 -translate-y-1/2" style="left: 50%; top: 50%;"></div>
                            </div>

                            <!-- Alpha Slider -->
                            <div class="relative">
                                <canvas id="alphaCanvas" width="300" height="20" class="w-full border rounded cursor-pointer"></canvas>
                                <div id="alphaPointer" class="absolute w-3 h-6 border-2 border-white rounded pointer-events-none transform -translate-x-1/2 -translate-y-1/2" style="left: 100%; top: 50%;"></div>
                            </div>
                        </div>

                        <!-- Color Inputs -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hex Color</label>
                                <input type="text" id="hexInput" class="w-full border border-gray-300 rounded-md px-3 py-2 font-mono" value="#ff0000">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">HTML Color</label>
                                <input type="color" id="htmlColorInput" class="w-full h-10 border border-gray-300 rounded-md" value="#ff0000">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Color Harmony -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Color Harmony</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harmony Type</label>
                            <select id="harmonyType" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                <option value="complementary">Complementary</option>
                                <option value="triadic">Triadic</option>
                                <option value="analogous">Analogous</option>
                                <option value="split-complementary">Split Complementary</option>
                                <option value="tetradic">Tetradic</option>
                                <option value="monochromatic">Monochromatic</option>
                            </select>
                        </div>

                        <div id="harmonyColors" class="grid grid-cols-5 gap-2">
                            <!-- Harmony colors will be generated here -->
                        </div>

                        <button onclick="generateHarmony()" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-md">
                            Generate Harmony
                        </button>
                    </div>
                </div>
            </div>

            <!-- Color Information and Tools -->
            <div class="space-y-6">
                <!-- Color Values -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Color Values</h2>
                    <div class="space-y-3">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">RGB</label>
                                <div class="flex space-x-2">
                                    <input type="number" id="rgbR" class="w-full border border-gray-300 rounded px-2 py-1 text-sm" min="0" max="255" value="255">
                                    <input type="number" id="rgbG" class="w-full border border-gray-300 rounded px-2 py-1 text-sm" min="0" max="255" value="0">
                                    <input type="number" id="rgbB" class="w-full border border-gray-300 rounded px-2 py-1 text-sm" min="0" max="255" value="0">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">HSL</label>
                                <div class="flex space-x-2">
                                    <input type="number" id="hslH" class="w-full border border-gray-300 rounded px-2 py-1 text-sm" min="0" max="360" value="0">
                                    <input type="number" id="hslS" class="w-full border border-gray-300 rounded px-2 py-1 text-sm" min="0" max="100" value="100">
                                    <input type="number" id="hslL" class="w-full border border-gray-300 rounded px-2 py-1 text-sm" min="0" max="100" value="50">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">HSV</label>
                                <div class="flex space-x-2">
                                    <input type="number" id="hsvH" class="w-full border border-gray-300 rounded px-2 py-1 text-sm" min="0" max="360" value="0">
                                    <input type="number" id="hsvS" class="w-full border border-gray-300 rounded px-2 py-1 text-sm" min="0" max="100" value="100">
                                    <input type="number" id="hsvV" class="w-full border border-gray-300 rounded px-2 py-1 text-sm" min="0" max="100" value="100">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CMYK</label>
                                <div class="flex space-x-1">
                                    <input type="number" id="cmykC" class="w-full border border-gray-300 rounded px-1 py-1 text-xs" min="0" max="100" value="0">
                                    <input type="number" id="cmykM" class="w-full border border-gray-300 rounded px-1 py-1 text-xs" min="0" max="100" value="100">
                                    <input type="number" id="cmykY" class="w-full border border-gray-300 rounded px-1 py-1 text-xs" min="0" max="100" value="100">
                                    <input type="number" id="cmykK" class="w-full border border-gray-300 rounded px-1 py-1 text-xs" min="0" max="100" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Color Palette -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Color Palette</h2>
                    <div id="colorPalette" class="grid grid-cols-8 gap-2 mb-4">
                        <!-- Palette colors will be generated here -->
                    </div>
                    <div class="space-y-2">
                        <button onclick="addToPalette()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                            Add to Palette
                        </button>
                        <button onclick="clearPalette()" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
                            Clear Palette
                        </button>
                    </div>
                </div>

                <!-- Gradient Generator -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Gradient Generator</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Start Color</label>
                                <input type="color" id="gradientStart" class="w-full h-10 border border-gray-300 rounded-md" value="#ff0000">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">End Color</label>
                                <input type="color" id="gradientEnd" class="w-full h-10 border border-gray-300 rounded-md" value="#0000ff">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Direction</label>
                            <select id="gradientDirection" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                <option value="to right">Horizontal (Left to Right)</option>
                                <option value="to left">Horizontal (Right to Left)</option>
                                <option value="to bottom">Vertical (Top to Bottom)</option>
                                <option value="to top">Vertical (Bottom to Top)</option>
                                <option value="45deg">Diagonal (45°)</option>
                                <option value="135deg">Diagonal (135°)</option>
                            </select>
                        </div>

                        <div id="gradientPreview" class="w-full h-16 rounded-lg border-2 border-gray-300"></div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">CSS Code</label>
                            <textarea id="gradientCSS" class="w-full border border-gray-300 rounded-md px-3 py-2 h-16 text-sm font-mono" readonly></textarea>
                        </div>

                        <button onclick="generateGradient()" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">
                            Generate Gradient
                        </button>
                    </div>
                </div>

                <!-- Accessibility -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Accessibility</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Background Color</label>
                            <input type="color" id="accessibilityBg" class="w-full h-10 border border-gray-300 rounded-md" value="#ffffff">
                        </div>

                        <div id="accessibilityResults" class="space-y-2">
                            <div class="bg-white p-3 rounded">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium">Contrast Ratio:</span>
                                    <span id="contrastRatio" class="text-sm font-mono">21:1</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <div id="wcagAA" class="text-center py-1 rounded text-xs bg-green-100 text-green-800">AA ✓</div>
                                    <div id="wcagAAA" class="text-center py-1 rounded text-xs bg-green-100 text-green-800">AAA ✓</div>
                                </div>
                            </div>
                        </div>

                        <div id="accessibilityPreview" class="p-3 rounded border-2" style="background-color: #ffffff; color: #ff0000;">
                            <p class="text-sm">Sample text for accessibility testing</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Color Picker Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
class ColorPicker {
    constructor() {
        this.currentColor = { r: 255, g: 0, b: 0 };
        this.currentHue = 0;
        this.currentAlpha = 1;
        this.palette = [];
        this.init();
    }

    init() {
        this.setupCanvases();
        this.bindEvents();
        this.updateAll();
    }

    setupCanvases() {
        this.colorCanvas = document.getElementById('colorCanvas');
        this.colorCtx = this.colorCanvas.getContext('2d');

        this.hueCanvas = document.getElementById('hueCanvas');
        this.hueCtx = this.hueCanvas.getContext('2d');

        this.alphaCanvas = document.getElementById('alphaCanvas');
        this.alphaCtx = this.alphaCanvas.getContext('2d');

        this.drawHueStrip();
        this.drawColorArea();
        this.drawAlphaStrip();
    }

    drawColorArea() {
        const ctx = this.colorCtx;
        const width = this.colorCanvas.width;
        const height = this.colorCanvas.height;

        // Base color from hue
        const baseColor = this.hsvToRgb(this.currentHue, 100, 100);

        // Create gradient
        const gradient = ctx.createLinearGradient(0, 0, width, 0);
        gradient.addColorStop(0, '#ffffff');
        gradient.addColorStop(1, `rgb(${baseColor.r}, ${baseColor.g}, ${baseColor.b})`);

        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, width, height);

        // Add black gradient from top to bottom
        const blackGradient = ctx.createLinearGradient(0, 0, 0, height);
        blackGradient.addColorStop(0, 'rgba(0, 0, 0, 0)');
        blackGradient.addColorStop(1, 'rgba(0, 0, 0, 1)');

        ctx.fillStyle = blackGradient;
        ctx.fillRect(0, 0, width, height);
    }

    drawHueStrip() {
        const ctx = this.hueCtx;
        const width = this.hueCanvas.width;
        const height = this.hueCanvas.height;

        const gradient = ctx.createLinearGradient(0, 0, width, 0);

        for (let i = 0; i <= 360; i += 60) {
            const color = this.hsvToRgb(i, 100, 100);
            gradient.addColorStop(i / 360, `rgb(${color.r}, ${color.g}, ${color.b})`);
        }

        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, width, height);
    }

    drawAlphaStrip() {
        const ctx = this.alphaCtx;
        const width = this.alphaCanvas.width;
        const height = this.alphaCanvas.height;

        // Checkerboard pattern
        const checkSize = 8;
        for (let x = 0; x < width; x += checkSize) {
            for (let y = 0; y < height; y += checkSize) {
                const isLight = (Math.floor(x / checkSize) + Math.floor(y / checkSize)) % 2 === 0;
                ctx.fillStyle = isLight ? '#ffffff' : '#cccccc';
                ctx.fillRect(x, y, checkSize, checkSize);
            }
        }

        // Alpha gradient
        const gradient = ctx.createLinearGradient(0, 0, width, 0);
        gradient.addColorStop(0, 'rgba(255, 0, 0, 0)');
        gradient.addColorStop(1, 'rgba(255, 0, 0, 1)');

        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, width, height);
    }

    hsvToRgb(h, s, v) {
        h = h / 60;
        s = s / 100;
        v = v / 100;

        const c = v * s;
        const x = c * (1 - Math.abs((h % 2) - 1));
        const m = v - c;

        let r, g, b;

        if (h < 1) {
            r = c; g = x; b = 0;
        } else if (h < 2) {
            r = x; g = c; b = 0;
        } else if (h < 3) {
            r = 0; g = c; b = x;
        } else if (h < 4) {
            r = 0; g = x; b = c;
        } else if (h < 5) {
            r = x; g = 0; b = c;
        } else {
            r = c; g = 0; b = x;
        }

        return {
            r: Math.round((r + m) * 255),
            g: Math.round((g + m) * 255),
            b: Math.round((b + m) * 255)
        };
    }

    rgbToHsl(r, g, b) {
        r /= 255;
        g /= 255;
        b /= 255;

        const max = Math.max(r, g, b);
        const min = Math.min(r, g, b);
        const diff = max - min;

        let h, s, l = (max + min) / 2;

        if (diff === 0) {
            h = s = 0;
        } else {
            s = l > 0.5 ? diff / (2 - max - min) : diff / (max + min);

            switch (max) {
                case r: h = (g - b) / diff + (g < b ? 6 : 0); break;
                case g: h = (b - r) / diff + 2; break;
                case b: h = (r - g) / diff + 4; break;
            }
            h /= 6;
        }

        return {
            h: Math.round(h * 360),
            s: Math.round(s * 100),
            l: Math.round(l * 100)
        };
    }

    calculateContrastRatio(color1, color2) {
        const getLuminance = (r, g, b) => {
            const [rs, gs, bs] = [r, g, b].map(c => {
                c = c / 255;
                return c <= 0.03928 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4);
            });
            return 0.2126 * rs + 0.7152 * gs + 0.0722 * bs;
        };

        const l1 = getLuminance(color1.r, color1.g, color1.b);
        const l2 = getLuminance(color2.r, color2.g, color2.b);

        const lighter = Math.max(l1, l2);
        const darker = Math.min(l1, l2);

        return (lighter + 0.05) / (darker + 0.05);
    }

    updateAll() {
        this.updateColorDisplay();
        this.updateColorInputs();
        this.updateColorValues();
        this.updateAccessibility();
    }

    updateColorDisplay() {
        const rgb = this.currentColor;
        const color = `rgb(${rgb.r}, ${rgb.g}, ${rgb.b})`;
        const hex = this.rgbToHex(rgb.r, rgb.g, rgb.b);

        document.getElementById('colorDisplay').style.backgroundColor = color;
        document.getElementById('colorDisplayText').textContent = hex;
    }

    rgbToHex(r, g, b) {
        return "#" + [r, g, b].map(x => {
            const hex = x.toString(16);
            return hex.length === 1 ? "0" + hex : hex;
        }).join("");
    }

    generateColorHarmony(baseColor, type) {
        const hsl = this.rgbToHsl(baseColor.r, baseColor.g, baseColor.b);
        const colors = [];

        switch (type) {
            case 'complementary':
                colors.push(this.hslToRgb(hsl.h, hsl.s, hsl.l));
                colors.push(this.hslToRgb((hsl.h + 180) % 360, hsl.s, hsl.l));
                break;
            case 'triadic':
                colors.push(this.hslToRgb(hsl.h, hsl.s, hsl.l));
                colors.push(this.hslToRgb((hsl.h + 120) % 360, hsl.s, hsl.l));
                colors.push(this.hslToRgb((hsl.h + 240) % 360, hsl.s, hsl.l));
                break;
            case 'analogous':
                colors.push(this.hslToRgb((hsl.h - 30) % 360, hsl.s, hsl.l));
                colors.push(this.hslToRgb(hsl.h, hsl.s, hsl.l));
                colors.push(this.hslToRgb((hsl.h + 30) % 360, hsl.s, hsl.l));
                break;
        }

        return colors;
    }
}

const colorPicker = new ColorPicker();
        </code></pre>
    </div>
</div>

<script>
class ColorPicker {
    constructor() {
        this.currentColor = { r: 255, g: 0, b: 0 };
        this.currentHue = 0;
        this.currentAlpha = 1;
        this.palette = [];
        this.init();
    }

    init() {
        this.setupCanvases();
        this.bindEvents();
        this.updateAll();
    }

    setupCanvases() {
        this.colorCanvas = document.getElementById('colorCanvas');
        this.colorCtx = this.colorCanvas.getContext('2d');

        this.hueCanvas = document.getElementById('hueCanvas');
        this.hueCtx = this.hueCanvas.getContext('2d');

        this.alphaCanvas = document.getElementById('alphaCanvas');
        this.alphaCtx = this.alphaCanvas.getContext('2d');

        this.drawHueStrip();
        this.drawColorArea();
        this.drawAlphaStrip();
    }

    bindEvents() {
        // Color canvas events
        this.colorCanvas.addEventListener('mousedown', (e) => {
            this.isColorDragging = true;
            this.updateColorFromCanvas(e);
        });

        this.colorCanvas.addEventListener('mousemove', (e) => {
            if (this.isColorDragging) {
                this.updateColorFromCanvas(e);
            }
        });

        // Hue canvas events
        this.hueCanvas.addEventListener('mousedown', (e) => {
            this.isHueDragging = true;
            this.updateHueFromCanvas(e);
        });

        this.hueCanvas.addEventListener('mousemove', (e) => {
            if (this.isHueDragging) {
                this.updateHueFromCanvas(e);
            }
        });

        // Alpha canvas events
        this.alphaCanvas.addEventListener('mousedown', (e) => {
            this.isAlphaDragging = true;
            this.updateAlphaFromCanvas(e);
        });

        this.alphaCanvas.addEventListener('mousemove', (e) => {
            if (this.isAlphaDragging) {
                this.updateAlphaFromCanvas(e);
            }
        });

        // Stop dragging
        document.addEventListener('mouseup', () => {
            this.isColorDragging = false;
            this.isHueDragging = false;
            this.isAlphaDragging = false;
        });

        // Input events
        document.getElementById('hexInput').addEventListener('input', (e) => {
            const hex = e.target.value;
            if (hex.match(/^#[0-9A-F]{6}$/i)) {
                this.setColorFromHex(hex);
            }
        });

        document.getElementById('htmlColorInput').addEventListener('input', (e) => {
            this.setColorFromHex(e.target.value);
        });

        // RGB inputs
        ['rgbR', 'rgbG', 'rgbB'].forEach(id => {
            document.getElementById(id).addEventListener('input', () => {
                this.updateColorFromRGB();
            });
        });

        // HSL inputs
        ['hslH', 'hslS', 'hslL'].forEach(id => {
            document.getElementById(id).addEventListener('input', () => {
                this.updateColorFromHSL();
            });
        });

        // Accessibility background
        document.getElementById('accessibilityBg').addEventListener('input', () => {
            this.updateAccessibility();
        });
    }

    updateColorFromCanvas(e) {
        const rect = this.colorCanvas.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const canvasX = x * (this.colorCanvas.width / rect.width);
        const canvasY = y * (this.colorCanvas.height / rect.height);

        const saturation = Math.max(0, Math.min(100, (canvasX / this.colorCanvas.width) * 100));
        const value = Math.max(0, Math.min(100, 100 - (canvasY / this.colorCanvas.height) * 100));

        this.currentColor = this.hsvToRgb(this.currentHue, saturation, value);
        this.updateColorPointer(x, y);
        this.updateAll();
    }

    updateHueFromCanvas(e) {
        const rect = this.hueCanvas.getBoundingClientRect();
        const x = e.clientX - rect.left;

        const canvasX = x * (this.hueCanvas.width / rect.width);
        this.currentHue = Math.max(0, Math.min(360, (canvasX / this.hueCanvas.width) * 360));

        this.updateHuePointer(x);
        this.drawColorArea();
        this.updateAll();
    }

    updateAlphaFromCanvas(e) {
        const rect = this.alphaCanvas.getBoundingClientRect();
        const x = e.clientX - rect.left;

        const canvasX = x * (this.alphaCanvas.width / rect.width);
        this.currentAlpha = Math.max(0, Math.min(1, canvasX / this.alphaCanvas.width));

        this.updateAlphaPointer(x);
        this.updateAll();
    }

    updateColorPointer(x, y) {
        const pointer = document.getElementById('colorPointer');
        pointer.style.left = x + 'px';
        pointer.style.top = y + 'px';
    }

    updateHuePointer(x) {
        const pointer = document.getElementById('huePointer');
        pointer.style.left = x + 'px';
    }

    updateAlphaPointer(x) {
        const pointer = document.getElementById('alphaPointer');
        pointer.style.left = x + 'px';
    }

    drawColorArea() {
        const ctx = this.colorCtx;
        const width = this.colorCanvas.width;
        const height = this.colorCanvas.height;

        // Base color from hue
        const baseColor = this.hsvToRgb(this.currentHue, 100, 100);

        // Create gradient
        const gradient = ctx.createLinearGradient(0, 0, width, 0);
        gradient.addColorStop(0, '#ffffff');
        gradient.addColorStop(1, `rgb(${baseColor.r}, ${baseColor.g}, ${baseColor.b})`);

        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, width, height);

        // Add black gradient from top to bottom
        const blackGradient = ctx.createLinearGradient(0, 0, 0, height);
        blackGradient.addColorStop(0, 'rgba(0, 0, 0, 0)');
        blackGradient.addColorStop(1, 'rgba(0, 0, 0, 1)');

        ctx.fillStyle = blackGradient;
        ctx.fillRect(0, 0, width, height);
    }

    drawHueStrip() {
        const ctx = this.hueCtx;
        const width = this.hueCanvas.width;
        const height = this.hueCanvas.height;

        const gradient = ctx.createLinearGradient(0, 0, width, 0);

        for (let i = 0; i <= 360; i += 60) {
            const color = this.hsvToRgb(i, 100, 100);
            gradient.addColorStop(i / 360, `rgb(${color.r}, ${color.g}, ${color.b})`);
        }

        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, width, height);
    }

    drawAlphaStrip() {
        const ctx = this.alphaCtx;
        const width = this.alphaCanvas.width;
        const height = this.alphaCanvas.height;

        // Checkerboard pattern
        const checkSize = 8;
        for (let x = 0; x < width; x += checkSize) {
            for (let y = 0; y < height; y += checkSize) {
                const isLight = (Math.floor(x / checkSize) + Math.floor(y / checkSize)) % 2 === 0;
                ctx.fillStyle = isLight ? '#ffffff' : '#cccccc';
                ctx.fillRect(x, y, checkSize, checkSize);
            }
        }

        // Alpha gradient
        const { r, g, b } = this.currentColor;
        const gradient = ctx.createLinearGradient(0, 0, width, 0);
        gradient.addColorStop(0, `rgba(${r}, ${g}, ${b}, 0)`);
        gradient.addColorStop(1, `rgba(${r}, ${g}, ${b}, 1)`);

        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, width, height);
    }

    hsvToRgb(h, s, v) {
        h = h / 60;
        s = s / 100;
        v = v / 100;

        const c = v * s;
        const x = c * (1 - Math.abs((h % 2) - 1));
        const m = v - c;

        let r, g, b;

        if (h < 1) {
            r = c; g = x; b = 0;
        } else if (h < 2) {
            r = x; g = c; b = 0;
        } else if (h < 3) {
            r = 0; g = c; b = x;
        } else if (h < 4) {
            r = 0; g = x; b = c;
        } else if (h < 5) {
            r = x; g = 0; b = c;
        } else {
            r = c; g = 0; b = x;
        }

        return {
            r: Math.round((r + m) * 255),
            g: Math.round((g + m) * 255),
            b: Math.round((b + m) * 255)
        };
    }

    rgbToHsl(r, g, b) {
        r /= 255;
        g /= 255;
        b /= 255;

        const max = Math.max(r, g, b);
        const min = Math.min(r, g, b);
        const diff = max - min;

        let h, s, l = (max + min) / 2;

        if (diff === 0) {
            h = s = 0;
        } else {
            s = l > 0.5 ? diff / (2 - max - min) : diff / (max + min);

            switch (max) {
                case r: h = (g - b) / diff + (g < b ? 6 : 0); break;
                case g: h = (b - r) / diff + 2; break;
                case b: h = (r - g) / diff + 4; break;
            }
            h /= 6;
        }

        return {
            h: Math.round(h * 360),
            s: Math.round(s * 100),
            l: Math.round(l * 100)
        };
    }

    hslToRgb(h, s, l) {
        h = h / 360;
        s = s / 100;
        l = l / 100;

        const hue2rgb = (p, q, t) => {
            if (t < 0) t += 1;
            if (t > 1) t -= 1;
            if (t < 1/6) return p + (q - p) * 6 * t;
            if (t < 1/2) return q;
            if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        };

        if (s === 0) {
            return { r: l * 255, g: l * 255, b: l * 255 };
        }

        const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        const p = 2 * l - q;

        return {
            r: Math.round(hue2rgb(p, q, h + 1/3) * 255),
            g: Math.round(hue2rgb(p, q, h) * 255),
            b: Math.round(hue2rgb(p, q, h - 1/3) * 255)
        };
    }

    rgbToHex(r, g, b) {
        return "#" + [r, g, b].map(x => {
            const hex = x.toString(16);
            return hex.length === 1 ? "0" + hex : hex;
        }).join("");
    }

    hexToRgb(hex) {
        const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    setColorFromHex(hex) {
        const rgb = this.hexToRgb(hex);
        if (rgb) {
            this.currentColor = rgb;
            this.updateAll();
        }
    }

    updateColorFromRGB() {
        const r = parseInt(document.getElementById('rgbR').value) || 0;
        const g = parseInt(document.getElementById('rgbG').value) || 0;
        const b = parseInt(document.getElementById('rgbB').value) || 0;

        this.currentColor = { r, g, b };
        this.updateAll();
    }

    updateColorFromHSL() {
        const h = parseInt(document.getElementById('hslH').value) || 0;
        const s = parseInt(document.getElementById('hslS').value) || 0;
        const l = parseInt(document.getElementById('hslL').value) || 0;

        this.currentColor = this.hslToRgb(h, s, l);
        this.updateAll();
    }

    updateAll() {
        this.updateColorDisplay();
        this.updateColorInputs();
        this.updateColorValues();
        this.updateAccessibility();
        this.drawAlphaStrip();
    }

    updateColorDisplay() {
        const { r, g, b } = this.currentColor;
        const color = `rgba(${r}, ${g}, ${b}, ${this.currentAlpha})`;
        const hex = this.rgbToHex(r, g, b);

        document.getElementById('colorDisplay').style.backgroundColor = color;
        document.getElementById('colorDisplayText').textContent = hex;
    }

    updateColorInputs() {
        const { r, g, b } = this.currentColor;
        const hex = this.rgbToHex(r, g, b);

        document.getElementById('hexInput').value = hex;
        document.getElementById('htmlColorInput').value = hex;
    }

    updateColorValues() {
        const { r, g, b } = this.currentColor;
        const hsl = this.rgbToHsl(r, g, b);

        // Update RGB
        document.getElementById('rgbR').value = r;
        document.getElementById('rgbG').value = g;
        document.getElementById('rgbB').value = b;

        // Update HSL
        document.getElementById('hslH').value = hsl.h;
        document.getElementById('hslS').value = hsl.s;
        document.getElementById('hslL').value = hsl.l;

        // Update HSV (simplified)
        document.getElementById('hsvH').value = hsl.h;
        document.getElementById('hsvS').value = hsl.s;
        document.getElementById('hsvV').value = hsl.l;

        // Update CMYK (simplified conversion)
        const cmyk = this.rgbToCmyk(r, g, b);
        document.getElementById('cmykC').value = cmyk.c;
        document.getElementById('cmykM').value = cmyk.m;
        document.getElementById('cmykY').value = cmyk.y;
        document.getElementById('cmykK').value = cmyk.k;
    }

    rgbToCmyk(r, g, b) {
        r /= 255;
        g /= 255;
        b /= 255;

        const k = 1 - Math.max(r, g, b);
        const c = (1 - r - k) / (1 - k) || 0;
        const m = (1 - g - k) / (1 - k) || 0;
        const y = (1 - b - k) / (1 - k) || 0;

        return {
            c: Math.round(c * 100),
            m: Math.round(m * 100),
            y: Math.round(y * 100),
            k: Math.round(k * 100)
        };
    }

    calculateContrastRatio(color1, color2) {
        const getLuminance = (r, g, b) => {
            const [rs, gs, bs] = [r, g, b].map(c => {
                c = c / 255;
                return c <= 0.03928 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4);
            });
            return 0.2126 * rs + 0.7152 * gs + 0.0722 * bs;
        };

        const l1 = getLuminance(color1.r, color1.g, color1.b);
        const l2 = getLuminance(color2.r, color2.g, color2.b);

        const lighter = Math.max(l1, l2);
        const darker = Math.min(l1, l2);

        return (lighter + 0.05) / (darker + 0.05);
    }

    updateAccessibility() {
        const bgColor = this.hexToRgb(document.getElementById('accessibilityBg').value);
        const fgColor = this.currentColor;

        const ratio = this.calculateContrastRatio(fgColor, bgColor);

        document.getElementById('contrastRatio').textContent = ratio.toFixed(2) + ':1';

        const wcagAA = document.getElementById('wcagAA');
        const wcagAAA = document.getElementById('wcagAAA');

        if (ratio >= 4.5) {
            wcagAA.className = 'text-center py-1 rounded text-xs bg-green-100 text-green-800';
            wcagAA.textContent = 'AA ✓';
        } else {
            wcagAA.className = 'text-center py-1 rounded text-xs bg-red-100 text-red-800';
            wcagAA.textContent = 'AA ✗';
        }

        if (ratio >= 7) {
            wcagAAA.className = 'text-center py-1 rounded text-xs bg-green-100 text-green-800';
            wcagAAA.textContent = 'AAA ✓';
        } else {
            wcagAAA.className = 'text-center py-1 rounded text-xs bg-red-100 text-red-800';
            wcagAAA.textContent = 'AAA ✗';
        }

        const preview = document.getElementById('accessibilityPreview');
        preview.style.backgroundColor = this.rgbToHex(bgColor.r, bgColor.g, bgColor.b);
        preview.style.color = this.rgbToHex(fgColor.r, fgColor.g, fgColor.b);
    }

    addToPalette() {
        const { r, g, b } = this.currentColor;
        const hex = this.rgbToHex(r, g, b);

        if (!this.palette.includes(hex)) {
            this.palette.push(hex);
            this.updatePaletteDisplay();
            showSuccess('Color added to palette');
        } else {
            showInfo('Color already in palette');
        }
    }

    updatePaletteDisplay() {
        const paletteElement = document.getElementById('colorPalette');

        paletteElement.innerHTML = this.palette.map(color => `
            <div class="aspect-square rounded cursor-pointer border-2 border-gray-300 hover:border-gray-500"
                 style="background-color: ${color};"
                 onclick="selectPaletteColor('${color}')"
                 title="${color}">
            </div>
        `).join('');
    }

    selectPaletteColor(hex) {
        this.setColorFromHex(hex);
        showInfo('Color selected from palette');
    }

    clearPalette() {
        this.palette = [];
        this.updatePaletteDisplay();
        showInfo('Palette cleared');
    }

    generateHarmony() {
        const type = document.getElementById('harmonyType').value;
        const hsl = this.rgbToHsl(this.currentColor.r, this.currentColor.g, this.currentColor.b);
        const colors = [];

        switch (type) {
            case 'complementary':
                colors.push(this.currentColor);
                colors.push(this.hslToRgb((hsl.h + 180) % 360, hsl.s, hsl.l));
                break;
            case 'triadic':
                colors.push(this.currentColor);
                colors.push(this.hslToRgb((hsl.h + 120) % 360, hsl.s, hsl.l));
                colors.push(this.hslToRgb((hsl.h + 240) % 360, hsl.s, hsl.l));
                break;
            case 'analogous':
                colors.push(this.hslToRgb((hsl.h - 30 + 360) % 360, hsl.s, hsl.l));
                colors.push(this.currentColor);
                colors.push(this.hslToRgb((hsl.h + 30) % 360, hsl.s, hsl.l));
                break;
            case 'split-complementary':
                colors.push(this.currentColor);
                colors.push(this.hslToRgb((hsl.h + 150) % 360, hsl.s, hsl.l));
                colors.push(this.hslToRgb((hsl.h + 210) % 360, hsl.s, hsl.l));
                break;
            case 'tetradic':
                colors.push(this.currentColor);
                colors.push(this.hslToRgb((hsl.h + 90) % 360, hsl.s, hsl.l));
                colors.push(this.hslToRgb((hsl.h + 180) % 360, hsl.s, hsl.l));
                colors.push(this.hslToRgb((hsl.h + 270) % 360, hsl.s, hsl.l));
                break;
            case 'monochromatic':
                colors.push(this.hslToRgb(hsl.h, hsl.s, Math.max(10, hsl.l - 30)));
                colors.push(this.hslToRgb(hsl.h, hsl.s, Math.max(10, hsl.l - 15)));
                colors.push(this.currentColor);
                colors.push(this.hslToRgb(hsl.h, hsl.s, Math.min(90, hsl.l + 15)));
                colors.push(this.hslToRgb(hsl.h, hsl.s, Math.min(90, hsl.l + 30)));
                break;
        }

        const harmonyElement = document.getElementById('harmonyColors');
        harmonyElement.innerHTML = colors.map(color => {
            const hex = this.rgbToHex(color.r, color.g, color.b);
            return `
                <div class="aspect-square rounded cursor-pointer border-2 border-gray-300 hover:border-gray-500 flex items-center justify-center text-xs font-mono text-white text-shadow"
                     style="background-color: ${hex};"
                     onclick="selectHarmonyColor('${hex}')"
                     title="${hex}">
                    ${hex}
                </div>
            `;
        }).join('');

        showSuccess('Color harmony generated');
    }

    selectHarmonyColor(hex) {
        this.setColorFromHex(hex);
        showInfo('Harmony color selected');
    }

    generateGradient() {
        const startColor = document.getElementById('gradientStart').value;
        const endColor = document.getElementById('gradientEnd').value;
        const direction = document.getElementById('gradientDirection').value;

        const gradient = `linear-gradient(${direction}, ${startColor}, ${endColor})`;

        document.getElementById('gradientPreview').style.background = gradient;
        document.getElementById('gradientCSS').value = `background: ${gradient};`;

        showSuccess('Gradient generated');
    }
}

// Global functions
let colorPicker;

function addToPalette() {
    colorPicker.addToPalette();
}

function clearPalette() {
    colorPicker.clearPalette();
}

function generateHarmony() {
    colorPicker.generateHarmony();
}

function selectPaletteColor(hex) {
    colorPicker.selectPaletteColor(hex);
}

function selectHarmonyColor(hex) {
    colorPicker.selectHarmonyColor(hex);
}

function generateGradient() {
    colorPicker.generateGradient();
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    colorPicker = new ColorPicker();

    // Initialize gradient
    generateGradient();

    setTimeout(() => {
        showInfo('Color Picker ready! Click and drag to select colors.');
    }, 1000);
});
</script>

<style>
.text-shadow {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
}
</style>
@endsection
