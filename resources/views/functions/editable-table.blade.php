@extends('layouts.app')

@section('title', 'Editable Table')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Editable Table</h1>

        <div class="mb-4 flex justify-between items-center">
            <div class="text-sm text-gray-600">
                Click on any cell to edit. Press Enter to save or Escape to cancel.
            </div>
            <button id="addRowBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Add New Row
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="border border-gray-200 px-4 py-3 text-left">#</th>
                        <th class="border border-gray-200 px-4 py-3 text-left">Product</th>
                        <th class="border border-gray-200 px-4 py-3 text-left">Price ($)</th>
                        <th class="border border-gray-200 px-4 py-3 text-left">Quantity</th>
                        <th class="border border-gray-200 px-4 py-3 text-left">Category</th>
                        <th class="border border-gray-200 px-4 py-3 text-left">Total</th>
                        <th class="border border-gray-200 px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="editableTableBody">
                    <!-- Data will be populated by JavaScript -->
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div class="text-sm text-gray-600">
                Total Items: <span id="totalItems">0</span> |
                Total Value: $<span id="totalValue">0.00</span>
            </div>
            <div class="flex gap-2">
                <button id="saveAllBtn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Save All Changes
                </button>
                <button id="resetBtn" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    Reset Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Editable Table Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
class EditableTable {
    constructor(data) {
        this.data = [...data];
        this.originalData = [...data];
        this.editingCell = null;
        this.nextId = Math.max(...data.map(item => item.id)) + 1;
        this.init();
    }

    init() {
        this.renderTable();
        this.bindEvents();
        this.updateTotals();
    }

    renderTable() {
        const tbody = document.getElementById('editableTableBody');
        tbody.innerHTML = '';

        this.data.forEach((item, index) => {
            const row = this.createRow(item, index);
            tbody.appendChild(row);
        });
    }

    createRow(item, index) {
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50';
        row.innerHTML = `
            <td class="border border-gray-200 px-4 py-3">${item.id}</td>
            <td class="border border-gray-200 px-4 py-3 editable" data-field="product" data-index="${index}">${item.product}</td>
            <td class="border border-gray-200 px-4 py-3 editable" data-field="price" data-index="${index}">$${item.price}</td>
            <td class="border border-gray-200 px-4 py-3 editable" data-field="quantity" data-index="${index}">${item.quantity}</td>
            <td class="border border-gray-200 px-4 py-3 editable" data-field="category" data-index="${index}">${item.category}</td>
            <td class="border border-gray-200 px-4 py-3 total-cell">$${(item.price * item.quantity).toFixed(2)}</td>
            <td class="border border-gray-200 px-4 py-3">
                <button onclick="deleteRow(${index})" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
            </td>
        `;
        return row;
    }

    makeEditable(cell) {
        const field = cell.dataset.field;
        const index = parseInt(cell.dataset.index);
        const currentValue = this.data[index][field];

        if (field === 'category') {
            // Create dropdown for category
            const select = document.createElement('select');
            select.className = 'w-full px-2 py-1 border border-gray-300 rounded';
            const categories = ['Electronics', 'Education', 'Office', 'Furniture', 'Sports'];

            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category;
                option.textContent = category;
                option.selected = category === currentValue;
                select.appendChild(option);
            });

            cell.innerHTML = '';
            cell.appendChild(select);
            select.focus();

            this.editingCell = { cell, field, index, element: select };
        } else {
            // Create input for other fields
            const input = document.createElement('input');
            input.type = field === 'price' || field === 'quantity' ? 'number' : 'text';
            input.className = 'w-full px-2 py-1 border border-gray-300 rounded';
            input.value = field === 'price' ? currentValue : currentValue;

            cell.innerHTML = '';
            cell.appendChild(input);
            input.focus();
            input.select();

            this.editingCell = { cell, field, index, element: input };
        }
    }

    saveEdit() {
        if (!this.editingCell) return;

        const { cell, field, index, element } = this.editingCell;
        let newValue = element.value;

        if (field === 'price' || field === 'quantity') {
            newValue = parseFloat(newValue) || 0;
        }

        this.data[index][field] = newValue;
        this.editingCell = null;

        // Re-render the specific row
        const row = cell.closest('tr');
        const newRow = this.createRow(this.data[index], index);
        row.replaceWith(newRow);

        this.updateTotals();
        this.bindRowEvents(newRow);
    }

    cancelEdit() {
        if (!this.editingCell) return;

        const { cell, field, index } = this.editingCell;
        const originalValue = this.data[index][field];

        if (field === 'price') {
            cell.textContent = `$${originalValue}`;
        } else {
            cell.textContent = originalValue;
        }

        this.editingCell = null;
    }

    updateTotals() {
        const totalItems = this.data.reduce((sum, item) => sum + item.quantity, 0);
        const totalValue = this.data.reduce((sum, item) => sum + (item.price * item.quantity), 0);

        document.getElementById('totalItems').textContent = totalItems;
        document.getElementById('totalValue').textContent = totalValue.toFixed(2);
    }
}

const editableTable = new EditableTable(data);
        </code></pre>
    </div>
</div>

<script>
class EditableTable {
    constructor(data) {
        this.data = [...data];
        this.originalData = [...data];
        this.editingCell = null;
        this.nextId = Math.max(...data.map(item => item.id)) + 1;
        this.init();
    }

    init() {
        this.renderTable();
        this.bindEvents();
        this.updateTotals();
    }

    renderTable() {
        const tbody = document.getElementById('editableTableBody');
        tbody.innerHTML = '';

        this.data.forEach((item, index) => {
            const row = this.createRow(item, index);
            tbody.appendChild(row);
        });

        // Bind events to editable cells
        this.bindTableEvents();
    }

