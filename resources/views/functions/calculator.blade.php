@extends('layouts.app')

@section('title', 'Calculator')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Advanced Calculator</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Calculator -->
            <div class="bg-gray-900 rounded-lg p-6">
                <div class="bg-black rounded-lg p-4 mb-4">
                    <div class="text-right">
                        <div id="expression" class="text-gray-400 text-sm h-6 mb-2"></div>
                        <div id="display" class="text-white text-3xl font-mono break-all">0</div>
                    </div>
                </div>
                
                <div class="grid grid-cols-4 gap-3">
                    <!-- Row 1 -->
                    <button onclick="clearAll()" class="calculator-btn bg-red-600 hover:bg-red-700 text-white col-span-2">C</button>
                    <button onclick="deleteLast()" class="calculator-btn bg-orange-600 hover:bg-orange-700 text-white">⌫</button>
                    <button onclick="appendOperator('/')" class="calculator-btn bg-orange-600 hover:bg-orange-700 text-white">÷</button>
                    
                    <!-- Row 2 -->
                    <button onclick="appendNumber('7')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">7</button>
                    <button onclick="appendNumber('8')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">8</button>
                    <button onclick="appendNumber('9')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">9</button>
                    <button onclick="appendOperator('*')" class="calculator-btn bg-orange-600 hover:bg-orange-700 text-white">×</button>
                    
                    <!-- Row 3 -->
                    <button onclick="appendNumber('4')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">4</button>
                    <button onclick="appendNumber('5')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">5</button>
                    <button onclick="appendNumber('6')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">6</button>
                    <button onclick="appendOperator('-')" class="calculator-btn bg-orange-600 hover:bg-orange-700 text-white">−</button>
                    
                    <!-- Row 4 -->
                    <button onclick="appendNumber('1')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">1</button>
                    <button onclick="appendNumber('2')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">2</button>
                    <button onclick="appendNumber('3')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">3</button>
                    <button onclick="appendOperator('+')" class="calculator-btn bg-orange-600 hover:bg-orange-700 text-white row-span-2">+</button>
                    
                    <!-- Row 5 -->
                    <button onclick="appendNumber('0')" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white col-span-2">0</button>
                    <button onclick="appendDecimal()" class="calculator-btn bg-gray-600 hover:bg-gray-700 text-white">.</button>
                    
                    <!-- Row 6 -->
                    <button onclick="calculate()" class="calculator-btn bg-green-600 hover:bg-green-700 text-white col-span-4">=</button>
                </div>
                
                <!-- Scientific Functions -->
                <div class="mt-4 grid grid-cols-4 gap-2">
                    <button onclick="scientificFunction('sin')" class="calculator-btn bg-blue-600 hover:bg-blue-700 text-white text-sm">sin</button>
                    <button onclick="scientificFunction('cos')" class="calculator-btn bg-blue-600 hover:bg-blue-700 text-white text-sm">cos</button>
                    <button onclick="scientificFunction('tan')" class="calculator-btn bg-blue-600 hover:bg-blue-700 text-white text-sm">tan</button>
                    <button onclick="scientificFunction('sqrt')" class="calculator-btn bg-blue-600 hover:bg-blue-700 text-white text-sm">√</button>
                    <button onclick="appendOperator('^')" class="calculator-btn bg-blue-600 hover:bg-blue-700 text-white text-sm">x²</button>
                    <button onclick="appendOperator('(')" class="calculator-btn bg-blue-600 hover:bg-blue-700 text-white text-sm">(</button>
                    <button onclick="appendOperator(')')" class="calculator-btn bg-blue-600 hover:bg-blue-700 text-white text-sm">)</button>
                    <button onclick="appendNumber('3.14159')" class="calculator-btn bg-blue-600 hover:bg-blue-700 text-white text-sm">π</button>
                </div>
            </div>
            
            <!-- History and Memory -->
            <div class="space-y-6">
                <!-- History -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">History</h3>
                    <div id="history" class="space-y-2 max-h-64 overflow-y-auto">
                        <div class="text-gray-500 text-sm">No calculations yet</div>
                    </div>
                    <button onclick="clearHistory()" class="mt-3 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                        Clear History
                    </button>
                </div>
                
                <!-- Memory -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Memory</h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Stored Value:</span>
                            <span id="memoryDisplay" class="text-sm text-gray-600">0</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            <button onclick="memoryStore()" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">MS</button>
                            <button onclick="memoryRecall()" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">MR</button>
                            <button onclick="memoryAdd()" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">M+</button>
                            <button onclick="memoryClear()" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">MC</button>
                        </div>
                    </div>
                </div>
                
                <!-- Unit Converter -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Unit Converter</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Convert</label>
                            <select id="conversionType" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="length">Length</option>
                                <option value="weight">Weight</option>
                                <option value="temperature">Temperature</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <input type="number" id="convertFrom" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="From">
                                <select id="unitFrom" class="w-full border border-gray-300 rounded px-3 py-2 text-sm mt-1">
                                    <option value="m">Meters</option>
                                    <option value="cm">Centimeters</option>
                                    <option value="ft">Feet</option>
                                    <option value="in">Inches</option>
                                </select>
                            </div>
                            <div>
                                <input type="number" id="convertTo" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="To" readonly>
                                <select id="unitTo" class="w-full border border-gray-300 rounded px-3 py-2 text-sm mt-1">
                                    <option value="m">Meters</option>
                                    <option value="cm">Centimeters</option>
                                    <option value="ft">Feet</option>
                                    <option value="in">Inches</option>
                                </select>
                            </div>
                        </div>
                        <button onclick="convert()" class="w-full bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded text-sm">
                            Convert
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Calculator Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
class Calculator {
    constructor() {
        this.currentInput = '0';
        this.expression = '';
        this.memory = 0;
        this.history = [];
        this.init();
    }

