@extends('layouts.app')

@section('title', 'QR Code')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">QR Code Generator & Scanner</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- QR Code Generator -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Generate QR Code</h2>

                <form id="qrGeneratorForm" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">QR Type</label>
                        <select id="qrType" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500">
                            <option value="text">Text</option>
                            <option value="url">URL</option>
                            <option value="email">Email</option>
                            <option value="phone">Phone</option>
                            <option value="wifi">WiFi</option>
                            <option value="vcard">Contact Card</option>
                        </select>
                    </div>

                    <div id="inputFields">
                        <!-- Dynamic input fields based on QR type -->
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Size</label>
                            <select id="qrSize" class="w-full px-3 py-2 border rounded">
                                <option value="200">200x200</option>
                                <option value="300" selected>300x300</option>
                                <option value="400">400x400</option>
                                <option value="500">500x500</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Error Correction</label>
                            <select id="errorCorrection" class="w-full px-3 py-2 border rounded">
                                <option value="L">Low</option>
                                <option value="M" selected>Medium</option>
                                <option value="Q">Quartile</option>
                                <option value="H">High</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded">
                        Generate QR Code
                    </button>
                </form>

                <!-- Generated QR Code Display -->
                <div id="qrResult" class="mt-6 text-center" style="display: none;">
                    <div id="qrcode" class="mb-4"></div>
                    <button onclick="downloadQR()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mr-2">
                        Download PNG
                    </button>
                    <button onclick="printQR()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                        Print
                    </button>
                </div>
            </div>

            <!-- QR Code Scanner -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Scan QR Code</h2>

                <div class="space-y-4">
                    <div class="text-center">
                        <button id="startScanBtn" onclick="startScanning()"
                                class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded">
                            Start Camera Scan
                        </button>
                        <button id="stopScanBtn" onclick="stopScanning()"
                                class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded hidden">
                            Stop Scanning
                        </button>
                    </div>

                    <!-- Camera Preview -->
                    <div id="cameraPreview" class="hidden">
                        <video id="video" class="w-full rounded border" autoplay></video>
                        <canvas id="canvas" class="hidden"></canvas>
                    </div>

                    <!-- File Upload Scanner -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <p class="text-gray-600 mb-2">Or upload QR code image</p>
                        <input type="file" id="qrImageUpload" accept="image/*" class="hidden">
                        <button onclick="document.getElementById('qrImageUpload').click()"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Choose File
                        </button>
                    </div>

                    <!-- Scan Result -->
                    <div id="scanResult" class="hidden bg-white border rounded-lg p-4">
                        <h3 class="font-semibold text-gray-800 mb-2">Scan Result:</h3>
                        <div id="scanContent" class="text-gray-600 break-all"></div>
                        <button onclick="copyToClipboard()" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                            Copy to Clipboard
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">JavaScript Code:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// QR Code Generation using QRCode.js
function generateQR(text, size = 300) {
    const qrcode = new QRCode(document.getElementById('qrcode'), {
        text: text,
        width: size,
        height: size,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.M
    });
}

// QR Code Scanning using jsQR
function scanQRFromImage(imageFile) {
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const img = new Image();

    img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        context.drawImage(img, 0, 0);

        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height);

        if (code) {
            displayScanResult(code.data);
        } else {
            alert('No QR code found in image');
        }
    };

    img.src = URL.createObjectURL(imageFile);
}

// Camera-based scanning
async function startCameraScanning() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: 'environment' }
        });
        const video = document.getElementById('video');
        video.srcObject = stream;

        // Scan for QR codes continuously
        setInterval(() => {
            scanFrame(video);
        }, 100);

    } catch (err) {
        console.error('Camera access denied:', err);
        alert('Camera access is required for QR code scanning');
    }
}
        </code></pre>
    </div>
</div>

<!-- Include QR Code libraries -->
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>

<script>
let currentQRInstance = null;
let scanning = false;
let stream = null;

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateInputFields();

    document.getElementById('qrType').addEventListener('change', updateInputFields);
    document.getElementById('qrGeneratorForm').addEventListener('submit', handleQRGeneration);
    document.getElementById('qrImageUpload').addEventListener('change', handleImageUpload);
});

function updateInputFields() {
    const qrType = document.getElementById('qrType').value;
    const inputFields = document.getElementById('inputFields');

    const fieldTemplates = {
        text: '<div><label class="block text-gray-700 text-sm font-bold mb-2">Text Content</label><textarea id="textContent" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" rows="3" placeholder="Enter your text"></textarea></div>',

        url: '<div><label class="block text-gray-700 text-sm font-bold mb-2">URL</label><input type="url" id="urlContent" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" placeholder="https://example.com"></div>',

        email: '<div class="space-y-2"><label class="block text-gray-700 text-sm font-bold mb-2">Email</label><input type="email" id="emailAddress" class="w-full px-3 py-2 border rounded" placeholder="email@example.com"><input type="text" id="emailSubject" class="w-full px-3 py-2 border rounded" placeholder="Subject (optional)"><textarea id="emailBody" class="w-full px-3 py-2 border rounded" rows="2" placeholder="Message (optional)"></textarea></div>',

        phone: '<div><label class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label><input type="tel" id="phoneNumber" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" placeholder="+1234567890"></div>',

        wifi: '<div class="space-y-2"><label class="block text-gray-700 text-sm font-bold mb-2">WiFi Network</label><input type="text" id="wifiSSID" class="w-full px-3 py-2 border rounded" placeholder="Network Name (SSID)"><input type="password" id="wifiPassword" class="w-full px-3 py-2 border rounded" placeholder="Password"><select id="wifiSecurity" class="w-full px-3 py-2 border rounded"><option value="WPA">WPA/WPA2</option><option value="WEP">WEP</option><option value="nopass">No Password</option></select></div>',

        vcard: '<div class="space-y-2"><label class="block text-gray-700 text-sm font-bold mb-2">Contact Information</label><input type="text" id="vcardName" class="w-full px-3 py-2 border rounded" placeholder="Full Name"><input type="text" id="vcardOrg" class="w-full px-3 py-2 border rounded" placeholder="Organization"><input type="tel" id="vcardPhone" class="w-full px-3 py-2 border rounded" placeholder="Phone"><input type="email" id="vcardEmail" class="w-full px-3 py-2 border rounded" placeholder="Email"></div>'
    };

    inputFields.innerHTML = fieldTemplates[qrType];
}