    createRow(item, index) {
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50';
        row.innerHTML = `
            <td class="border border-gray-200 px-4 py-3">${item.id}</td>
            <td class="border border-gray-200 px-4 py-3 editable cursor-pointer hover:bg-blue-50" data-field="product" data-index="${index}">${item.product}</td>
            <td class="border border-gray-200 px-4 py-3 editable cursor-pointer hover:bg-blue-50" data-field="price" data-index="${index}">$${item.price}</td>
            <td class="border border-gray-200 px-4 py-3 editable cursor-pointer hover:bg-blue-50" data-field="quantity" data-index="${index}">${item.quantity}</td>
            <td class="border border-gray-200 px-4 py-3 editable cursor-pointer hover:bg-blue-50" data-field="category" data-index="${index}">${item.category}</td>
            <td class="border border-gray-200 px-4 py-3 total-cell font-medium">$${(item.price * item.quantity).toFixed(2)}</td>
            <td class="border border-gray-200 px-4 py-3">
                <button onclick="deleteRow(${index})" class="text-red-600 hover:text-red-800 text-sm px-2 py-1 rounded hover:bg-red-50">Delete</button>
            </td>
        `;
        return row;
    }

    bindTableEvents() {
        document.querySelectorAll('.editable').forEach(cell => {
            cell.addEventListener('click', (e) => {
                if (this.editingCell) {
                    this.saveEdit();
                }
                this.makeEditable(cell);
            });
        });
    }

    bindEvents() {
        document.getElementById('addRowBtn').addEventListener('click', () => {
            this.addRow();
        });

        document.getElementById('saveAllBtn').addEventListener('click', () => {
            this.saveAllChanges();
        });

        document.getElementById('resetBtn').addEventListener('click', () => {
            this.resetChanges();
        });

        // Global keyboard events
        document.addEventListener('keydown', (e) => {
            if (this.editingCell) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.saveEdit();
                } else if (e.key === 'Escape') {
                    e.preventDefault();
                    this.cancelEdit();
                }
            }
        });
    }

    makeEditable(cell) {
        const field = cell.dataset.field;
        const index = parseInt(cell.dataset.index);
        const currentValue = this.data[index][field];

        if (field === 'category') {
            // Create dropdown for category
            const select = document.createElement('select');
            select.className = 'w-full px-2 py-1 border border-gray-300 rounded';
            const categories = ['Electronics', 'Education', 'Office', 'Furniture', 'Sports'];

            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category;
                option.textContent = category;
                option.selected = category === currentValue;
                select.appendChild(option);
            });

            cell.innerHTML = '';
            cell.appendChild(select);
            select.focus();

            this.editingCell = { cell, field, index, element: select };

            select.addEventListener('change', () => {
                this.saveEdit();
            });
        } else {
            // Create input for other fields
            const input = document.createElement('input');
            input.type = field === 'price' || field === 'quantity' ? 'number' : 'text';
            input.className = 'w-full px-2 py-1 border border-gray-300 rounded';
            input.value = field === 'price' ? currentValue : currentValue;

            if (field === 'price') {
                input.step = '0.01';
                input.min = '0';
            }

            if (field === 'quantity') {
                input.min = '0';
            }

            cell.innerHTML = '';
            cell.appendChild(input);
            input.focus();
            input.select();

            this.editingCell = { cell, field, index, element: input };
        }
    }

    saveEdit() {
        if (!this.editingCell) return;

        const { cell, field, index, element } = this.editingCell;
        let newValue = element.value;

        if (field === 'price' || field === 'quantity') {
            newValue = parseFloat(newValue) || 0;
        }

        this.data[index][field] = newValue;
        this.editingCell = null;

        // Re-render the table to update totals
        this.renderTable();
        this.updateTotals();

        showSuccess('Cell updated successfully!');
    }

    cancelEdit() {
        if (!this.editingCell) return;

        const { cell, field, index } = this.editingCell;
        const originalValue = this.data[index][field];

        if (field === 'price') {
            cell.textContent = `$${originalValue}`;
        } else {
            cell.textContent = originalValue;
        }

        this.editingCell = null;
    }

    addRow() {
        const newRow = {
            id: this.nextId++,
            product: 'New Product',
            price: 0,
            quantity: 1,
            category: 'Electronics'
        };

        this.data.push(newRow);
        this.renderTable();
        this.updateTotals();
        showSuccess('New row added successfully!');
    }

    deleteRow(index) {
        if (confirm('Are you sure you want to delete this row?')) {
            this.data.splice(index, 1);
            this.renderTable();
            this.updateTotals();
            showSuccess('Row deleted successfully!');
        }
    }

    updateTotals() {
        const totalItems = this.data.reduce((sum, item) => sum + item.quantity, 0);
        const totalValue = this.data.reduce((sum, item) => sum + (item.price * item.quantity), 0);

        document.getElementById('totalItems').textContent = totalItems;
        document.getElementById('totalValue').textContent = totalValue.toFixed(2);
    }

    saveAllChanges() {
        // In a real application, this would send data to server
        console.log('Saving all changes:', this.data);
        showSuccess('All changes saved successfully!');
    }

    resetChanges() {
        if (confirm('Are you sure you want to reset all changes?')) {
            this.data = [...this.originalData];
            this.renderTable();
            this.updateTotals();
            showInfo('All changes have been reset');
        }
    }
}

// Global functions
function deleteRow(index) {
    editableTable.deleteRow(index);
}

// Initialize table
let editableTable;
document.addEventListener('DOMContentLoaded', function() {
    const data = @json($editableData);
    editableTable = new EditableTable(data);

    setTimeout(() => {
        showInfo('Editable table loaded! Click on any cell to edit.');
    }, 1000);
});
</script>
@endsection
