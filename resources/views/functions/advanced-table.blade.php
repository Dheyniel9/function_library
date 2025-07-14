@extends('layouts.app')

@section('title', 'Advanced Table')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div style="background: #ffffff; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 30px;">
        <h1 style="font-size: 24px; font-weight: 600; color: #1a1a1a; margin-bottom: 30px; border-bottom: 1px solid #e5e5e5; padding-bottom: 15px;">Employee Management</h1>

        <!-- Table Controls -->
        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px; align-items: end;">
            <div style="flex: 1; min-width: 200px;">
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <div style="min-width: 80px;">
                        <label style="display: block; font-size: 12px; color: #666; margin-bottom: 5px;">Show:</label>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <select id="entriesPerPage" style="width: 60px; padding: 6px 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; background: white;">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span style="font-size: 12px; color: #888;">entries</span>
                        </div>
                    </div>
                    <div style="min-width: 120px;">
                        <label style="display: block; font-size: 12px; color: #666; margin-bottom: 5px;">Department:</label>
                        <select id="departmentFilter" style="width: 100%; padding: 6px 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; background: white;">
                            <option value="">All</option>
                            <option value="IT">IT</option>
                            <option value="HR">HR</option>
                            <option value="Finance">Finance</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    <div style="min-width: 100px;">
                        <label style="display: block; font-size: 12px; color: #666; margin-bottom: 5px;">Status:</label>
                        <select id="statusFilter" style="width: 100%; padding: 6px 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; background: white;">
                            <option value="">All</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="text" id="searchInput" placeholder="Search..." style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; width: 200px;">
                <button id="exportBtn" style="padding: 8px 16px; background: #10b981; color: white; border: none; border-radius: 4px; font-size: 13px; cursor: pointer;">Export</button>
                <button id="addEmployeeBtn" style="padding: 8px 16px; background: #3b82f6; color: white; border: none; border-radius: 4px; font-size: 13px; cursor: pointer;">Add</button>
            </div>
        </div>

        <!-- Table -->
        <div style="overflow-x: auto; border: 1px solid #e5e5e5; border-radius: 6px;">
            <table style="width: 100%; border-collapse: collapse; background: white;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 1px solid #e5e5e5;">
                        <th style="padding: 12px; text-align: left; width: 50px; font-weight: 500; font-size: 13px; color: #666;">
                            <input type="checkbox" id="selectAll" style="margin: 0;">
                        </th>
                        <th style="padding: 12px; text-align: left; cursor: pointer; user-select: none; font-weight: 500; font-size: 13px; color: #666;" data-column="id">
                            ID <span style="font-size: 12px; color: #999; margin-left: 4px;">↕</span>
                        </th>
                        <th style="padding: 12px; text-align: left; cursor: pointer; user-select: none; font-weight: 500; font-size: 13px; color: #666;" data-column="name">
                            Name <span style="font-size: 12px; color: #999; margin-left: 4px;">↕</span>
                        </th>
                        <th style="padding: 12px; text-align: left; cursor: pointer; user-select: none; font-weight: 500; font-size: 13px; color: #666;" data-column="email">
                            Email <span style="font-size: 12px; color: #999; margin-left: 4px;">↕</span>
                        </th>
                        <th style="padding: 12px; text-align: left; cursor: pointer; user-select: none; font-weight: 500; font-size: 13px; color: #666;" data-column="department">
                            Department <span style="font-size: 12px; color: #999; margin-left: 4px;">↕</span>
                        </th>
                        <th style="padding: 12px; text-align: left; cursor: pointer; user-select: none; font-weight: 500; font-size: 13px; color: #666;" data-column="salary">
                            Salary <span style="font-size: 12px; color: #999; margin-left: 4px;">↕</span>
                        </th>
                        <th style="padding: 12px; text-align: left; cursor: pointer; user-select: none; font-weight: 500; font-size: 13px; color: #666;" data-column="hire_date">
                            Hire Date <span style="font-size: 12px; color: #999; margin-left: 4px;">↕</span>
                        </th>
                        <th style="padding: 12px; text-align: left; cursor: pointer; user-select: none; font-weight: 500; font-size: 13px; color: #666;" data-column="status">
                            Status <span style="font-size: 12px; color: #999; margin-left: 4px;">↕</span>
                        </th>
                        <th style="padding: 12px; text-align: left; width: 120px; font-weight: 500; font-size: 13px; color: #666;">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Data will be populated by JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
            <div style="font-size: 13px; color: #666;">
                Showing <span id="showingFrom">1</span> to <span id="showingTo">10</span> of <span id="totalEntries">0</span> entries
            </div>
            <div style="display: flex; gap: 5px; align-items: center;">
                <button id="prevPage" style="padding: 6px 12px; border: 1px solid #ddd; background: white; color: #666; border-radius: 4px; font-size: 13px; cursor: pointer;">Previous</button>
                <div id="pageNumbers" style="display: flex; gap: 2px;">
                    <!-- Page numbers will be populated by JavaScript -->
                </div>
                <button id="nextPage" style="padding: 6px 12px; border: 1px solid #ddd; background: white; color: #666; border-radius: 4px; font-size: 13px; cursor: pointer;">Next</button>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div id="bulkActions" style="display: none; margin-top: 20px; padding: 15px; background: #fef3c7; border: 1px solid #f59e0b; border-radius: 6px;">
            <div style="display: flex; align-items: center; gap: 15px;">
                <span style="font-weight: 500; color: #92400e; font-size: 13px;">
                    <span id="selectedCount">0</span> item(s) selected
                </span>
                <button id="bulkDeleteBtn" style="padding: 6px 12px; background: #ef4444; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">Delete Selected</button>
                <button id="bulkExportBtn" style="padding: 6px 12px; background: #06b6d4; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">Export Selected</button>
                <button id="bulkUpdateStatusBtn" style="padding: 6px 12px; background: #10b981; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">Update Status</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Employee Modal -->