    init() {
        this.updateDisplay();
        this.bindKeyboardEvents();
    }

    appendNumber(number) {
        if (this.currentInput === '0' || this.currentInput === 'Error') {
            this.currentInput = number;
        } else {
            this.currentInput += number;
        }
        this.updateDisplay();
    }

    appendOperator(operator) {
        if (this.currentInput !== '' && this.currentInput !== 'Error') {
            this.expression += this.currentInput + ' ' + operator + ' ';
            this.currentInput = '';
            this.updateDisplay();
        }
    }

    calculate() {
        try {
            const fullExpression = this.expression + this.currentInput;
            const result = this.evaluateExpression(fullExpression);
            
            this.addToHistory(fullExpression, result);
            this.currentInput = result.toString();
            this.expression = '';
            this.updateDisplay();
            
        } catch (error) {
            this.currentInput = 'Error';
            this.updateDisplay();
        }
    }

    evaluateExpression(expr) {
        // Safe evaluation of mathematical expressions
        const sanitized = expr.replace(/[^0-9+\-*/.() ]/g, '');
        return Function('"use strict"; return (' + sanitized + ')')();
    }

    scientificFunction(func) {
        const value = parseFloat(this.currentInput);
        let result;
        
        switch (func) {
            case 'sin':
                result = Math.sin(value * Math.PI / 180);
                break;
            case 'cos':
                result = Math.cos(value * Math.PI / 180);
                break;
            case 'tan':
                result = Math.tan(value * Math.PI / 180);
                break;
            case 'sqrt':
                result = Math.sqrt(value);
                break;
            default:
                return;
        }
        
        this.currentInput = result.toString();
        this.updateDisplay();
    }

    updateDisplay() {
        document.getElementById('display').textContent = this.currentInput;
        document.getElementById('expression').textContent = this.expression;
    }
}

const calculator = new Calculator();
        </code></pre>
    </div>
</div>

<style>
.calculator-btn {
    padding: 1rem;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    font-size: 1.1rem;
}

.calculator-btn:active {
    transform: scale(0.95);
}

.calculator-btn.row-span-2 {
    grid-row: span 2;
}

.calculator-btn.col-span-2 {
    grid-column: span 2;
}

.calculator-btn.col-span-4 {
    grid-column: span 4;
}
</style>

<script>
class Calculator {
    constructor() {
        this.currentInput = '0';
        this.expression = '';
        this.memory = 0;
        this.history = [];
        this.init();
    }

    init() {
        this.updateDisplay();
        this.bindKeyboardEvents();
        this.setupUnitConverter();
    }

    bindKeyboardEvents() {
        document.addEventListener('keydown', (e) => {
            if (e.key >= '0' && e.key <= '9') {
                this.appendNumber(e.key);
            } else if (e.key === '.') {
                this.appendDecimal();
            } else if (e.key === '+' || e.key === '-' || e.key === '*' || e.key === '/') {
                this.appendOperator(e.key);
            } else if (e.key === 'Enter' || e.key === '=') {
                e.preventDefault();
                this.calculate();
            } else if (e.key === 'Escape') {
                this.clearAll();
            } else if (e.key === 'Backspace') {
                this.deleteLast();
            }
        });
    }