function handleQRGeneration(e) {
    e.preventDefault();

    const qrType = document.getElementById('qrType').value;
    let content = '';

    switch(qrType) {
        case 'text':
            content = document.getElementById('textContent').value;
            break;
        case 'url':
            content = document.getElementById('urlContent').value;
            break;
        case 'email':
            const email = document.getElementById('emailAddress').value;
            const subject = document.getElementById('emailSubject').value;
            const body = document.getElementById('emailBody').value;
            content = `mailto:${email}${subject ? '?subject=' + encodeURIComponent(subject) : ''}${body ? (subject ? '&' : '?') + 'body=' + encodeURIComponent(body) : ''}`;
            break;
        case 'phone':
            content = `tel:${document.getElementById('phoneNumber').value}`;
            break;
        case 'wifi':
            const ssid = document.getElementById('wifiSSID').value;
            const password = document.getElementById('wifiPassword').value;
            const security = document.getElementById('wifiSecurity').value;
            content = `WIFI:T:${security};S:${ssid};P:${password};;`;
            break;
        case 'vcard':
            const name = document.getElementById('vcardName').value;
            const org = document.getElementById('vcardOrg').value;
            const phone = document.getElementById('vcardPhone').value;
            const vcardEmail = document.getElementById('vcardEmail').value;
            content = `BEGIN:VCARD\nVERSION:3.0\nFN:${name}\nORG:${org}\nTEL:${phone}\nEMAIL:${vcardEmail}\nEND:VCARD`;
            break;
    }

    if (!content) {
        alert('Please fill in the required fields');
        return;
    }

    generateQR(content);
}

function generateQR(text) {
    const qrCodeDiv = document.getElementById('qrcode');
    qrCodeDiv.innerHTML = ''; // Clear previous QR code

    const size = parseInt(document.getElementById('qrSize').value);
    const errorCorrectionLevel = document.getElementById('errorCorrection').value;

    currentQRInstance = new QRCode(qrCodeDiv, {
        text: text,
        width: size,
        height: size,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel[errorCorrectionLevel]
    });

    document.getElementById('qrResult').style.display = 'block';
}

function downloadQR() {
    const canvas = document.querySelector('#qrcode canvas');
    if (canvas) {
        const link = document.createElement('a');
        link.download = 'qrcode.png';
        link.href = canvas.toDataURL();
        link.click();
    }
}

function printQR() {
    const qrcode = document.getElementById('qrcode').innerHTML;
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
            <head><title>Print QR Code</title></head>
            <body style="text-align: center; padding: 20px;">
                ${qrcode}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

// Scanner functions
async function startScanning() {
    try {
        stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: 'environment' }
        });

        const video = document.getElementById('video');
        video.srcObject = stream;

        document.getElementById('cameraPreview').classList.remove('hidden');
        document.getElementById('startScanBtn').classList.add('hidden');
        document.getElementById('stopScanBtn').classList.remove('hidden');

        scanning = true;
        scanFrame();

    } catch (err) {
        console.error('Camera access denied:', err);
        alert('Camera access is required for QR code scanning. Please allow camera access and try again.');
    }
}

function stopScanning() {
    scanning = false;

    if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
    }

    document.getElementById('cameraPreview').classList.add('hidden');
    document.getElementById('startScanBtn').classList.remove('hidden');
    document.getElementById('stopScanBtn').classList.add('hidden');
}

function scanFrame() {
    if (!scanning) return;

    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height);

        if (code) {
            displayScanResult(code.data);
            stopScanning();
            return;
        }
    }

    requestAnimationFrame(scanFrame);
}

function handleImageUpload(e) {
    const file = e.target.files[0];
    if (file) {
        scanQRFromImage(file);
    }
}

function scanQRFromImage(imageFile) {
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const img = new Image();

    img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        context.drawImage(img, 0, 0);

        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height);

        if (code) {
            displayScanResult(code.data);
        } else {
            alert('No QR code found in the uploaded image');
        }
    };

    img.src = URL.createObjectURL(imageFile);
}

function displayScanResult(data) {
    document.getElementById('scanContent').textContent = data;
    document.getElementById('scanResult').classList.remove('hidden');
}

function copyToClipboard() {
    const content = document.getElementById('scanContent').textContent;
    navigator.clipboard.writeText(content).then(() => {
        alert('Copied to clipboard!');
    });
}
</script>
@endsection
