@extends('layouts.app')

@section('title', 'Export Data')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Export Data</h1>

        <!-- Export Controls -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Export Options</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <button onclick="exportToCSV()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"></path>
                    </svg>
                    Export to CSV
                </button>

                <button onclick="exportToExcel()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"></path>
                    </svg>
                    Export to Excel
                </button>

                <button onclick="exportToPDF()" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"></path>
                    </svg>
                    Export to PDF
                </button>
            </div>

            <!-- Export Settings -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Include Headers</label>
                    <label class="flex items-center">
                        <input type="checkbox" id="includeHeaders" checked class="mr-2">
                        <span class="text-sm">Include column headers in export</span>
                    </label>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Date Format</label>
                    <select id="dateFormat" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500">
                        <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                        <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                        <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Sample Data Table -->
        <div class="overflow-x-auto">
            <table id="dataTable" class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Join Date</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Data will be generated here -->
                </tbody>
            </table>
        </div>

        <!-- Export Progress -->
        <div id="exportProgress" class="mt-6 hidden">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500 mr-3"></div>
                    <span class="text-blue-700">Preparing export...</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">JavaScript Code:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// Export Data Functions

// CSV Export
function exportToCSV() {
    const data = getSelectedData();
    const csv = convertToCSV(data);
    downloadFile(csv, 'data.csv', 'text/csv');
}

// Excel Export (requires SheetJS library)
function exportToExcel() {
    const data = getSelectedData();
    const ws = XLSX.utils.json_to_sheet(data);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Data");
    XLSX.writeFile(wb, "data.xlsx");
}

// PDF Export (requires jsPDF library)
function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const data = getSelectedData();
    const headers = Object.keys(data[0]);
    const rows = data.map(item => headers.map(header => item[header]));

    doc.autoTable({
        head: [headers],
        body: rows,
        startY: 20,
        theme: 'striped'
    });

    doc.save('data.pdf');
}

function convertToCSV(data) {
    const headers = Object.keys(data[0]);
    const csvContent = [];

    if (document.getElementById('includeHeaders').checked) {
        csvContent.push(headers.join(','));
    }

    data.forEach(row => {
        const values = headers.map(header => {
            const value = row[header];
            return typeof value === 'string' && value.includes(',') ? `"${value}"` : value;
        });
        csvContent.push(values.join(','));
    });

    return csvContent.join('\n');
}

function downloadFile(content, filename, contentType) {
    const blob = new Blob([content], { type: contentType });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    link.click();
    window.URL.revokeObjectURL(url);
}
        </code></pre>
    </div>
</div>

<!-- Include required libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

<script>
// Sample data
const sampleData = [
    { id: 1, name: 'John Doe', email: 'john@example.com', department: 'Engineering', salary: 75000, joinDate: '2023-01-15' },
    { id: 2, name: 'Jane Smith', email: 'jane@example.com', department: 'Marketing', salary: 65000, joinDate: '2023-02-20' },
    { id: 3, name: 'Mike Johnson', email: 'mike@example.com', department: 'Sales', salary: 55000, joinDate: '2023-03-10' },
    { id: 4, name: 'Sarah Wilson', email: 'sarah@example.com', department: 'HR', salary: 60000, joinDate: '2023-04-05' },
    { id: 5, name: 'David Brown', email: 'david@example.com', department: 'Engineering', salary: 80000, joinDate: '2023-05-12' },
    { id: 6, name: 'Lisa Garcia', email: 'lisa@example.com', department: 'Marketing', salary: 62000, joinDate: '2023-06-18' },
    { id: 7, name: 'Tom Anderson', email: 'tom@example.com', department: 'Sales', salary: 58000, joinDate: '2023-07-08' },
    { id: 8, name: 'Emily Davis', email: 'emily@example.com', department: 'Engineering', salary: 72000, joinDate: '2023-08-22' }
];

// Load table data
function loadTableData() {
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = '';

    sampleData.forEach(item => {
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50';
        row.innerHTML = `
            <td class="px-6 py-4 border-b">
                <input type="checkbox" class="row-select" value="${item.id}">
            </td>
            <td class="px-6 py-4 border-b">${item.id}</td>
            <td class="px-6 py-4 border-b">${item.name}</td>
            <td class="px-6 py-4 border-b">${item.email}</td>
            <td class="px-6 py-4 border-b">${item.department}</td>
            <td class="px-6 py-4 border-b">$${item.salary.toLocaleString()}</td>
            <td class="px-6 py-4 border-b">${formatDate(item.joinDate)}</td>
        `;
        tableBody.appendChild(row);
    });
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const format = document.getElementById('dateFormat').value;

    switch(format) {
        case 'MM/DD/YYYY':
            return `${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getDate().toString().padStart(2, '0')}/${date.getFullYear()}`;
        case 'DD/MM/YYYY':
            return `${date.getDate().toString().padStart(2, '0')}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getFullYear()}`;
        case 'YYYY-MM-DD':
            return dateString;
        default:
            return dateString;
    }
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.row-select');

    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

function getSelectedData() {
    const selectedIds = Array.from(document.querySelectorAll('.row-select:checked')).map(cb => parseInt(cb.value));
    return sampleData.filter(item => selectedIds.length === 0 || selectedIds.includes(item.id));
}

function showProgress() {
    document.getElementById('exportProgress').classList.remove('hidden');
    setTimeout(() => {
        document.getElementById('exportProgress').classList.add('hidden');
    }, 2000);
}

// Export functions
function exportToCSV() {
    showProgress();
    setTimeout(() => {
        const data = getSelectedData();
        const csv = convertToCSV(data);
        downloadFile(csv, 'data.csv', 'text/csv');
    }, 1000);
}

function exportToExcel() {
    showProgress();
    setTimeout(() => {
        const data = getSelectedData();
        const ws = XLSX.utils.json_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Data");
        XLSX.writeFile(wb, "data.xlsx");
    }, 1000);
}

function exportToPDF() {
    showProgress();
    setTimeout(() => {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const data = getSelectedData();
        const headers = ['ID', 'Name', 'Email', 'Department', 'Salary', 'Join Date'];
        const rows = data.map(item => [
            item.id,
            item.name,
            item.email,
            item.department,
            '$' + item.salary.toLocaleString(),
            formatDate(item.joinDate)
        ]);

        doc.autoTable({
            head: [headers],
            body: rows,
            startY: 20,
            theme: 'striped',
            styles: { fontSize: 8 },
            headStyles: { fillColor: [59, 130, 246] }
        });

        doc.save('data.pdf');
    }, 1000);
}

function convertToCSV(data) {
    const headers = ['id', 'name', 'email', 'department', 'salary', 'joinDate'];
    const csvContent = [];

    if (document.getElementById('includeHeaders').checked) {
        csvContent.push(headers.map(h => h.charAt(0).toUpperCase() + h.slice(1)).join(','));
    }

    data.forEach(row => {
        const values = headers.map(header => {
            let value = row[header];
            if (header === 'salary') value = '$' + value.toLocaleString();
            if (header === 'joinDate') value = formatDate(value);
            return typeof value === 'string' && value.includes(',') ? `"${value}"` : value;
        });
        csvContent.push(values.join(','));
    });

    return csvContent.join('\n');
}

function downloadFile(content, filename, contentType) {
    const blob = new Blob([content], { type: contentType });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    link.click();
    window.URL.revokeObjectURL(url);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    loadTableData();

    // Update table when date format changes
    document.getElementById('dateFormat').addEventListener('change', loadTableData);
});
</script>
@endsection