    appendNumber(number) {
        if (this.currentInput === '0' || this.currentInput === 'Error') {
            this.currentInput = number;
        } else {
            this.currentInput += number;
        }
        this.updateDisplay();
    }

    appendOperator(operator) {
        if (this.currentInput !== '' && this.currentInput !== 'Error') {
            this.expression += this.currentInput + ' ' + operator + ' ';
            this.currentInput = '';
            this.updateDisplay();
        }
    }

    appendDecimal() {
        if (this.currentInput.indexOf('.') === -1) {
            this.currentInput += '.';
            this.updateDisplay();
        }
    }

    clearAll() {
        this.currentInput = '0';
        this.expression = '';
        this.updateDisplay();
        showInfo('Calculator cleared');
    }

    deleteLast() {
        if (this.currentInput.length > 1) {
            this.currentInput = this.currentInput.slice(0, -1);
        } else {
            this.currentInput = '0';
        }
        this.updateDisplay();
    }

    calculate() {
        try {
            const fullExpression = this.expression + this.currentInput;
            if (fullExpression.trim() === '') return;
            
            const result = this.evaluateExpression(fullExpression);
            
            this.addToHistory(fullExpression, result);
            this.currentInput = result.toString();
            this.expression = '';
            this.updateDisplay();
            showSuccess('Calculation completed');
            
        } catch (error) {
            this.currentInput = 'Error';
            this.updateDisplay();
            showError('Invalid expression');
        }
    }

    evaluateExpression(expr) {
        // Replace operators for display
        let sanitized = expr.replace(/×/g, '*').replace(/÷/g, '/').replace(/−/g, '-');
        
        // Handle scientific functions and constants
        sanitized = sanitized.replace(/\^/g, '**');
        
        // Safe evaluation using Function constructor
        return Function('"use strict"; return (' + sanitized + ')')();
    }

    scientificFunction(func) {
        const value = parseFloat(this.currentInput);
        if (isNaN(value)) {
            showError('Invalid number for scientific function');
            return;
        }
        
        let result;
        
        switch (func) {
            case 'sin':
                result = Math.sin(value * Math.PI / 180);
                break;
            case 'cos':
                result = Math.cos(value * Math.PI / 180);
                break;
            case 'tan':
                result = Math.tan(value * Math.PI / 180);
                break;
            case 'sqrt':
                result = Math.sqrt(value);
                break;
            default:
                return;
        }
        
        this.currentInput = result.toString();
        this.updateDisplay();
        showInfo(`${func.toUpperCase()} function applied`);
    }

    updateDisplay() {
        document.getElementById('display').textContent = this.currentInput;
        document.getElementById('expression').textContent = this.expression;
        document.getElementById('memoryDisplay').textContent = this.memory;
    }

    addToHistory(expression, result) {
        this.history.unshift({ expression, result });
        this.updateHistoryDisplay();
    }

    updateHistoryDisplay() {
        const historyElement = document.getElementById('history');
        
        if (this.history.length === 0) {
            historyElement.innerHTML = '<div class="text-gray-500 text-sm">No calculations yet</div>';
            return;
        }
        
        historyElement.innerHTML = this.history.slice(0, 10).map(item => `
            <div class="bg-white p-2 rounded text-sm">
                <div class="text-gray-600">${item.expression}</div>
                <div class="font-semibold text-blue-600">= ${item.result}</div>
            </div>
        `).join('');
    }

    clearHistory() {
        this.history = [];
        this.updateHistoryDisplay();
        showInfo('History cleared');
    }

    // Memory functions
    memoryStore() {
        this.memory = parseFloat(this.currentInput) || 0;
        this.updateDisplay();
        showSuccess('Value stored in memory');
    }

    memoryRecall() {
        this.currentInput = this.memory.toString();
        this.updateDisplay();
        showInfo('Memory recalled');
    }

    memoryAdd() {
        this.memory += parseFloat(this.currentInput) || 0;
        this.updateDisplay();
        showSuccess('Value added to memory');
    }

    memoryClear() {
        this.memory = 0;
        this.updateDisplay();
        showInfo('Memory cleared');
    }

