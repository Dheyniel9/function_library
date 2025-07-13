@extends('layouts.app')

@section('title', 'API Testing Tool')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">API Testing Tool</h1>
        
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <!-- Request Builder -->
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Request Builder</h2>
                
                <!-- Method and URL -->
                <div class="flex space-x-2">
                    <select id="httpMethod" class="bg-white border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                        <option value="PUT">PUT</option>
                        <option value="DELETE">DELETE</option>
                        <option value="PATCH">PATCH</option>
                        <option value="HEAD">HEAD</option>
                        <option value="OPTIONS">OPTIONS</option>
                    </select>
                    <input type="text" id="apiUrl" placeholder="https://api.example.com/endpoint" 
                           class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button onclick="sendRequest()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium">
                        Send
                    </button>
                </div>
                
                <!-- Quick Examples -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Quick Examples</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <button onclick="loadExample('jsonplaceholder')" class="text-left bg-white border border-gray-200 rounded px-3 py-2 hover:bg-gray-100 text-sm">
                            JSONPlaceholder API
                        </button>
                        <button onclick="loadExample('httpbin')" class="text-left bg-white border border-gray-200 rounded px-3 py-2 hover:bg-gray-100 text-sm">
                            HTTPBin Testing
                        </button>
                        <button onclick="loadExample('github')" class="text-left bg-white border border-gray-200 rounded px-3 py-2 hover:bg-gray-100 text-sm">
                            GitHub API
                        </button>
                        <button onclick="loadExample('weather')" class="text-left bg-white border border-gray-200 rounded px-3 py-2 hover:bg-gray-100 text-sm">
                            Weather API
                        </button>
                    </div>
                </div>
                
                <!-- Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button onclick="switchTab('headers')" id="headersTab" class="tab-button active py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600">
                            Headers
                        </button>
                        <button onclick="switchTab('body')" id="bodyTab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700">
                            Body
                        </button>
                        <button onclick="switchTab('auth')" id="authTab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700">
                            Auth
                        </button>
                        <button onclick="switchTab('params')" id="paramsTab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700">
                            Params
                        </button>
                    </nav>
                </div>
                
                <!-- Headers Tab -->
                <div id="headersContent" class="tab-content">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-medium text-gray-700">Request Headers</h3>
                            <button onclick="addHeader()" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">
                                Add Header
                            </button>
                        </div>
                        <div id="headersContainer" class="space-y-2">
                            <div class="flex space-x-2">
                                <input type="text" placeholder="Header name" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                                <input type="text" placeholder="Header value" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                                <button onclick="removeHeader(this)" class="text-red-500 hover:text-red-700 px-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Body Tab -->
                <div id="bodyContent" class="tab-content hidden">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <label class="text-sm font-medium text-gray-700">Content Type:</label>
                            <select id="contentType" class="border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="application/json">JSON</option>
                                <option value="application/x-www-form-urlencoded">Form Data</option>
                                <option value="text/plain">Text</option>
                                <option value="application/xml">XML</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Request Body</label>
                            <textarea id="requestBody" rows="8" 
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                                      placeholder="Enter your request body here..."></textarea>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="formatJSON()" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
                                Format JSON
                            </button>
                            <button onclick="validateJSON()" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">
                                Validate JSON
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Auth Tab -->
                <div id="authContent" class="tab-content hidden">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Authentication Type</label>
                            <select id="authType" class="w-full border border-gray-300 rounded px-3 py-2">
                                <option value="none">No Authentication</option>
                                <option value="basic">Basic Auth</option>
                                <option value="bearer">Bearer Token</option>
                                <option value="api-key">API Key</option>
                            </select>
                        </div>
                        
                        <div id="basicAuth" class="auth-section hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <input type="text" id="basicUsername" class="w-full border border-gray-300 rounded px-3 py-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <input type="password" id="basicPassword" class="w-full border border-gray-300 rounded px-3 py-2">
                                </div>
                            </div>
                        </div>
                        
                        <div id="bearerAuth" class="auth-section hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bearer Token</label>
                            <input type="text" id="bearerToken" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Enter your bearer token">
                        </div>
                        
                        <div id="apiKeyAuth" class="auth-section hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Key</label>
                                    <input type="text" id="apiKeyName" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="e.g., X-API-Key">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Value</label>
                                    <input type="text" id="apiKeyValue" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Your API key">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Params Tab -->
                <div id="paramsContent" class="tab-content hidden">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-medium text-gray-700">Query Parameters</h3>
                            <button onclick="addParam()" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">
                                Add Parameter
                            </button>
                        </div>
                        <div id="paramsContainer" class="space-y-2">
                            <div class="flex space-x-2">
                                <input type="text" placeholder="Parameter name" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                                <input type="text" placeholder="Parameter value" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                                <button onclick="removeParam(this)" class="text-red-500 hover:text-red-700 px-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Response Panel -->
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Response</h2>
                
                <!-- Response Info -->
                <div id="responseInfo" class="bg-gray-50 rounded-lg p-4 hidden">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">Status:</span>
                            <span id="responseStatus" class="px-2 py-1 rounded text-xs font-medium"></span>
                            <span class="text-sm text-gray-600">Time:</span>
                            <span id="responseTime" class="text-sm font-medium"></span>
                            <span class="text-sm text-gray-600">Size:</span>
                            <span id="responseSize" class="text-sm font-medium"></span>
                        </div>
                        <button onclick="copyResponse()" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
                            Copy Response
                        </button>
                    </div>
                </div>
                
                <!-- Response Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button onclick="switchResponseTab('response')" id="responseTab" class="response-tab-button active py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600">
                            Response
                        </button>
                        <button onclick="switchResponseTab('response-headers')" id="responseHeadersTab" class="response-tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700">
                            Headers
                        </button>
                        <button onclick="switchResponseTab('cookies')" id="cookiesTab" class="response-tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700">
                            Cookies
                        </button>
                    </nav>
                </div>
                
                <!-- Response Content -->
                <div id="responseContent" class="response-tab-content">
                    <div id="loadingState" class="flex items-center justify-center p-8 text-gray-500 hidden">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                        <span class="ml-2">Sending request...</span>
                    </div>
                    
                    <div id="responseBody" class="bg-gray-900 text-green-400 rounded-lg p-4 min-h-48 font-mono text-sm overflow-auto hidden">
                        <pre id="responseText"></pre>
                    </div>
                    
                    <div id="emptyState" class="flex flex-col items-center justify-center p-8 text-gray-500">
                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.959 8.959 0 01-4.906-1.471L3 21l2.529-5.094A8.959 8.959 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path>
                        </svg>
                        <p class="text-lg font-medium">No response yet</p>
                        <p class="text-sm">Send a request to see the response here</p>
                    </div>
                </div>
                
                <div id="responseHeadersContent" class="response-tab-content hidden">
                    <div class="bg-gray-900 text-green-400 rounded-lg p-4 min-h-48 font-mono text-sm overflow-auto">
                        <pre id="responseHeadersText">Send a request to see response headers</pre>
                    </div>
                </div>
                
                <div id="cookiesContent" class="response-tab-content hidden">
                    <div class="bg-gray-900 text-green-400 rounded-lg p-4 min-h-48 font-mono text-sm overflow-auto">
                        <pre id="cookiesText">Send a request to see cookies</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">API Testing Tool Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
