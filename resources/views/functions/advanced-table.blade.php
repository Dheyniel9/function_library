@extends('layouts.app')

@section('title', 'Advanced Table')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Advanced Table with Features</h1>

        <!-- Table Controls -->
        <div class="mb-6 flex flex-wrap gap-4 items-center justify-between">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700">Show:</label>
                    <select id="entriesPerPage" class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-sm text-gray-700">entries</span>
                </div>

                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700">Filter by Department:</label>
                    <select id="departmentFilter" class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <option value="">All Departments</option>
                        <option value="IT">IT</option>
                        <option value="HR">HR</option>
                        <option value="Finance">Finance</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700">Status:</label>
                    <select id="statusFilter" class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <option value="">All Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="text" id="searchInput" placeholder="Search employees..." class="border border-gray-300 rounded px-3 py-2 text-sm w-64">
                <button id="exportBtn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                    Export CSV
                </button>
                <button id="addEmployeeBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                    Add Employee
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="border border-gray-200 px-4 py-3 text-left">
                            <input type="checkbox" id="selectAll" class="rounded">
                        </th>
                        <th class="border border-gray-200 px-4 py-3 text-left cursor-pointer hover:bg-gray-100" onclick="sortTable('id')">
                            ID <span id="sort-id" class="sort-arrow">↕</span>
                        </th>
                        <th class="border border-gray-200 px-4 py-3 text-left cursor-pointer hover:bg-gray-100" onclick="sortTable('name')">
                            Name <span id="sort-name" class="sort-arrow">↕</span>
                        </th>
                        <th class="border border-gray-200 px-4 py-3 text-left cursor-pointer hover:bg-gray-100" onclick="sortTable('email')">
                            Email <span id="sort-email" class="sort-arrow">↕</span>
                        </th>
                        <th class="border border-gray-200 px-4 py-3 text-left cursor-pointer hover:bg-gray-100" onclick="sortTable('department')">
                            Department <span id="sort-department" class="sort-arrow">↕</span>
                        </th>
                        <th class="border border-gray-200 px-4 py-3 text-left cursor-pointer hover:bg-gray-100" onclick="sortTable('salary')">
                            Salary <span id="sort-salary" class="sort-arrow">↕</span>
                        </th>
                        <th class="border border-gray-200 px-4 py-3 text-left cursor-pointer hover:bg-gray-100" onclick="sortTable('hire_date')">
                            Hire Date <span id="sort-hire_date" class="sort-arrow">↕</span>
                        </th>
                        <th class="border border-gray-200 px-4 py-3 text-left cursor-pointer hover:bg-gray-100" onclick="sortTable('status')">
                            Status <span id="sort-status" class="sort-arrow">↕</span>
                        </th>
                        <th class="border border-gray-200 px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Data will be populated by JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Showing <span id="showingFrom">1</span> to <span id="showingTo">10</span> of <span id="totalEntries">0</span> entries
            </div>
            <div class="flex items-center gap-2">
                <button id="prevPage" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                    Previous
                </button>
                <div id="pageNumbers" class="flex gap-1">
                    <!-- Page numbers will be populated by JavaScript -->
                </div>
                <button id="nextPage" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                    Next
                </button>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div id="bulkActions" class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg hidden">
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-yellow-800">
                    <span id="selectedCount">0</span> item(s) selected
                </span>
                <button id="bulkDeleteBtn" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                    Delete Selected
                </button>
                <button id="bulkExportBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                    Export Selected
                </button>
                <button id="bulkUpdateStatusBtn" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                    Update Status
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Employee Modal -->
<div id="addEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Add New Employee</h3>
                <form id="addEmployeeForm">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" id="employeeName" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="employeeEmail" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select id="employeeDepartment" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">Select Department</option>
                                <option value="IT">IT</option>
                                <option value="HR">HR</option>
                                <option value="Finance">Finance</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                            <input type="number" id="employeeSalary" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hire Date</label>
                            <input type="date" id="employeeHireDate" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="employeeStatus" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" id="cancelAddEmployee" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.sort-arrow {
    font-size: 0.8rem;
    color: #6b7280;
}

