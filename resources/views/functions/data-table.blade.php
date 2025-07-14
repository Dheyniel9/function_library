@extends('layouts.app')

@section('title', 'Data Table')

@section('content')
<!-- Custom Inline Styles for Data Table -->
<style>
    /* Custom table styling */
    .data-table-container {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .table-responsive {
        border-radius: 8px;
        overflow-x: auto;
    }

    .custom-table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d;
        padding: 1rem 1.5rem;
        white-space: nowrap;
        border-top: none;
    }

    .custom-table tbody td {
        padding: 1rem 1.5rem;
        border-top: 1px solid #dee2e6;
        vertical-align: middle;
        font-size: 0.875rem;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Custom badges for roles */
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .role-admin {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .role-editor {
        background-color: #fef3c7;
        color: #92400e;
    }

    .role-user {
        background-color: #d1fae5;
        color: #065f46;
    }

    /* Action buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        background: none;
        border: none;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .action-btn:hover {
        text-decoration: none;
    }

    .action-btn.btn-view {
        color: #2563eb;
    }

    .action-btn.btn-view:hover {
        color: #1d4ed8;
        background-color: #dbeafe;
    }

    .action-btn.btn-edit {
        color: #059669;
    }

    .action-btn.btn-edit:hover {
        color: #047857;
        background-color: #d1fae5;
    }

    .action-btn.btn-delete {
        color: #dc2626;
    }

    .action-btn.btn-delete:hover {
        color: #b91c1c;
        background-color: #fee2e2;
    }

    /* Code example styling */
    .code-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        overflow-x: auto;
    }

    .code-block {
        background-color: #2d3748;
        color: #e2e8f0;
        padding: 1.5rem;
        border-radius: 8px;
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
        font-size: 0.875rem;
        line-height: 1.5;
        margin: 0;
        overflow-x: auto;
        white-space: pre;
    }

    /* Table controls */
    .table-controls {
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #dee2e6;
    }

    .search-input {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .search-input:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .custom-table thead th,
        .custom-table tbody td {
            padding: 0.75rem 1rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }

        .action-btn {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="mb-4">
                <h1 class="h2 font-weight-bold text-dark mb-3">
                    <i class="fas fa-table mr-2 text-primary"></i>
                    Data Table Component
                </h1>
                <p class="text-muted mb-0">
                    <i class="fas fa-info-circle mr-1"></i>
                    Sortable data table with actions and responsive design using Bootstrap 4
                </p>
            </div>

            <!-- Demo Table -->
            <div class="data-table-container mb-4">
                <!-- Table Controls -->
                <div class="table-controls">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0 font-weight-semibold">Demo Data Table</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <input type="text" id="searchInput" class="search-input" placeholder="Search users..." style="width: 250px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Table -->
                <div class="table-responsive">
                    <table class="table custom-table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" class="sortable" data-column="id">
                                    ID
                                    <i class="fas fa-sort ml-1" id="sort-id"></i>
                                </th>
                                <th scope="col" class="sortable" data-column="name">
                                    Name
                                    <i class="fas fa-sort ml-1" id="sort-name"></i>
                                </th>
                                <th scope="col" class="sortable" data-column="email">
                                    Email
                                    <i class="fas fa-sort ml-1" id="sort-email"></i>
                                </th>
                                <th scope="col" class="sortable" data-column="role">
                                    Role
                                    <i class="fas fa-sort ml-1" id="sort-role"></i>
                                </th>
                                <th scope="col" class="sortable" data-column="created_at">
                                    Created At
                                    <i class="fas fa-sort ml-1" id="sort-created_at"></i>
                                </th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Sample Data (replace with your $users loop) -->
                            @if(isset($users) && !empty($users))
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td class="font-weight-medium">{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>
                                        <span class="role-badge
                                            {{ $user['role'] == 'Admin' ? 'role-admin' :
                                               ($user['role'] == 'Editor' ? 'role-editor' : 'role-user') }}">
                                            {{ $user['role'] }}
                                        </span>
                                    </td>
                                    <td>{{ $user['created_at'] ?? 'N/A' }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn btn-view" onclick="viewUser({{ $user['id'] }})">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </button>
                                            <button class="action-btn btn-edit" onclick="editUser({{ $user['id'] }})">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button class="action-btn btn-delete" onclick="deleteUser({{ $user['id'] }})">
                                                <i class="fas fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <!-- Fallback demo data if $users is not provided -->
                                <tr>
                                    <td>1</td>
                                    <td class="font-weight-medium">John Doe</td>
                                    <td>john@example.com</td>
                                    <td><span class="role-badge role-admin">Admin</span></td>
                                    <td>2024-01-15</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn btn-view" onclick="viewUser(1)">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </button>
                                            <button class="action-btn btn-edit" onclick="editUser(1)">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button class="action-btn btn-delete" onclick="deleteUser(1)">
                                                <i class="fas fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td class="font-weight-medium">Jane Smith</td>
                                    <td>jane@example.com</td>
                                    <td><span class="role-badge role-editor">Editor</span></td>
                                    <td>2024-01-14</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn btn-view" onclick="viewUser(2)">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </button>
                                            <button class="action-btn btn-edit" onclick="editUser(2)">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button class="action-btn btn-delete" onclick="deleteUser(2)">
                                                <i class="fas fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td class="font-weight-medium">Bob Wilson</td>
                                    <td>bob@example.com</td>
                                    <td><span class="role-badge role-user">User</span></td>
                                    <td>2024-01-13</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn btn-view" onclick="viewUser(3)">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </button>
                                            <button class="action-btn btn-edit" onclick="editUser(3)">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button class="action-btn btn-delete" onclick="deleteUser(3)">
                                                <i class="fas fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td class="font-weight-medium">Alice Johnson</td>
                                    <td>alice@example.com</td>
                                    <td><span class="role-badge role-editor">Editor</span></td>
                                    <td>2024-01-12</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn btn-view" onclick="viewUser(4)">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </button>
                                            <button class="action-btn btn-edit" onclick="editUser(4)">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button class="action-btn btn-delete" onclick="deleteUser(4)">
                                                <i class="fas fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td class="font-weight-medium">Charlie Brown</td>
                                    <td>charlie@example.com</td>
                                    <td><span class="role-badge role-user">User</span></td>
                                    <td>2024-01-11</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn btn-view" onclick="viewUser(5)">
                                                <i class="fas fa-eye mr-1"></i>View
                                            </button>
                                            <button class="action-btn btn-edit" onclick="editUser(5)">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button class="action-btn btn-delete" onclick="deleteUser(5)">
                                                <i class="fas fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer with Pagination Info -->
                <div class="table-controls border-top-0">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <small class="text-muted" id="tableInfo">Showing 5 entries</small>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-sm btn-outline-primary mr-2" onclick="exportTable()">
                                    <i class="fas fa-download mr-1"></i>Export CSV
                                </button>
                                <button class="btn btn-sm btn-primary" onclick="addNewUser()">
                                    <i class="fas fa-plus mr-1"></i>Add User
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Code Example -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-code mr-2"></i>
                        Controller & Blade Code Example
                    </h5>
                </div>
                <div class="card-body">
                    <div class="code-container">
                        <pre class="code-block">// Controller Example
public function dataTable()
{
    $users = [
        [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'Admin',
            'created_at' => '2024-01-15'
        ],
        [
            'id' => 2,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'role' => 'Editor',
            'created_at' => '2024-01-14'
        ],
        // Add more users...
    ];

    return view('functions.data-table', compact('users'));
}

// Blade Template Usage
&lt;div class="table-responsive"&gt;
    &lt;table class="table custom-table"&gt;
        &lt;thead&gt;
            &lt;tr&gt;
                &lt;th&gt;ID&lt;/th&gt;
                &lt;th&gt;Name&lt;/th&gt;
                &lt;th&gt;Email&lt;/th&gt;
                &lt;th&gt;Role&lt;/th&gt;
                &lt;th&gt;Actions&lt;/th&gt;
            &lt;/tr&gt;
        &lt;/thead&gt;
        &lt;tbody&gt;
            &#64;foreach($users as $user)
            &lt;tr&gt;
                &lt;td&gt;{{ $user['id'] }}&lt;/td&gt;
                &lt;td&gt;{{ $user['name'] }}&lt;/td&gt;
                &lt;td&gt;{{ $user['email'] }}&lt;/td&gt;
                &lt;td&gt;
                    &lt;span class="role-badge role-{{ strtolower($user['role']) }}"&gt;
                        {{ $user['role'] }}
                    &lt;/span&gt;
                &lt;/td&gt;
                &lt;td&gt;
                    &lt;button class="action-btn btn-view" onclick="viewUser({{ $user['id'] }})"&gt;
                        View
                    &lt;/button&gt;
                &lt;/td&gt;
            &lt;/tr&gt;
            &#64;endforeach
        &lt;/tbody&gt;
    &lt;/table&gt;
&lt;/div&gt;</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vanilla JavaScript for Table Functionality -->
<script>
    // Table functionality class
    class DataTableManager {
        constructor() {
            this.table = document.getElementById('dataTable');
            this.tableBody = document.getElementById('tableBody');
            this.searchInput = document.getElementById('searchInput');
            this.currentSort = { column: null, direction: 'asc' };
            this.originalData = this.getTableData();
            this.init();
        }

        init() {
            // Initialize search functionality
            this.setupSearch();
            // Initialize sorting functionality
            this.setupSorting();
            // Update table info
            this.updateTableInfo();
        }

        // Get current table data as array of objects
        getTableData() {
            const rows = Array.from(this.tableBody.querySelectorAll('tr'));
            return rows.map(row => {
                const cells = Array.from(row.querySelectorAll('td'));
                return {
                    element: row,
                    id: cells[0]?.textContent.trim(),
                    name: cells[1]?.textContent.trim(),
                    email: cells[2]?.textContent.trim(),
                    role: cells[3]?.textContent.trim(),
                    created_at: cells[4]?.textContent.trim()
                };
            });
        }

        // Setup search functionality
        setupSearch() {
            this.searchInput.addEventListener('input', (e) => {
                this.filterTable(e.target.value);
            });
        }

        // Filter table based on search term
        filterTable(searchTerm) {
            const term = searchTerm.toLowerCase();
            const rows = this.tableBody.querySelectorAll('tr');

            let visibleCount = 0;
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const isVisible = text.includes(term);
                row.style.display = isVisible ? '' : 'none';
                if (isVisible) visibleCount++;
            });

            this.updateTableInfo(visibleCount);
        }

        // Setup sorting functionality
        setupSorting() {
            const sortableHeaders = this.table.querySelectorAll('.sortable');
            sortableHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const column = header.getAttribute('data-column');
                    this.sortTable(column);
                });

                // Add pointer cursor style
                header.style.cursor = 'pointer';
            });
        }

        // Sort table by column
        sortTable(column) {
            const direction = (this.currentSort.column === column && this.currentSort.direction === 'asc') ? 'desc' : 'asc';

            // Update sort icons
            this.updateSortIcons(column, direction);

            // Get current data and sort
            const data = this.getTableData();
            data.sort((a, b) => {
                let valueA = a[column] || '';
                let valueB = b[column] || '';

                // Handle numeric sorting for ID
                if (column === 'id') {
                    valueA = parseInt(valueA) || 0;
                    valueB = parseInt(valueB) || 0;
                } else {
                    valueA = valueA.toString().toLowerCase();
                    valueB = valueB.toString().toLowerCase();
                }

                if (direction === 'asc') {
                    return valueA > valueB ? 1 : -1;
                } else {
                    return valueA < valueB ? 1 : -1;
                }
            });

            // Re-order table rows
            data.forEach(item => {
                this.tableBody.appendChild(item.element);
            });

            this.currentSort = { column, direction };
        }

        // Update sort icons
        updateSortIcons(activeColumn, direction) {
            // Reset all sort icons
            this.table.querySelectorAll('[id^="sort-"]').forEach(icon => {
                icon.className = 'fas fa-sort ml-1';
            });

            // Set active sort icon
            const activeIcon = document.getElementById(`sort-${activeColumn}`);
            if (activeIcon) {
                activeIcon.className = `fas fa-sort-${direction === 'asc' ? 'up' : 'down'} ml-1`;
            }
        }

        // Update table information
        updateTableInfo(visibleCount = null) {
            const totalRows = this.tableBody.querySelectorAll('tr').length;
            const showing = visibleCount !== null ? visibleCount : totalRows;
            const infoElement = document.getElementById('tableInfo');

            if (infoElement) {
                if (visibleCount !== null && visibleCount < totalRows) {
                    infoElement.textContent = `Showing ${showing} of ${totalRows} entries (filtered)`;
                } else {
                    infoElement.textContent = `Showing ${showing} entries`;
                }
            }
        }
    }

    // Action button functions
    function viewUser(userId) {
        // UPDATED: Show notification instead of alert
        if (typeof showNotification === 'function') {
            showNotification('Viewing user ID: ' + userId, 'info');
        } else {
            alert('Viewing user ID: ' + userId);
        }

        // Add your view user logic here
        console.log('View user:', userId);
    }

    function editUser(userId) {
        // UPDATED: Show notification instead of alert
        if (typeof showNotification === 'function') {
            showNotification('Editing user ID: ' + userId, 'warning');
        } else {
            alert('Editing user ID: ' + userId);
        }

        // Add your edit user logic here
        console.log('Edit user:', userId);
    }

    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            // UPDATED: Show notification instead of alert
            if (typeof showNotification === 'function') {
                showNotification('User ID ' + userId + ' deleted successfully!', 'success');
            } else {
                alert('User deleted: ' + userId);
            }

            // Add your delete user logic here
            console.log('Delete user:', userId);

            // Remove row from table (demo purposes)
            const row = document.querySelector(`button[onclick="deleteUser(${userId})"]`).closest('tr');
            if (row) {
                row.remove();
                // Update table info after deletion
                if (window.dataTableManager) {
                    window.dataTableManager.updateTableInfo();
                }
            }
        }
    }

    function exportTable() {
        // UPDATED: Show notification instead of alert
        if (typeof showNotification === 'function') {
            showNotification('Exporting table data to CSV...', 'info');
        }

        // Simple CSV export functionality
        const table = document.getElementById('dataTable');
        const rows = Array.from(table.querySelectorAll('tr'));

        let csvContent = '';
        rows.forEach(row => {
            const cells = Array.from(row.querySelectorAll('th, td'));
            const rowData = cells.slice(0, -1).map(cell => {
                // Remove HTML tags and get clean text
                return '"' + cell.textContent.trim().replace(/"/g, '""') + '"';
            });
            csvContent += rowData.join(',') + '\n';
        });

        // Download CSV file
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'users_data.csv';
        a.click();
        window.URL.revokeObjectURL(url);
    }

    function addNewUser() {
        // UPDATED: Show notification instead of alert
        if (typeof showNotification === 'function') {
            showNotification('Add new user functionality would open here', 'info');
        } else {
            alert('Add new user functionality would open here');
        }

        // Add your add user logic here (open modal, redirect to form, etc.)
        console.log('Add new user');
    }

    // Initialize data table when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        window.dataTableManager = new DataTableManager();

        // UPDATED: Show loading notification
        setTimeout(() => {
            if (typeof showNotification === 'function') {
                showNotification('Data table loaded successfully! Try searching and sorting.', 'success');
            }
        }, 1000);
    });
</script>
@endsection