class APITester {
    constructor() {
        this.init();
    }

    async sendRequest(options) {
        const { method, url, headers, body, auth } = options;
        
        try {
            const startTime = Date.now();
            
            // Build request configuration
            const config = {
                method,
                headers: this.buildHeaders(headers, auth),
                mode: 'cors'
            };
            
            // Add body for non-GET requests
            if (method !== 'GET' && body) {
                config.body = this.formatBody(body, headers['Content-Type']);
            }
            
            // Send request
            const response = await fetch(url, config);
            const endTime = Date.now();
            
            // Process response
            const responseText = await response.text();
            const responseTime = endTime - startTime;
            
            return {
                status: response.status,
                statusText: response.statusText,
                headers: Object.fromEntries(response.headers.entries()),
                body: responseText,
                time: responseTime,
                size: new Blob([responseText]).size
            };
            
        } catch (error) {
            throw new Error(`Request failed: ${error.message}`);
        }
    }

    buildHeaders(customHeaders, auth) {
        let headers = { ...customHeaders };
        
        // Add authentication headers
        if (auth.type === 'basic') {
            const credentials = btoa(`${auth.username}:${auth.password}`);
            headers['Authorization'] = `Basic ${credentials}`;
        } else if (auth.type === 'bearer') {
            headers['Authorization'] = `Bearer ${auth.token}`;
        } else if (auth.type === 'api-key') {
            headers[auth.key] = auth.value;
        }
        
        return headers;
    }

