@extends('layouts.app')

@section('title', 'QR Code Generator')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">QR Code Generator</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Generator -->
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Generate QR Code</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">QR Code Type</label>
                            <select id="qrType" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                <option value="text">Text/URL</option>
                                <option value="wifi">WiFi</option>
                                <option value="email">Email</option>
                                <option value="phone">Phone</option>
                                <option value="sms">SMS</option>
                                <option value="vcard">vCard</option>
                                <option value="location">Location</option>
                            </select>
                        </div>

                        <!-- Text/URL Input -->
                        <div id="textInput" class="input-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Text or URL</label>
                            <textarea id="textContent" class="w-full border border-gray-300 rounded-md px-3 py-2 h-24" placeholder="Enter text or URL"></textarea>
                        </div>

                        <!-- WiFi Input -->
                        <div id="wifiInput" class="input-group hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">WiFi Network</label>
                            <input type="text" id="wifiSSID" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="Network Name (SSID)">
                            <input type="password" id="wifiPassword" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="Password">
                            <select id="wifiSecurity" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                <option value="WPA">WPA/WPA2</option>
                                <option value="WEP">WEP</option>
                                <option value="nopass">No Password</option>
                            </select>
                        </div>

                        <!-- Email Input -->
                        <div id="emailInput" class="input-group hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="emailTo" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="To email">
                            <input type="text" id="emailSubject" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="Subject">
                            <textarea id="emailBody" class="w-full border border-gray-300 rounded-md px-3 py-2 h-20" placeholder="Message body"></textarea>
                        </div>

                        <!-- Phone Input -->
                        <div id="phoneInput" class="input-group hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phoneNumber" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="+1234567890">
                        </div>

                        <!-- SMS Input -->
                        <div id="smsInput" class="input-group hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">SMS</label>
                            <input type="tel" id="smsNumber" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="Phone number">
                            <textarea id="smsMessage" class="w-full border border-gray-300 rounded-md px-3 py-2 h-20" placeholder="Message"></textarea>
                        </div>

                        <!-- vCard Input -->
                        <div id="vcardInput" class="input-group hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contact Information</label>
                            <input type="text" id="vcardName" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="Full Name">
                            <input type="text" id="vcardOrg" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="Organization">
                            <input type="tel" id="vcardPhone" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="Phone">
                            <input type="email" id="vcardEmail" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="Email">
                            <input type="url" id="vcardWebsite" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Website">
                        </div>

                        <!-- Location Input -->
                        <div id="locationInput" class="input-group hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="number" id="locationLat" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2" placeholder="Latitude" step="any">
                            <input type="number" id="locationLng" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Longitude" step="any">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Size</label>
                                <select id="qrSize" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                    <option value="200">200x200</option>
                                    <option value="300" selected>300x300</option>
                                    <option value="400">400x400</option>
                                    <option value="500">500x500</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Error Correction</label>
                                <select id="qrErrorCorrection" class="w-full border border-gray-300 rounded-md px-3 py-2">
                                    <option value="L">Low (7%)</option>
                                    <option value="M" selected>Medium (15%)</option>
                                    <option value="Q">Quartile (25%)</option>
                                    <option value="H">High (30%)</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foreground Color</label>
                                <input type="color" id="qrFgColor" class="w-full h-10 border border-gray-300 rounded-md" value="#000000">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Background Color</label>
                                <input type="color" id="qrBgColor" class="w-full h-10 border border-gray-300 rounded-md" value="#ffffff">
                            </div>
                        </div>

                        <button onclick="generateQR()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                            Generate QR Code
                        </button>
                    </div>
                </div>
            </div>

            <!-- Preview and Download -->
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Preview</h2>
                    <div id="qrPreview" class="flex justify-center items-center h-80 bg-white rounded-lg border-2 border-dashed border-gray-300">
                        <div class="text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p>QR Code will appear here</p>
                        </div>
                    </div>
                </div>

                <div id="downloadSection" class="bg-gray-50 rounded-lg p-6 hidden">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Download</h2>
                    <div class="space-y-3">
                        <button onclick="downloadQR('png')" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">
                            Download PNG
                        </button>
                        <button onclick="downloadQR('svg')" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-md">
                            Download SVG
                        </button>
                        <button onclick="printQR()" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md">
                            Print QR Code
                        </button>
                    </div>
                </div>

                <!-- QR Code History -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent QR Codes</h2>
                    <div id="qrHistory" class="space-y-3 max-h-64 overflow-y-auto">
                        <div class="text-gray-500 text-sm">No QR codes generated yet</div>
                    </div>
                    <button onclick="clearHistory()" class="mt-3 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                        Clear History
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">QR Code Generation Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
class QRCodeGenerator {
    constructor() {
        this.history = [];
        this.currentQR = null;
        this.init();
    }