<div id="addEmployeeModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 8px; width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto;">
        <div style="padding: 20px; border-bottom: 1px solid #e5e5e5;">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #1a1a1a;">Add New Employee</h3>
            <button type="button" onclick="closeModal()" style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 20px; cursor: pointer; color: #999;">&times;</button>
        </div>
        <form id="addEmployeeForm">
            <div style="padding: 20px;">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #666; margin-bottom: 5px;">Name</label>
                    <input type="text" id="employeeName" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #666; margin-bottom: 5px;">Email</label>
                    <input type="email" id="employeeEmail" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #666; margin-bottom: 5px;">Department</label>
                    <select id="employeeDepartment" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; background: white;">
                        <option value="">Select Department</option>
                        <option value="IT">IT</option>
                        <option value="HR">HR</option>
                        <option value="Finance">Finance</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #666; margin-bottom: 5px;">Salary</label>
                    <input type="number" id="employeeSalary" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #666; margin-bottom: 5px;">Hire Date</label>
                    <input type="date" id="employeeHireDate" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; color: #666; margin-bottom: 5px;">Status</label>
                    <select id="employeeStatus" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; background: white;">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div style="padding: 20px; border-top: 1px solid #e5e5e5; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal()" style="padding: 10px 20px; background: #f3f4f6; color: #666; border: none; border-radius: 4px; font-size: 14px; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 20px; background: #3b82f6; color: white; border: none; border-radius: 4px; font-size: 14px; cursor: pointer;">Add Employee</button>
            </div>
        </form>
    </div>
</div>