    formatBody(body, contentType) {
        if (contentType === 'application/json') {
            return JSON.stringify(body);
        } else if (contentType === 'application/x-www-form-urlencoded') {
            return new URLSearchParams(body).toString();
        }
        return body;
    }
}
        </code></pre>
    </div>
</div>

<script>
class APITester {
    constructor() {
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        document.getElementById('authType').addEventListener('change', (e) => {
            this.toggleAuthSection(e.target.value);
        });
    }

    toggleAuthSection(authType) {
        document.querySelectorAll('.auth-section').forEach(section => {
            section.classList.add('hidden');
        });
        
        if (authType !== 'none') {
            const sectionId = authType === 'basic' ? 'basicAuth' : 
                             authType === 'bearer' ? 'bearerAuth' : 'apiKeyAuth';
            document.getElementById(sectionId).classList.remove('hidden');
        }
    }

    async sendRequest() {
        const method = document.getElementById('httpMethod').value;
        const url = document.getElementById('apiUrl').value;
        
        if (!url) {
            alert('Please enter a URL');
            return;
        }
        
        try {
            this.showLoading();
            
            const options = {
                method,
                url,
                headers: this.getHeaders(),
                body: this.getBody(),
                auth: this.getAuth()
            };
            
            const response = await this.makeRequest(options);
            this.displayResponse(response);
            
        } catch (error) {
            this.displayError(error.message);
        }
    }

    async makeRequest(options) {
        const { method, url, headers, body, auth } = options;
        const startTime = Date.now();
        
        // Build request configuration
        const config = {
            method,
            headers: this.buildHeaders(headers, auth),
            mode: 'cors'
        };
        
        // Add body for non-GET requests
        if (method !== 'GET' && body) {
            config.body = this.formatBody(body, headers['Content-Type']);
        }
        
        // Add query parameters
        const params = this.getParams();
        const finalUrl = this.buildUrl(url, params);
        
        try {
            const response = await fetch(finalUrl, config);
            const endTime = Date.now();
            
            const responseText = await response.text();
            
            return {
                status: response.status,
                statusText: response.statusText,
                headers: Object.fromEntries(response.headers.entries()),
                body: responseText,
                time: endTime - startTime,
                size: new Blob([responseText]).size,
                ok: response.ok
            };
            
        } catch (error) {
            throw new Error(`Network error: ${error.message}`);
        }
    }

    getHeaders() {
        const headers = {};
        const container = document.getElementById('headersContainer');
        const rows = container.querySelectorAll('div');
        
        rows.forEach(row => {
            const inputs = row.querySelectorAll('input');
            if (inputs.length === 2 && inputs[0].value && inputs[1].value) {
                headers[inputs[0].value] = inputs[1].value;
            }
        });
        
        // Add content type from body tab
        const contentType = document.getElementById('contentType').value;
        if (contentType && document.getElementById('requestBody').value) {
            headers['Content-Type'] = contentType;
        }
        
        return headers;
    }

    getBody() {
        const method = document.getElementById('httpMethod').value;
        if (method === 'GET' || method === 'HEAD') {
            return null;
        }
        
        return document.getElementById('requestBody').value;
    }