.sort-arrow.asc {
    color: #3b82f6;
}

.sort-arrow.desc {
    color: #3b82f6;
}
</style>

<script>
class AdvancedTable {
    constructor() {
        this.data = @json($tableData);
        this.filteredData = [...this.data];
        this.currentPage = 1;
        this.entriesPerPage = 10;
        this.sortColumn = '';
        this.sortDirection = 'asc';
        this.selectedItems = new Set();
        this.init();
    }

    init() {
        this.bindEvents();
        this.renderTable();
        this.updatePagination();
    }

    bindEvents() {
        // Search
        document.getElementById('searchInput').addEventListener('input', (e) => {
            this.search(e.target.value);
        });

        // Filters
        document.getElementById('departmentFilter').addEventListener('change', () => {
            this.applyFilters();
        });

        document.getElementById('statusFilter').addEventListener('change', () => {
            this.applyFilters();
        });

        // Entries per page
        document.getElementById('entriesPerPage').addEventListener('change', (e) => {
            this.entriesPerPage = parseInt(e.target.value);
            this.currentPage = 1;
            this.renderTable();
            this.updatePagination();
        });

        // Select all
        document.getElementById('selectAll').addEventListener('change', (e) => {
            this.selectAll(e.target.checked);
        });

        // Pagination
        document.getElementById('prevPage').addEventListener('click', () => {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.renderTable();
                this.updatePagination();
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            const totalPages = Math.ceil(this.filteredData.length / this.entriesPerPage);
            if (this.currentPage < totalPages) {
                this.currentPage++;
                this.renderTable();
                this.updatePagination();
            }
        });

        // Export
        document.getElementById('exportBtn').addEventListener('click', () => {
            this.exportCSV();
        });

        // Add employee
        document.getElementById('addEmployeeBtn').addEventListener('click', () => {
            this.showAddEmployeeModal();
        });

        document.getElementById('cancelAddEmployee').addEventListener('click', () => {
            this.hideAddEmployeeModal();
        });

        document.getElementById('addEmployeeForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.addEmployee();
        });

        // Bulk actions
        document.getElementById('bulkDeleteBtn').addEventListener('click', () => {
            this.bulkDelete();
        });