    // Unit converter setup
    setupUnitConverter() {
        const conversionType = document.getElementById('conversionType');
        const unitFrom = document.getElementById('unitFrom');
        const unitTo = document.getElementById('unitTo');
        
        const units = {
            length: [
                { value: 'm', label: 'Meters' },
                { value: 'cm', label: 'Centimeters' },
                { value: 'ft', label: 'Feet' },
                { value: 'in', label: 'Inches' }
            ],
            weight: [
                { value: 'kg', label: 'Kilograms' },
                { value: 'g', label: 'Grams' },
                { value: 'lb', label: 'Pounds' },
                { value: 'oz', label: 'Ounces' }
            ],
            temperature: [
                { value: 'c', label: 'Celsius' },
                { value: 'f', label: 'Fahrenheit' },
                { value: 'k', label: 'Kelvin' }
            ]
        };
        
        conversionType.addEventListener('change', (e) => {
            const selectedUnits = units[e.target.value];
            unitFrom.innerHTML = '';
            unitTo.innerHTML = '';
            
            selectedUnits.forEach(unit => {
                unitFrom.innerHTML += `<option value="${unit.value}">${unit.label}</option>`;
                unitTo.innerHTML += `<option value="${unit.value}">${unit.label}</option>`;
            });
        });
        
        document.getElementById('convertFrom').addEventListener('input', () => {
            this.convert();
        });
        
        unitFrom.addEventListener('change', () => {
            this.convert();
        });
        
        unitTo.addEventListener('change', () => {
            this.convert();
        });
    }

    convert() {
        const value = parseFloat(document.getElementById('convertFrom').value);
        const fromUnit = document.getElementById('unitFrom').value;
        const toUnit = document.getElementById('unitTo').value;
        const conversionType = document.getElementById('conversionType').value;
        
        if (isNaN(value)) {
            document.getElementById('convertTo').value = '';
            return;
        }
        
        let result;
        
        if (conversionType === 'length') {
            result = this.convertLength(value, fromUnit, toUnit);
        } else if (conversionType === 'weight') {
            result = this.convertWeight(value, fromUnit, toUnit);
        } else if (conversionType === 'temperature') {
            result = this.convertTemperature(value, fromUnit, toUnit);
        }
        
        document.getElementById('convertTo').value = result.toFixed(4);
    }

    convertLength(value, from, to) {
        const toMeters = { m: 1, cm: 0.01, ft: 0.3048, in: 0.0254 };
        const fromMeters = { m: 1, cm: 100, ft: 3.28084, in: 39.3701 };
        
        return value * toMeters[from] * fromMeters[to];
    }

    convertWeight(value, from, to) {
        const toKg = { kg: 1, g: 0.001, lb: 0.453592, oz: 0.0283495 };
        const fromKg = { kg: 1, g: 1000, lb: 2.20462, oz: 35.274 };
        
        return value * toKg[from] * fromKg[to];
    }

    convertTemperature(value, from, to) {
        let celsius;
        
        if (from === 'c') celsius = value;
        else if (from === 'f') celsius = (value - 32) * 5/9;
        else if (from === 'k') celsius = value - 273.15;
        
        if (to === 'c') return celsius;
        else if (to === 'f') return celsius * 9/5 + 32;
        else if (to === 'k') return celsius + 273.15;
    }
}

// Global functions for button clicks
let calculator;

function appendNumber(number) {
    calculator.appendNumber(number);
}

function appendOperator(operator) {
    calculator.appendOperator(operator);
}

function appendDecimal() {
    calculator.appendDecimal();
}

function clearAll() {
    calculator.clearAll();
}

function deleteLast() {
    calculator.deleteLast();
}

function calculate() {
    calculator.calculate();
}

function scientificFunction(func) {
    calculator.scientificFunction(func);
}

function clearHistory() {
    calculator.clearHistory();
}

function memoryStore() {
    calculator.memoryStore();
}

function memoryRecall() {
    calculator.memoryRecall();
}

function memoryAdd() {
    calculator.memoryAdd();
}

function memoryClear() {
    calculator.memoryClear();
}

function convert() {
    calculator.convert();
}

// Initialize calculator
document.addEventListener('DOMContentLoaded', function() {
    calculator = new Calculator();
    
    setTimeout(() => {
        showInfo('Calculator ready! You can use keyboard shortcuts.');
    }, 1000);
});
</script>
@endsection