    getAuth() {
        const authType = document.getElementById('authType').value;
        
        if (authType === 'basic') {
            return {
                type: 'basic',
                username: document.getElementById('basicUsername').value,
                password: document.getElementById('basicPassword').value
            };
        } else if (authType === 'bearer') {
            return {
                type: 'bearer',
                token: document.getElementById('bearerToken').value
            };
        } else if (authType === 'api-key') {
            return {
                type: 'api-key',
                key: document.getElementById('apiKeyName').value,
                value: document.getElementById('apiKeyValue').value
            };
        }
        
        return { type: 'none' };
    }

    getParams() {
        const params = {};
        const container = document.getElementById('paramsContainer');
        const rows = container.querySelectorAll('div');
        
        rows.forEach(row => {
            const inputs = row.querySelectorAll('input');
            if (inputs.length === 2 && inputs[0].value && inputs[1].value) {
                params[inputs[0].value] = inputs[1].value;
            }
        });
        
        return params;
    }

    buildUrl(url, params) {
        const urlObj = new URL(url);
        Object.entries(params).forEach(([key, value]) => {
            urlObj.searchParams.append(key, value);
        });
        return urlObj.toString();
    }

    buildHeaders(customHeaders, auth) {
        let headers = { ...customHeaders };
        
        // Add authentication headers
        if (auth.type === 'basic') {
            const credentials = btoa(`${auth.username}:${auth.password}`);
            headers['Authorization'] = `Basic ${credentials}`;
        } else if (auth.type === 'bearer') {
            headers['Authorization'] = `Bearer ${auth.token}`;
        } else if (auth.type === 'api-key') {
            headers[auth.key] = auth.value;
        }
        
        return headers;
    }

    formatBody(body, contentType) {
        if (!body) return null;
        
        if (contentType === 'application/json') {
            try {
                return JSON.stringify(JSON.parse(body));
            } catch (e) {
                return body;
            }
        }
        
        return body;
    }

    showLoading() {
        document.getElementById('emptyState').classList.add('hidden');
        document.getElementById('responseBody').classList.add('hidden');
        document.getElementById('responseInfo').classList.add('hidden');
        document.getElementById('loadingState').classList.remove('hidden');
    }

    displayResponse(response) {
        document.getElementById('loadingState').classList.add('hidden');
        document.getElementById('emptyState').classList.add('hidden');
        
        // Update response info
        document.getElementById('responseInfo').classList.remove('hidden');
        
        const statusElement = document.getElementById('responseStatus');
        statusElement.textContent = `${response.status} ${response.statusText}`;
        statusElement.className = `px-2 py-1 rounded text-xs font-medium ${
            response.ok ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
        }`;
        
        document.getElementById('responseTime').textContent = `${response.time}ms`;
        document.getElementById('responseSize').textContent = `${response.size} bytes`;
        
        // Format and display response body
        let formattedBody = response.body;
        try {
            const parsed = JSON.parse(response.body);
            formattedBody = JSON.stringify(parsed, null, 2);
        } catch (e) {
            // Not JSON, use as is
        }
        
        document.getElementById('responseText').textContent = formattedBody;
        document.getElementById('responseBody').classList.remove('hidden');
        
        // Display headers
        const headersText = Object.entries(response.headers)
            .map(([key, value]) => `${key}: ${value}`)
            .join('\n');
        document.getElementById('responseHeadersText').textContent = headersText;
        
        // Display cookies (mock for demo)
        document.getElementById('cookiesText').textContent = 'No cookies found';
    }

    displayError(message) {
        document.getElementById('loadingState').classList.add('hidden');
        document.getElementById('emptyState').classList.add('hidden');
        
        document.getElementById('responseText').textContent = `Error: ${message}`;
        document.getElementById('responseBody').classList.remove('hidden');
        
        const statusElement = document.getElementById('responseStatus');
        statusElement.textContent = 'Error';
        statusElement.className = 'px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800';
        
        document.getElementById('responseInfo').classList.remove('hidden');
    }
}