        document.getElementById('bulkExportBtn').addEventListener('click', () => {
            this.bulkExport();
        });
    }

    search(query) {
        if (!query) {
            this.applyFilters();
            return;
        }

        this.filteredData = this.data.filter(item =>
            item.name.toLowerCase().includes(query.toLowerCase()) ||
            item.email.toLowerCase().includes(query.toLowerCase()) ||
            item.department.toLowerCase().includes(query.toLowerCase())
        );

        this.currentPage = 1;
        this.renderTable();
        this.updatePagination();
    }

    applyFilters() {
        const departmentFilter = document.getElementById('departmentFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;
        const searchQuery = document.getElementById('searchInput').value;

        this.filteredData = this.data.filter(item => {
            const matchesDepartment = !departmentFilter || item.department === departmentFilter;
            const matchesStatus = !statusFilter || item.status === statusFilter;
            const matchesSearch = !searchQuery ||
                item.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
                item.email.toLowerCase().includes(searchQuery.toLowerCase()) ||
                item.department.toLowerCase().includes(searchQuery.toLowerCase());

            return matchesDepartment && matchesStatus && matchesSearch;
        });

        this.currentPage = 1;
        this.renderTable();
        this.updatePagination();
    }

    sortTable(column) {
        if (this.sortColumn === column) {
            this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            this.sortColumn = column;
            this.sortDirection = 'asc';
        }

        this.filteredData.sort((a, b) => {
            let aValue = a[column];
            let bValue = b[column];

            if (column === 'salary') {
                aValue = parseInt(aValue);
                bValue = parseInt(bValue);
            }

            if (this.sortDirection === 'asc') {
                return aValue > bValue ? 1 : -1;
            } else {
                return aValue < bValue ? 1 : -1;
            }
        });

        this.updateSortArrows();
        this.renderTable();
    }

    updateSortArrows() {
        // Reset all arrows
        document.querySelectorAll('.sort-arrow').forEach(arrow => {
            arrow.className = 'sort-arrow';
            arrow.textContent = '↕';
        });

        // Update current column arrow
        if (this.sortColumn) {
            const arrow = document.getElementById(`sort-${this.sortColumn}`);
            if (arrow) {
                arrow.className = `sort-arrow ${this.sortDirection}`;
                arrow.textContent = this.sortDirection === 'asc' ? '↑' : '↓';
            }
        }
    }

    renderTable() {
        const startIndex = (this.currentPage - 1) * this.entriesPerPage;
        const endIndex = startIndex + this.entriesPerPage;
        const pageData = this.filteredData.slice(startIndex, endIndex);

        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        pageData.forEach(item => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="border border-gray-200 px-4 py-3">
                    <input type="checkbox" class="rounded row-checkbox" data-id="${item.id}">
                </td>
                <td class="border border-gray-200 px-4 py-3">${item.id}</td>
                <td class="border border-gray-200 px-4 py-3 font-medium">${item.name}</td>
                <td class="border border-gray-200 px-4 py-3">${item.email}</td>
                <td class="border border-gray-200 px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs ${this.getDepartmentColor(item.department)}">${item.department}</span>
                </td>
                <td class="border border-gray-200 px-4 py-3">$${item.salary.toLocaleString()}</td>
                <td class="border border-gray-200 px-4 py-3">${item.hire_date}</td>
                <td class="border border-gray-200 px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs ${item.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">${item.status}</span>
                </td>
                <td class="border border-gray-200 px-4 py-3">
                    <div class="flex gap-2">
                        <button onclick="editEmployee(${item.id})" class="text-blue-600 hover:text-blue-800 text-sm">Edit</button>
                        <button onclick="deleteEmployee(${item.id})" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });

        // Bind checkbox events
        document.querySelectorAll('.row-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                const id = parseInt(e.target.dataset.id);
                if (e.target.checked) {
                    this.selectedItems.add(id);
                } else {
                    this.selectedItems.delete(id);
                }
                this.updateBulkActions();
            });
        });
    }

    getDepartmentColor(department) {
        const colors = {
            'IT': 'bg-blue-100 text-blue-800',
            'HR': 'bg-purple-100 text-purple-800',
            'Finance': 'bg-green-100 text-green-800',
            'Marketing': 'bg-yellow-100 text-yellow-800'
        };
        return colors[department] || 'bg-gray-100 text-gray-800';
    }

    updatePagination() {
        const totalPages = Math.ceil(this.filteredData.length / this.entriesPerPage);
        const startIndex = (this.currentPage - 1) * this.entriesPerPage;
        const endIndex = Math.min(startIndex + this.entriesPerPage, this.filteredData.length);

        document.getElementById('showingFrom').textContent = this.filteredData.length > 0 ? startIndex + 1 : 0;
        document.getElementById('showingTo').textContent = endIndex;
        document.getElementById('totalEntries').textContent = this.filteredData.length;

        document.getElementById('prevPage').disabled = this.currentPage === 1;
        document.getElementById('nextPage').disabled = this.currentPage === totalPages;

        // Update page numbers
        const pageNumbers = document.getElementById('pageNumbers');
        pageNumbers.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= this.currentPage - 1 && i <= this.currentPage + 1)) {
                const button = document.createElement('button');
                button.textContent = i;
                button.className = `px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50 ${i === this.currentPage ? 'bg-blue-600 text-white' : ''}`;
                button.addEventListener('click', () => {
                    this.currentPage = i;
                    this.renderTable();
                    this.updatePagination();
                });
                pageNumbers.appendChild(button);
            } else if (i === this.currentPage - 2 || i === this.currentPage + 2) {
                const span = document.createElement('span');
                span.textContent = '...';
                span.className = 'px-2 py-1 text-gray-500';
                pageNumbers.appendChild(span);
            }
        }
    }

    selectAll(checked) {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = checked;
            const id = parseInt(checkbox.dataset.id);
            if (checked) {
                this.selectedItems.add(id);
            } else {
                this.selectedItems.delete(id);
            }
        });
        this.updateBulkActions();
    }

    updateBulkActions() {
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');

        if (this.selectedItems.size > 0) {
            bulkActions.classList.remove('hidden');
            selectedCount.textContent = this.selectedItems.size;
        } else {
            bulkActions.classList.add('hidden');
        }
    }

    exportCSV() {
        const csvContent = this.generateCSV(this.filteredData);
        this.downloadCSV(csvContent, 'employees.csv');
        showSuccess('Data exported successfully!');
    }

    generateCSV(data) {
        const headers = ['ID', 'Name', 'Email', 'Department', 'Salary', 'Hire Date', 'Status'];
        let csv = headers.join(',') + '\n';

        data.forEach(item => {
            const row = [
                item.id,
                `"${item.name}"`,
                `"${item.email}"`,
                `"${item.department}"`,
                item.salary,
                item.hire_date,
                item.status
            ];
            csv += row.join(',') + '\n';
        });

        return csv;
    }

    downloadCSV(content, filename) {
        const blob = new Blob([content], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', filename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    showAddEmployeeModal() {
        document.getElementById('addEmployeeModal').classList.remove('hidden');
    }

    hideAddEmployeeModal() {
        document.getElementById('addEmployeeModal').classList.add('hidden');
        document.getElementById('addEmployeeForm').reset();
    }

    addEmployee() {
        const newEmployee = {
            id: Math.max(...this.data.map(item => item.id)) + 1,
            name: document.getElementById('employeeName').value,
            email: document.getElementById('employeeEmail').value,
            department: document.getElementById('employeeDepartment').value,
            salary: parseInt(document.getElementById('employeeSalary').value),
            hire_date: document.getElementById('employeeHireDate').value,
            status: document.getElementById('employeeStatus').value
        };

        this.data.push(newEmployee);
        this.applyFilters();
        this.hideAddEmployeeModal();
        showSuccess('Employee added successfully!');
    }

    bulkDelete() {
        if (confirm(`Are you sure you want to delete ${this.selectedItems.size} selected items?`)) {
            this.data = this.data.filter(item => !this.selectedItems.has(item.id));
            this.selectedItems.clear();
            this.applyFilters();
            showSuccess('Selected items deleted successfully!');
        }
    }

    bulkExport() {
        const selectedData = this.data.filter(item => this.selectedItems.has(item.id));
        const csvContent = this.generateCSV(selectedData);
        this.downloadCSV(csvContent, 'selected_employees.csv');
        showSuccess('Selected data exported successfully!');
    }
}

// Global functions
function sortTable(column) {
    table.sortTable(column);
}

function editEmployee(id) {
    showInfo(`Edit employee ${id} (functionality to be implemented)`);
}

function deleteEmployee(id) {
    if (confirm('Are you sure you want to delete this employee?')) {
        table.data = table.data.filter(item => item.id !== id);
        table.applyFilters();
        showSuccess('Employee deleted successfully!');
    }
}

// Initialize table
let table;
document.addEventListener('DOMContentLoaded', function() {
    table = new AdvancedTable();

    setTimeout(() => {
        showInfo('Advanced table loaded with sorting, filtering, and export features!');
    }, 1000);
});
</script>
@endsection