<script>
// Advanced Table JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Data from PHP
    var tableData = @json($tableData);
    var filteredData = [...tableData];
    var currentPage = 1;
    var entriesPerPage = 10;
    var sortColumn = '';
    var sortDirection = 'asc';
    var selectedItems = new Set();

    // Initialize table
    function init() {
        bindEvents();
        renderTable();
        updatePagination();
    }

    // Bind all event listeners
    function bindEvents() {
        // Search
        document.getElementById('searchInput').addEventListener('input', function(e) {
            search(e.target.value);
        });

        // Filters
        document.getElementById('departmentFilter').addEventListener('change', applyFilters);
        document.getElementById('statusFilter').addEventListener('change', applyFilters);

        // Entries per page
        document.getElementById('entriesPerPage').addEventListener('change', function(e) {
            entriesPerPage = parseInt(e.target.value);
            currentPage = 1;
            renderTable();
            updatePagination();
        });

        // Select all
        document.getElementById('selectAll').addEventListener('change', function(e) {
            selectAll(e.target.checked);
        });

        // Pagination
        document.getElementById('prevPage').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
                updatePagination();
            }
        });

        document.getElementById('nextPage').addEventListener('click', function() {
            var totalPages = Math.ceil(filteredData.length / entriesPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
                updatePagination();
            }
        });

        // Export
        document.getElementById('exportBtn').addEventListener('click', exportCSV);

        // Add employee
        document.getElementById('addEmployeeBtn').addEventListener('click', function() {
            document.getElementById('addEmployeeModal').style.display = 'flex';
        });

        document.getElementById('addEmployeeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            addEmployee();
        });

        // Bulk actions
        document.getElementById('bulkDeleteBtn').addEventListener('click', bulkDelete);
        document.getElementById('bulkExportBtn').addEventListener('click', bulkExport);

        // Sort headers
        document.querySelectorAll('th[data-column]').forEach(function(header) {
            header.addEventListener('click', function() {
                var column = this.getAttribute('data-column');
                sortTable(column);
            });
        });
    }

    // Close modal function
    window.closeModal = function() {
        document.getElementById('addEmployeeModal').style.display = 'none';
        document.getElementById('addEmployeeForm').reset();
    };

    // Search function
    function search(query) {
        if (!query) {
            applyFilters();
            return;
        }

        filteredData = tableData.filter(function(item) {
            return item.name.toLowerCase().includes(query.toLowerCase()) ||
                   item.email.toLowerCase().includes(query.toLowerCase()) ||
                   item.department.toLowerCase().includes(query.toLowerCase());
        });

        currentPage = 1;
        renderTable();
        updatePagination();
    }

    // Apply filters
    function applyFilters() {
        var departmentFilter = document.getElementById('departmentFilter').value;
        var statusFilter = document.getElementById('statusFilter').value;
        var searchQuery = document.getElementById('searchInput').value;

        filteredData = tableData.filter(function(item) {
            var matchesDepartment = !departmentFilter || item.department === departmentFilter;
            var matchesStatus = !statusFilter || item.status === statusFilter;
            var matchesSearch = !searchQuery ||
                item.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
                item.email.toLowerCase().includes(searchQuery.toLowerCase()) ||
                item.department.toLowerCase().includes(searchQuery.toLowerCase());

            return matchesDepartment && matchesStatus && matchesSearch;
        });

        currentPage = 1;
        renderTable();
        updatePagination();
    }

    // Sort table
    function sortTable(column) {
        if (sortColumn === column) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortColumn = column;
            sortDirection = 'asc';
        }

        filteredData.sort(function(a, b) {
            var aValue = a[column];
            var bValue = b[column];

            if (column === 'salary') {
                aValue = parseInt(aValue);
                bValue = parseInt(bValue);
            }

            if (sortDirection === 'asc') {
                return aValue > bValue ? 1 : -1;
            } else {
                return aValue < bValue ? 1 : -1;
            }
        });

        updateSortArrows();
        renderTable();
    }

    // Update sort arrows
    function updateSortArrows() {
        // Reset all arrows
        document.querySelectorAll('th[data-column] span').forEach(function(arrow) {
            arrow.textContent = '↕';
            arrow.style.color = '#999';
        });

        // Update current column arrow
        if (sortColumn) {
            var arrow = document.querySelector('th[data-column="' + sortColumn + '"] span');
            if (arrow) {
                arrow.textContent = sortDirection === 'asc' ? '↑' : '↓';
                arrow.style.color = '#3b82f6';
            }
        }
    }

    // Render table
    function renderTable() {
        var startIndex = (currentPage - 1) * entriesPerPage;
        var endIndex = startIndex + entriesPerPage;
        var pageData = filteredData.slice(startIndex, endIndex);

        var tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        pageData.forEach(function(item) {
            var row = document.createElement('tr');
            row.style.borderBottom = '1px solid #f0f0f0';
            row.innerHTML =
                '<td style="padding: 12px;"><input type="checkbox" class="row-checkbox" value="' + item.id + '" style="margin: 0;"></td>' +
                '<td style="padding: 12px; font-size: 13px; color: #666;">' + item.id + '</td>' +
                '<td style="padding: 12px; font-size: 13px; color: #1a1a1a; font-weight: 500;">' + item.name + '</td>' +
                '<td style="padding: 12px; font-size: 13px; color: #666;">' + item.email + '</td>' +
                '<td style="padding: 12px;"><span style="' + getDepartmentStyle(item.department) + '">' + item.department + '</span></td>' +
                '<td style="padding: 12px; font-size: 13px; color: #1a1a1a; font-weight: 500;">$' + parseInt(item.salary).toLocaleString() + '</td>' +
                '<td style="padding: 12px; font-size: 13px; color: #666;">' + item.hire_date + '</td>' +
                '<td style="padding: 12px;"><span style="' + getStatusStyle(item.status) + '">' + item.status + '</span></td>' +
                '<td style="padding: 12px;">' +
                    '<button onclick="editEmployee(' + item.id + ')" style="padding: 4px 8px; background: none; border: 1px solid #ddd; color: #666; border-radius: 3px; font-size: 12px; cursor: pointer; margin-right: 5px;">Edit</button>' +
                    '<button onclick="deleteEmployee(' + item.id + ')" style="padding: 4px 8px; background: none; border: 1px solid #ef4444; color: #ef4444; border-radius: 3px; font-size: 12px; cursor: pointer;">Delete</button>' +
                '</td>';

            tbody.appendChild(row);
        });

        // Bind checkbox events
        document.querySelectorAll('.row-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var itemId = parseInt(this.value);
                if (this.checked) {
                    selectedItems.add(itemId);
                } else {
                    selectedItems.delete(itemId);
                }
                updateBulkActions();
            });
        });

        // Update showing info
        document.getElementById('showingFrom').textContent = startIndex + 1;
        document.getElementById('showingTo').textContent = Math.min(endIndex, filteredData.length);
        document.getElementById('totalEntries').textContent = filteredData.length;
    }

    // Get department style
    function getDepartmentStyle(department) {
        var styles = {
            'IT': 'background: #dbeafe; color: #1d4ed8; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;',
            'HR': 'background: #e0e7ff; color: #6366f1; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;',
            'Finance': 'background: #dcfce7; color: #16a34a; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;',
            'Marketing': 'background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;'
        };
        return styles[department] || 'background: #f3f4f6; color: #6b7280; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;';
    }

    // Get status style
    function getStatusStyle(status) {
        return status === 'Active'
            ? 'background: #dcfce7; color: #16a34a; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;'
            : 'background: #f3f4f6; color: #6b7280; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;';
    }

    // Update pagination
    function updatePagination() {
        var totalPages = Math.ceil(filteredData.length / entriesPerPage);

        // Update button states
        document.getElementById('prevPage').disabled = currentPage === 1;
        document.getElementById('nextPage').disabled = currentPage === totalPages;

        // Update page numbers
        var pageNumbers = document.getElementById('pageNumbers');
        pageNumbers.innerHTML = '';

        for (var i = 1; i <= totalPages; i++) {
            var pageBtn = document.createElement('button');
            pageBtn.textContent = i;
            pageBtn.style.padding = '6px 10px';
            pageBtn.style.border = '1px solid #ddd';
            pageBtn.style.borderRadius = '4px';
            pageBtn.style.fontSize = '13px';
            pageBtn.style.cursor = 'pointer';
            pageBtn.style.margin = '0 1px';

            if (i === currentPage) {
                pageBtn.style.background = '#3b82f6';
                pageBtn.style.color = 'white';
                pageBtn.style.borderColor = '#3b82f6';
            } else {
                pageBtn.style.background = 'white';
                pageBtn.style.color = '#666';
                pageBtn.onclick = function(page) {
                    return function() {
                        currentPage = page;
                        renderTable();
                        updatePagination();
                    };
                }(i);
            }

            pageNumbers.appendChild(pageBtn);
        }
    }

    // Select all function
    function selectAll(checked) {
        var checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = checked;
            var itemId = parseInt(checkbox.value);
            if (checked) {
                selectedItems.add(itemId);
            } else {
                selectedItems.delete(itemId);
            }
        });
        updateBulkActions();
    }

    // Update bulk actions
    function updateBulkActions() {
        var bulkActions = document.getElementById('bulkActions');
        var selectedCount = document.getElementById('selectedCount');

        if (selectedItems.size > 0) {
            bulkActions.style.display = 'block';
            selectedCount.textContent = selectedItems.size;
        } else {
            bulkActions.style.display = 'none';
        }
    }

    // Add employee
    function addEmployee() {
        var name = document.getElementById('employeeName').value;
        var email = document.getElementById('employeeEmail').value;
        var department = document.getElementById('employeeDepartment').value;
        var salary = document.getElementById('employeeSalary').value;
        var hireDate = document.getElementById('employeeHireDate').value;
        var status = document.getElementById('employeeStatus').value;

        var newEmployee = {
            id: tableData.length + 1,
            name: name,
            email: email,
            department: department,
            salary: salary,
            hire_date: hireDate,
            status: status
        };

        tableData.push(newEmployee);
        applyFilters();
        closeModal();
        alert('Employee added successfully!');
    }

    // Edit employee
    window.editEmployee = function(id) {
        var employee = tableData.find(function(emp) { return emp.id === id; });
        if (employee) {
            alert('Edit functionality would be implemented here for: ' + employee.name);
        }
    };

    // Delete employee
    window.deleteEmployee = function(id) {
        if (confirm('Are you sure you want to delete this employee?')) {
            tableData = tableData.filter(function(emp) { return emp.id !== id; });
            applyFilters();
            alert('Employee deleted successfully!');
        }
    };

    // Export CSV
    function exportCSV() {
        var csv = 'ID,Name,Email,Department,Salary,Hire Date,Status\n';
        filteredData.forEach(function(item) {
            csv += item.id + ',' + item.name + ',' + item.email + ',' + item.department + ',' + item.salary + ',' + item.hire_date + ',' + item.status + '\n';
        });

        var blob = new Blob([csv], { type: 'text/csv' });
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'employees.csv';
        a.click();
        window.URL.revokeObjectURL(url);
    }

    // Bulk delete
    function bulkDelete() {
        if (selectedItems.size === 0) return;

        if (confirm('Are you sure you want to delete ' + selectedItems.size + ' selected items?')) {
            tableData = tableData.filter(function(item) {
                return !selectedItems.has(item.id);
            });
            selectedItems.clear();
            applyFilters();
            updateBulkActions();
            alert('Selected employees deleted successfully!');
        }
    }

    // Bulk export
    function bulkExport() {
        if (selectedItems.size === 0) return;

        var selectedData = tableData.filter(function(item) {
            return selectedItems.has(item.id);
        });

        var csv = 'ID,Name,Email,Department,Salary,Hire Date,Status\n';
        selectedData.forEach(function(item) {
            csv += item.id + ',' + item.name + ',' + item.email + ',' + item.department + ',' + item.salary + ',' + item.hire_date + ',' + item.status + '\n';
        });

        var blob = new Blob([csv], { type: 'text/csv' });
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'selected_employees.csv';
        a.click();
        window.URL.revokeObjectURL(url);
    }

    // Initialize the table
    init();
});
</script>
@endsection