// Initialize API Tester
const apiTester = new APITester();

// Global functions
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById(tabName + 'Content').classList.remove('hidden');
    
    // Add active class to selected tab
    const activeTab = document.getElementById(tabName + 'Tab');
    activeTab.classList.add('active', 'border-blue-500', 'text-blue-600');
    activeTab.classList.remove('border-transparent', 'text-gray-500');
}

function switchResponseTab(tabName) {
    // Hide all response tab contents
    document.querySelectorAll('.response-tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all response tabs
    document.querySelectorAll('.response-tab-button').forEach(button => {
        button.classList.remove('active', 'border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected response tab content
    document.getElementById(tabName + 'Content').classList.remove('hidden');
    
    // Add active class to selected response tab
    const activeTab = document.getElementById(tabName + 'Tab');
    activeTab.classList.add('active', 'border-blue-500', 'text-blue-600');
    activeTab.classList.remove('border-transparent', 'text-gray-500');
}

function addHeader() {
    const container = document.getElementById('headersContainer');
    const newRow = document.createElement('div');
    newRow.className = 'flex space-x-2';
    newRow.innerHTML = `
        <input type="text" placeholder="Header name" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
        <input type="text" placeholder="Header value" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
        <button onclick="removeHeader(this)" class="text-red-500 hover:text-red-700 px-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    container.appendChild(newRow);
}

function removeHeader(button) {
    button.parentElement.remove();
}

function addParam() {
    const container = document.getElementById('paramsContainer');
    const newRow = document.createElement('div');
    newRow.className = 'flex space-x-2';
    newRow.innerHTML = `
        <input type="text" placeholder="Parameter name" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
        <input type="text" placeholder="Parameter value" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
        <button onclick="removeParam(this)" class="text-red-500 hover:text-red-700 px-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    container.appendChild(newRow);
}

function removeParam(button) {
    button.parentElement.remove();
}

function formatJSON() {
    const textarea = document.getElementById('requestBody');
    try {
        const parsed = JSON.parse(textarea.value);
        textarea.value = JSON.stringify(parsed, null, 2);
    } catch (e) {
        alert('Invalid JSON format');
    }
}

function validateJSON() {
    const textarea = document.getElementById('requestBody');
    try {
        JSON.parse(textarea.value);
        alert('Valid JSON');
    } catch (e) {
        alert('Invalid JSON: ' + e.message);
    }
}

function loadExample(type) {
    const examples = {
        jsonplaceholder: {
            url: 'https://jsonplaceholder.typicode.com/posts/1',
            method: 'GET'
        },
        httpbin: {
            url: 'https://httpbin.org/get',
            method: 'GET'
        },
        github: {
            url: 'https://api.github.com/users/octocat',
            method: 'GET'
        },
        weather: {
            url: 'https://api.openweathermap.org/data/2.5/weather',
            method: 'GET',
            params: { q: 'London', appid: 'YOUR_API_KEY' }
        }
    };
    
    const example = examples[type];
    if (example) {
        document.getElementById('apiUrl').value = example.url;
        document.getElementById('httpMethod').value = example.method;
        
        if (example.params) {
            const container = document.getElementById('paramsContainer');
            container.innerHTML = '';
            
            Object.entries(example.params).forEach(([key, value]) => {
                const newRow = document.createElement('div');
                newRow.className = 'flex space-x-2';
                newRow.innerHTML = `
                    <input type="text" placeholder="Parameter name" value="${key}" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                    <input type="text" placeholder="Parameter value" value="${value}" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                    <button onclick="removeParam(this)" class="text-red-500 hover:text-red-700 px-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });
        }
    }
}

function sendRequest() {
    apiTester.sendRequest();
}

function copyResponse() {
    const responseText = document.getElementById('responseText').textContent;
    navigator.clipboard.writeText(responseText).then(() => {
        alert('Response copied to clipboard!');
    });
}
</script>
@endsection