    init() {
        this.bindEvents();
    }

    generateQR(data, options = {}) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        const size = options.size || 300;
        const errorCorrection = options.errorCorrection || 'M';
        const fgColor = options.fgColor || '#000000';
        const bgColor = options.bgColor || '#ffffff';

        canvas.width = size;
        canvas.height = size;

        // Generate QR code using QR.js library
        const qr = new QRCode(-1, QRCode.ErrorCorrectLevel[errorCorrection]);
        qr.addData(data);
        qr.make();

        const moduleCount = qr.getModuleCount();
        const tileSize = size / moduleCount;

        // Fill background
        ctx.fillStyle = bgColor;
        ctx.fillRect(0, 0, size, size);

        // Draw QR modules
        ctx.fillStyle = fgColor;
        for (let row = 0; row < moduleCount; row++) {
            for (let col = 0; col < moduleCount; col++) {
                if (qr.isDark(row, col)) {
                    ctx.fillRect(col * tileSize, row * tileSize, tileSize, tileSize);
                }
            }
        }

        return canvas;
    }

    generateWiFiQR(ssid, password, security) {
        const wifiString = `WIFI:T:${security};S:${ssid};P:${password};;`;
        return this.generateQR(wifiString);
    }

    generateEmailQR(to, subject, body) {
        const emailString = `mailto:${to}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        return this.generateQR(emailString);
    }

    generateVCardQR(contact) {
        const vcard = `BEGIN:VCARD
VERSION:3.0
FN:${contact.name}
ORG:${contact.org}
TEL:${contact.phone}
EMAIL:${contact.email}
URL:${contact.website}
END:VCARD`;
        return this.generateQR(vcard);
    }

    downloadQR(format) {
        if (!this.currentQR) return;

        const link = document.createElement('a');

        if (format === 'png') {
            link.download = 'qrcode.png';
            link.href = this.currentQR.toDataURL();
        } else if (format === 'svg') {
            const svg = this.canvasToSVG(this.currentQR);
            const blob = new Blob([svg], { type: 'image/svg+xml' });
            link.download = 'qrcode.svg';
            link.href = URL.createObjectURL(blob);
        }

        link.click();
    }

    canvasToSVG(canvas) {
        const ctx = canvas.getContext('2d');
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const data = imageData.data;

        let svg = `<svg xmlns="http://www.w3.org/2000/svg" width="${canvas.width}" height="${canvas.height}">`;

        for (let y = 0; y < canvas.height; y++) {
            for (let x = 0; x < canvas.width; x++) {
                const index = (y * canvas.width + x) * 4;
                const r = data[index];
                const g = data[index + 1];
                const b = data[index + 2];

                if (r === 0 && g === 0 && b === 0) { // Black pixel
                    svg += `<rect x="${x}" y="${y}" width="1" height="1" fill="black"/>`;
                }
            }
        }

        svg += '</svg>';
        return svg;
    }

    addToHistory(data, type) {
        this.history.unshift({
            data: data,
            type: type,
            timestamp: new Date(),
            canvas: this.currentQR
        });

        if (this.history.length > 10) {
            this.history.pop();
        }

        this.updateHistoryDisplay();
    }

    updateHistoryDisplay() {
        const historyElement = document.getElementById('qrHistory');

        if (this.history.length === 0) {
            historyElement.innerHTML = '<div class="text-gray-500 text-sm">No QR codes generated yet</div>';
            return;
        }

        historyElement.innerHTML = this.history.map((item, index) => `
            <div class="bg-white p-3 rounded flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center">
                        <canvas class="w-10 h-10"></canvas>
                    </div>
                    <div>
                        <div class="font-medium text-sm">${item.type}</div>
                        <div class="text-xs text-gray-500">${item.timestamp.toLocaleString()}</div>
                    </div>
                </div>
                <button onclick="regenerateFromHistory(${index})" class="text-blue-600 hover:text-blue-800 text-sm">
                    Use
                </button>
            </div>
        `).join('');
    }
}

const qrGenerator = new QRCodeGenerator();
        </code></pre>
    </div>
</div>

<script>
// Simple QR Code generation (simplified version)
class QRCodeGenerator {
    constructor() {
        this.history = [];
        this.currentQR = null;
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        document.getElementById('qrType').addEventListener('change', (e) => {
            this.showInputGroup(e.target.value);
        });
    }

    showInputGroup(type) {
        // Hide all input groups
        document.querySelectorAll('.input-group').forEach(group => {
            group.classList.add('hidden');
        });

        // Show selected input group
        document.getElementById(type + 'Input').classList.remove('hidden');
    }

    generateQR() {
        const type = document.getElementById('qrType').value;
        const size = parseInt(document.getElementById('qrSize').value);
        const fgColor = document.getElementById('qrFgColor').value;
        const bgColor = document.getElementById('qrBgColor').value;

        let data;

        switch (type) {
            case 'text':
                data = document.getElementById('textContent').value;
                break;
            case 'wifi':
                data = this.generateWiFiString();
                break;
            case 'email':
                data = this.generateEmailString();
                break;
            case 'phone':
                data = 'tel:' + document.getElementById('phoneNumber').value;
                break;
            case 'sms':
                data = 'sms:' + document.getElementById('smsNumber').value + '?body=' + encodeURIComponent(document.getElementById('smsMessage').value);
                break;
            case 'vcard':
                data = this.generateVCardString();
                break;
            case 'location':
                data = this.generateLocationString();
                break;
            default:
                data = document.getElementById('textContent').value;
        }

        if (!data.trim()) {
            showError('Please enter data to generate QR code');
            return;
        }

        this.createQRCode(data, size, fgColor, bgColor);
        this.addToHistory(data, type);

        document.getElementById('downloadSection').classList.remove('hidden');
        showSuccess('QR code generated successfully');
    }

    generateWiFiString() {
        const ssid = document.getElementById('wifiSSID').value;
        const password = document.getElementById('wifiPassword').value;
        const security = document.getElementById('wifiSecurity').value;

        return `WIFI:T:${security};S:${ssid};P:${password};;`;
    }

    generateEmailString() {
        const to = document.getElementById('emailTo').value;
        const subject = document.getElementById('emailSubject').value;
        const body = document.getElementById('emailBody').value;

        return `mailto:${to}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    }

    generateVCardString() {
        const name = document.getElementById('vcardName').value;
        const org = document.getElementById('vcardOrg').value;
        const phone = document.getElementById('vcardPhone').value;
        const email = document.getElementById('vcardEmail').value;
        const website = document.getElementById('vcardWebsite').value;

        return `BEGIN:VCARD\nVERSION:3.0\nFN:${name}\nORG:${org}\nTEL:${phone}\nEMAIL:${email}\nURL:${website}\nEND:VCARD`;
    }

    generateLocationString() {
        const lat = document.getElementById('locationLat').value;
        const lng = document.getElementById('locationLng').value;

        return `geo:${lat},${lng}`;
    }

    createQRCode(data, size, fgColor, bgColor) {
        // Create canvas
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        canvas.width = size;
        canvas.height = size;

        // Simple QR code pattern (for demonstration)
        this.drawSimpleQR(ctx, data, size, fgColor, bgColor);

        // Display in preview
        const preview = document.getElementById('qrPreview');
        preview.innerHTML = '';
        preview.appendChild(canvas);

        this.currentQR = canvas;
    }

    drawSimpleQR(ctx, data, size, fgColor, bgColor) {
        // Fill background
        ctx.fillStyle = bgColor;
        ctx.fillRect(0, 0, size, size);

        // Create a simple pattern based on data
        const gridSize = 21; // Standard QR code size
        const moduleSize = size / gridSize;

        ctx.fillStyle = fgColor;

        // Draw finder patterns (corners)
        this.drawFinderPattern(ctx, 0, 0, moduleSize);
        this.drawFinderPattern(ctx, (gridSize - 7) * moduleSize, 0, moduleSize);
        this.drawFinderPattern(ctx, 0, (gridSize - 7) * moduleSize, moduleSize);

        // Draw timing patterns
        for (let i = 8; i < gridSize - 8; i++) {
            if (i % 2 === 0) {
                ctx.fillRect(i * moduleSize, 6 * moduleSize, moduleSize, moduleSize);
                ctx.fillRect(6 * moduleSize, i * moduleSize, moduleSize, moduleSize);
            }
        }

        // Draw data modules (simplified pattern based on data hash)
        const hash = this.simpleHash(data);
        for (let y = 0; y < gridSize; y++) {
            for (let x = 0; x < gridSize; x++) {
                if (this.shouldDrawModule(x, y, hash, gridSize)) {
                    ctx.fillRect(x * moduleSize, y * moduleSize, moduleSize, moduleSize);
                }
            }
        }
    }

    drawFinderPattern(ctx, x, y, moduleSize) {
        // Draw 7x7 finder pattern
        ctx.fillRect(x, y, 7 * moduleSize, 7 * moduleSize);
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(x + moduleSize, y + moduleSize, 5 * moduleSize, 5 * moduleSize);
        ctx.fillStyle = '#000000';
        ctx.fillRect(x + 2 * moduleSize, y + 2 * moduleSize, 3 * moduleSize, 3 * moduleSize);
    }

    simpleHash(str) {
        let hash = 0;
        for (let i = 0; i < str.length; i++) {
            const char = str.charCodeAt(i);
            hash = ((hash << 5) - hash) + char;
            hash = hash & hash; // Convert to 32bit integer
        }
        return Math.abs(hash);
    }

    shouldDrawModule(x, y, hash, gridSize) {
        // Skip finder patterns and timing patterns
        if ((x < 9 && y < 9) || (x > gridSize - 9 && y < 9) || (x < 9 && y > gridSize - 9)) {
            return false;
        }
        if (x === 6 || y === 6) {
            return false;
        }

        // Generate pattern based on hash
        const index = y * gridSize + x;
        return (hash + index) % 3 === 0;
    }

    downloadQR(format) {
        if (!this.currentQR) {
            showError('Please generate a QR code first');
            return;
        }

        const link = document.createElement('a');

        if (format === 'png') {
            link.download = 'qrcode.png';
            link.href = this.currentQR.toDataURL();
        } else if (format === 'svg') {
            const svg = this.canvasToSVG(this.currentQR);
            const blob = new Blob([svg], { type: 'image/svg+xml' });
            link.download = 'qrcode.svg';
            link.href = URL.createObjectURL(blob);
        }

        link.click();
        showSuccess(`QR code downloaded as ${format.toUpperCase()}`);
    }

    canvasToSVG(canvas) {
        const ctx = canvas.getContext('2d');
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const data = imageData.data;

        let svg = `<svg xmlns="http://www.w3.org/2000/svg" width="${canvas.width}" height="${canvas.height}">`;

        for (let y = 0; y < canvas.height; y++) {
            for (let x = 0; x < canvas.width; x++) {
                const index = (y * canvas.width + x) * 4;
                const r = data[index];
                const g = data[index + 1];
                const b = data[index + 2];

                if (r < 128 && g < 128 && b < 128) { // Dark pixel
                    svg += `<rect x="${x}" y="${y}" width="1" height="1" fill="black"/>`;
                }
            }
        }

        svg += '</svg>';
        return svg;
    }

    printQR() {
        if (!this.currentQR) {
            showError('Please generate a QR code first');
            return;
        }

        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>QR Code</title>
                    <style>
                        body {
                            text-align: center;
                            font-family: Arial, sans-serif;
                            margin: 20px;
                        }
                        canvas {
                            border: 1px solid #ccc;
                            margin: 20px 0;
                        }
                        @media print {
                            body { margin: 0; }
                        }
                    </style>
                </head>
                <body>
                    <h1>QR Code</h1>
                    <canvas id="printCanvas"></canvas>
                    <p>Generated on ${new Date().toLocaleString()}</p>
                </body>
            </html>
        `);

        printWindow.document.close();

        const printCanvas = printWindow.document.getElementById('printCanvas');
        const printCtx = printCanvas.getContext('2d');

        printCanvas.width = this.currentQR.width;
        printCanvas.height = this.currentQR.height;
        printCtx.drawImage(this.currentQR, 0, 0);

        printWindow.print();
        showSuccess('QR code sent to printer');
    }

    addToHistory(data, type) {
        this.history.unshift({
            data: data,
            type: type,
            timestamp: new Date(),
            canvas: this.currentQR
        });

        if (this.history.length > 10) {
            this.history.pop();
        }

        this.updateHistoryDisplay();
    }

    updateHistoryDisplay() {
        const historyElement = document.getElementById('qrHistory');

        if (this.history.length === 0) {
            historyElement.innerHTML = '<div class="text-gray-500 text-sm">No QR codes generated yet</div>';
            return;
        }

        historyElement.innerHTML = this.history.map((item, index) => `
            <div class="bg-white p-3 rounded flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center overflow-hidden">
                        <canvas class="w-10 h-10" width="40" height="40"></canvas>
                    </div>
                    <div>
                        <div class="font-medium text-sm capitalize">${item.type}</div>
                        <div class="text-xs text-gray-500">${item.timestamp.toLocaleString()}</div>
                        <div class="text-xs text-gray-600 truncate max-w-32">${item.data}</div>
                    </div>
                </div>
                <button onclick="regenerateFromHistory(${index})" class="text-blue-600 hover:text-blue-800 text-sm">
                    Use
                </button>
            </div>
        `).join('');

        // Draw mini QR codes in history
        setTimeout(() => {
            const miniCanvases = historyElement.querySelectorAll('canvas');
            miniCanvases.forEach((canvas, index) => {
                const ctx = canvas.getContext('2d');
                ctx.drawImage(this.history[index].canvas, 0, 0, 40, 40);
            });
        }, 100);
    }

    clearHistory() {
        this.history = [];
        this.updateHistoryDisplay();
        showInfo('History cleared');
    }

    regenerateFromHistory(index) {
        const item = this.history[index];
        this.currentQR = item.canvas;

        const preview = document.getElementById('qrPreview');
        preview.innerHTML = '';
        preview.appendChild(item.canvas.cloneNode(true));

        document.getElementById('downloadSection').classList.remove('hidden');
        showInfo('QR code restored from history');
    }
}

// Global functions
let qrGenerator;

function generateQR() {
    qrGenerator.generateQR();
}

function downloadQR(format) {
    qrGenerator.downloadQR(format);
}

function printQR() {
    qrGenerator.printQR();
}

function clearHistory() {
    qrGenerator.clearHistory();
}

function regenerateFromHistory(index) {
    qrGenerator.regenerateFromHistory(index);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    qrGenerator = new QRCodeGenerator();

    setTimeout(() => {
        showInfo('QR Code Generator ready! Select a type and enter your data.');
    }, 1000);
});
</script>
@endsection
