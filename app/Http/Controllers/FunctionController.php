<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunctionController extends Controller
{
    // 1. Accordion Function
    public function accordion()
    {
        $accordionData = [
            [
                'id' => 1,
                'title' => 'What is Laravel?',
                'content' => 'Laravel is a PHP web application framework with expressive, elegant syntax. It provides tools for routing, sessions, caching, and more.'
            ],
            [
                'id' => 2,
                'title' => 'How to install Laravel?',
                'content' => 'You can install Laravel via Composer by running: composer create-project laravel/laravel your-project-name'
            ],
            [
                'id' => 3,
                'title' => 'What are Blade templates?',
                'content' => 'Blade is Laravel\'s templating engine that allows you to use plain PHP code in your templates while providing powerful features like template inheritance.'
            ]
        ];

        return view('functions.accordion', compact('accordionData'));
    }

    // 2. Data Table Function
    public function dataTable()
    {
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'Admin', 'created_at' => '2024-01-15'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'User', 'created_at' => '2024-01-16'],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'role' => 'Editor', 'created_at' => '2024-01-17'],
            ['id' => 4, 'name' => 'Alice Brown', 'email' => 'alice@example.com', 'role' => 'User', 'created_at' => '2024-01-18'],
            ['id' => 5, 'name' => 'Charlie Wilson', 'email' => 'charlie@example.com', 'role' => 'Admin', 'created_at' => '2024-01-19'],
        ];

        return view('functions.data-table', compact('users'));
    }

    // 3. Advanced Filter Function
    public function advancedFilter()
    {
        $products = [
            ['id' => 1, 'name' => 'iPhone 15', 'category' => 'Electronics', 'price' => 999, 'brand' => 'Apple', 'rating' => 4.5],
            ['id' => 2, 'name' => 'Samsung Galaxy S24', 'category' => 'Electronics', 'price' => 899, 'brand' => 'Samsung', 'rating' => 4.3],
            ['id' => 3, 'name' => 'MacBook Pro', 'category' => 'Computers', 'price' => 1999, 'brand' => 'Apple', 'rating' => 4.7],
            ['id' => 4, 'name' => 'Dell XPS 13', 'category' => 'Computers', 'price' => 1299, 'brand' => 'Dell', 'rating' => 4.2],
            ['id' => 5, 'name' => 'Nike Air Max', 'category' => 'Shoes', 'price' => 150, 'brand' => 'Nike', 'rating' => 4.1],
            ['id' => 6, 'name' => 'Adidas Ultra Boost', 'category' => 'Shoes', 'price' => 180, 'brand' => 'Adidas', 'rating' => 4.4],
        ];

        $categories = array_unique(array_column($products, 'category'));
        $brands = array_unique(array_column($products, 'brand'));

        return view('functions.advanced-filter', compact('products', 'categories', 'brands'));
    }

    // 4. Modal Function
    public function modal()
    {
        $items = [
            ['id' => 1, 'title' => 'Product 1', 'description' => 'This is the first product with detailed information.'],
            ['id' => 2, 'title' => 'Product 2', 'description' => 'This is the second product with more details.'],
            ['id' => 3, 'title' => 'Product 3', 'description' => 'This is the third product with comprehensive details.'],
        ];

        return view('functions.modal', compact('items'));
    }

    // 5. Form Validation Function
    public function formValidation()
    {
        return view('functions.form-validation');
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'age' => 'required|integer|min:18|max:100',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted',
        ]);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }

    // 6. Pagination Function
    public function pagination()
    {
        $allItems = [];
        for ($i = 1; $i <= 100; $i++) {
            $allItems[] = [
                'id' => $i,
                'title' => 'Item ' . $i,
                'description' => 'This is item number ' . $i . ' with some description.',
                'created_at' => now()->subDays(rand(1, 30))->format('Y-m-d'),
            ];
        }

        $currentPage = request()->get('page', 1);
        $perPage = 10;
        $total = count($allItems);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($allItems, $offset, $perPage);

        $pagination = [
            'current_page' => $currentPage,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => ceil($total / $perPage),
            'from' => $offset + 1,
            'to' => min($offset + $perPage, $total),
        ];

        return view('functions.pagination', compact('items', 'pagination'));
    }

    // 7. Search Function
    public function search()
    {
        $query = request()->get('q');
        $allUsers = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'department' => 'IT'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'department' => 'HR'],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'department' => 'Finance'],
            ['id' => 4, 'name' => 'Alice Brown', 'email' => 'alice@example.com', 'department' => 'Marketing'],
            ['id' => 5, 'name' => 'Charlie Wilson', 'email' => 'charlie@example.com', 'department' => 'IT'],
            ['id' => 6, 'name' => 'Diana Prince', 'email' => 'diana@example.com', 'department' => 'HR'],
        ];

        $users = $allUsers;
        if ($query) {
            $users = array_filter($allUsers, function($user) use ($query) {
                return stripos($user['name'], $query) !== false ||
                       stripos($user['email'], $query) !== false ||
                       stripos($user['department'], $query) !== false;
            });
        }

        return view('functions.search', compact('users', 'query'));
    }

    // 8. Tabs Function
    public function tabs()
    {
        $tabsData = [
            'profile' => [
                'title' => 'Profile',
                'content' => 'This is the profile tab content with user information.'
            ],
            'settings' => [
                'title' => 'Settings',
                'content' => 'This is the settings tab content with configuration options.'
            ],
            'notifications' => [
                'title' => 'Notifications',
                'content' => 'This is the notifications tab content with alerts and messages.'
            ],
            'security' => [
                'title' => 'Security',
                'content' => 'This is the security tab content with password and authentication settings.'
            ]
        ];

        return view('functions.tabs', compact('tabsData'));
    }

    // 9. Image Gallery Function
    public function imageGallery()
    {
        $images = [
            ['id' => 1, 'src' => 'https://picsum.photos/300/200?random=1', 'alt' => 'Random Image 1', 'title' => 'Beautiful Landscape'],
            ['id' => 2, 'src' => 'https://picsum.photos/300/200?random=2', 'alt' => 'Random Image 2', 'title' => 'City Architecture'],
            ['id' => 3, 'src' => 'https://picsum.photos/300/200?random=3', 'alt' => 'Random Image 3', 'title' => 'Nature Photography'],
            ['id' => 4, 'src' => 'https://picsum.photos/300/200?random=4', 'alt' => 'Random Image 4', 'title' => 'Modern Design'],
            ['id' => 5, 'src' => 'https://picsum.photos/300/200?random=5', 'alt' => 'Random Image 5', 'title' => 'Abstract Art'],
            ['id' => 6, 'src' => 'https://picsum.photos/300/200?random=6', 'alt' => 'Random Image 6', 'title' => 'Technology'],
        ];

        return view('functions.image-gallery', compact('images'));
    }

    // 10. Dashboard Function
    public function dashboard()
    {
        $dashboardData = [
            'stats' => [
                'total_users' => 1250,
                'total_orders' => 890,
                'total_revenue' => 45600,
                'pending_tasks' => 23
            ],
            'recent_orders' => [
                ['id' => 1, 'customer' => 'John Doe', 'amount' => 299.99, 'status' => 'Completed'],
                ['id' => 2, 'customer' => 'Jane Smith', 'amount' => 199.50, 'status' => 'Processing'],
                ['id' => 3, 'customer' => 'Bob Johnson', 'amount' => 499.00, 'status' => 'Pending'],
            ],
            'chart_data' => [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                'data' => [12, 19, 3, 5, 2, 3]
            ]
        ];

        return view('functions.dashboard', compact('dashboardData'));
    }

    // Additional 10 useful functions
    public function fileUpload()
    {
        return view('functions.file-upload');
    }

    public function infiniteScroll()
    {
        return view('functions.infinite-scroll');
    }

    public function dragDrop()
    {
        return view('functions.drag-drop');
    }

    public function chart()
    {
        return view('functions.chart');
    }

    public function calendar()
    {
        return view('functions.calendar');
    }

    public function notification()
    {
        return view('functions.notification');
    }

    public function exportData()
    {
        return view('functions.export-data');
    }

    public function qrCode()
    {
        return view('functions.qr-code');
    }

    public function breadcrumb()
    {
        return view('functions.breadcrumb');
    }

    public function darkMode()
    {
        return view('functions.dark-mode');
    }

    // Additional 5 more useful functions
    public function multiStepForm()
    {
        return view('functions.multi-step-form');
    }

    public function realTimeChat()
    {
        return view('functions.real-time-chat');
    }

    public function imageEditor()
    {
        return view('functions.image-editor');
    }

    public function apiTesting()
    {
        return view('functions.api-testing');
    }

    public function progressTracker()
    {
        return view('functions.progress-tracker');
    }

    // Missing function methods
    public function tooltip()
    {
        return view('functions.tooltip');
    }

    public function calculator()
    {
        return view('functions.calculator');
    }

    public function qrGenerator()
    {
        return view('functions.qr-generator');
    }

    public function colorPicker()
    {
        return view('functions.color-picker');
    }

    public function cardDesigns()
    {
        $cardData = [
            [
                'title' => 'Product Card',
                'subtitle' => 'Featured Item',
                'description' => 'This is a sample product card with image and description.',
                'image' => 'https://picsum.photos/300/200?random=1',
                'price' => '$99.99',
                'badge' => 'New',
                'rating' => 4.5,
                'tags' => ['Popular', 'Trending']
            ],
            [
                'title' => 'Service Card',
                'subtitle' => 'Premium Service',
                'description' => 'Professional service offering with detailed information.',
                'image' => 'https://picsum.photos/300/200?random=2',
                'price' => '$199.99',
                'badge' => 'Best Seller',
                'rating' => 4.8,
                'tags' => ['Professional', 'Quality']
            ],
            [
                'title' => 'Portfolio Card',
                'subtitle' => 'Creative Work',
                'description' => 'Showcase your creative work with this portfolio card.',
                'image' => 'https://picsum.photos/300/200?random=3',
                'price' => 'Free',
                'badge' => 'Featured',
                'rating' => 4.2,
                'tags' => ['Creative', 'Design']
            ]
        ];

        return view('functions.card-designs', compact('cardData'));
    }

    // Container utility functions
    public function containerLayouts()
    {
        return view('functions.container-layouts');
    }

    public function flexboxContainer()
    {
        return view('functions.flexbox-container');
    }

    public function gridContainer()
    {
        return view('functions.grid-container');
    }

    public function responsiveContainer()
    {
        return view('functions.responsive-container');
    }

    // Table utility functions
    public function advancedTable()
    {
        $tableData = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'department' => 'IT', 'salary' => 75000, 'hire_date' => '2020-01-15', 'status' => 'Active'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'department' => 'HR', 'salary' => 68000, 'hire_date' => '2021-03-22', 'status' => 'Active'],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'department' => 'Finance', 'salary' => 82000, 'hire_date' => '2019-11-10', 'status' => 'Active'],
            ['id' => 4, 'name' => 'Alice Brown', 'email' => 'alice@example.com', 'department' => 'Marketing', 'salary' => 71000, 'hire_date' => '2022-05-08', 'status' => 'Inactive'],
            ['id' => 5, 'name' => 'Charlie Wilson', 'email' => 'charlie@example.com', 'department' => 'IT', 'salary' => 79000, 'hire_date' => '2021-09-12', 'status' => 'Active'],
            ['id' => 6, 'name' => 'Diana Prince', 'email' => 'diana@example.com', 'department' => 'HR', 'salary' => 73000, 'hire_date' => '2020-07-30', 'status' => 'Active'],
            ['id' => 7, 'name' => 'Edward Davis', 'email' => 'edward@example.com', 'department' => 'Finance', 'salary' => 85000, 'hire_date' => '2018-12-01', 'status' => 'Active'],
            ['id' => 8, 'name' => 'Fiona Green', 'email' => 'fiona@example.com', 'department' => 'Marketing', 'salary' => 69000, 'hire_date' => '2023-02-14', 'status' => 'Active'],
        ];

        return view('functions.advanced-table', compact('tableData'));
    }

    public function editableTable()
    {
        $editableData = [
            ['id' => 1, 'product' => 'Laptop', 'price' => 999, 'quantity' => 10, 'category' => 'Electronics'],
            ['id' => 2, 'product' => 'Mouse', 'price' => 25, 'quantity' => 50, 'category' => 'Electronics'],
            ['id' => 3, 'product' => 'Book', 'price' => 15, 'quantity' => 100, 'category' => 'Education'],
            ['id' => 4, 'product' => 'Pen', 'price' => 2, 'quantity' => 200, 'category' => 'Office'],
            ['id' => 5, 'product' => 'Chair', 'price' => 150, 'quantity' => 25, 'category' => 'Furniture'],
        ];

        return view('functions.editable-table', compact('editableData'));
    }

    public function comparisionTable()
    {
        $plans = [
            [
                'name' => 'Basic',
                'price' => 9.99,
                'features' => [
                    'storage' => '10GB',
                    'bandwidth' => '100GB',
                    'email' => '5 accounts',
                    'support' => 'Email',
                    'ssl' => true,
                    'backup' => false,
                    'analytics' => false
                ]
            ],
            [
                'name' => 'Professional',
                'price' => 19.99,
                'features' => [
                    'storage' => '50GB',
                    'bandwidth' => '500GB',
                    'email' => '25 accounts',
                    'support' => 'Email & Chat',
                    'ssl' => true,
                    'backup' => true,
                    'analytics' => true
                ]
            ],
            [
                'name' => 'Enterprise',
                'price' => 49.99,
                'features' => [
                    'storage' => 'Unlimited',
                    'bandwidth' => 'Unlimited',
                    'email' => 'Unlimited',
                    'support' => '24/7 Phone',
                    'ssl' => true,
                    'backup' => true,
                    'analytics' => true
                ]
            ]
        ];

        return view('functions.comparison-table', compact('plans'));
    }

    // Main index function to list all functions
    public function index()
    {
        $functions = [
            ['name' => 'Accordion', 'route' => 'functions.accordion', 'description' => 'Expandable accordion component'],
            ['name' => 'Data Table', 'route' => 'functions.data-table', 'description' => 'Sortable data table with actions'],
            ['name' => 'Advanced Filter', 'route' => 'functions.advanced-filter', 'description' => 'Multi-criteria filtering system'],
            ['name' => 'Modal', 'route' => 'functions.modal', 'description' => 'Modal dialog boxes'],
            ['name' => 'Form Validation', 'route' => 'functions.form-validation', 'description' => 'Client and server-side validation'],
            ['name' => 'Pagination', 'route' => 'functions.pagination', 'description' => 'Custom pagination component'],
            ['name' => 'Search', 'route' => 'functions.search', 'description' => 'Real-time search functionality'],
            ['name' => 'Tabs', 'route' => 'functions.tabs', 'description' => 'Tabbed interface component'],
            ['name' => 'Image Gallery', 'route' => 'functions.image-gallery', 'description' => 'Responsive image gallery'],
            ['name' => 'Dashboard', 'route' => 'functions.dashboard', 'description' => 'Complete dashboard layout'],
            // Additional 10 useful functions
            ['name' => 'File Upload', 'route' => 'functions.file-upload', 'description' => 'Drag & drop file upload with preview'],
            ['name' => 'Infinite Scroll', 'route' => 'functions.infinite-scroll', 'description' => 'Load more content as you scroll'],
            ['name' => 'Drag & Drop', 'route' => 'functions.drag-drop', 'description' => 'Sortable list with drag and drop'],
            ['name' => 'Chart', 'route' => 'functions.chart', 'description' => 'Interactive charts and graphs'],
            ['name' => 'Calendar', 'route' => 'functions.calendar', 'description' => 'Interactive calendar with events'],
            ['name' => 'Notification', 'route' => 'functions.notification', 'description' => 'Toast notifications system'],
            ['name' => 'Export Data', 'route' => 'functions.export-data', 'description' => 'Export table data to CSV/PDF'],
            ['name' => 'QR Code', 'route' => 'functions.qr-code', 'description' => 'Generate and scan QR codes'],
            ['name' => 'Breadcrumb', 'route' => 'functions.breadcrumb', 'description' => 'Navigation breadcrumb component'],
            ['name' => 'Dark Mode', 'route' => 'functions.dark-mode', 'description' => 'Toggle between light and dark theme'],
            // Additional 5 more useful functions
            ['name' => 'Multi-Step Form', 'route' => 'functions.multi-step-form', 'description' => 'Progressive form with multiple steps'],
            ['name' => 'Real-Time Chat', 'route' => 'functions.real-time-chat', 'description' => 'Chat application with WebSocket'],
            ['name' => 'Image Editor', 'route' => 'functions.image-editor', 'description' => 'Online image editing tool'],
            ['name' => 'API Testing', 'route' => 'functions.api-testing', 'description' => 'Test and debug APIs'],
            ['name' => 'Progress Tracker', 'route' => 'functions.progress-tracker', 'description' => 'Track progress of tasks and projects'],
            ['name' => 'Tooltip', 'route' => 'functions.tooltip', 'description' => 'Display informative text when hovering over an element'],
            ['name' => 'Calculator', 'route' => 'functions.calculator', 'description' => 'Basic calculator functionality'],
            ['name' => 'QR Generator', 'route' => 'functions.qr-generator', 'description' => 'Generate QR codes for URLs and text'],
            ['name' => 'Color Picker', 'route' => 'functions.color-picker', 'description' => 'Select and customize colors'],
            ['name' => 'Card Designs', 'route' => 'functions.card-designs', 'description' => 'Various card layout designs and styles'],
            ['name' => 'Container Layouts', 'route' => 'functions.container-layouts', 'description' => 'Various container layout examples'],
            ['name' => 'Flexbox Container', 'route' => 'functions.flexbox-container', 'description' => 'Responsive flexbox container'],
            ['name' => 'Grid Container', 'route' => 'functions.grid-container', 'description' => 'CSS grid layout examples'],
            ['name' => 'Responsive Container', 'route' => 'functions.responsive-container', 'description' => 'Containers that adapt to screen size'],
            ['name' => 'Advanced Table', 'route' => 'functions.advanced-table', 'description' => 'Table with advanced features and functionalities'],
            ['name' => 'Editable Table', 'route' => 'functions.editable-table', 'description' => 'Tables that can be edited inline'],
            ['name' => 'Comparison Table', 'route' => 'functions.comparison-table', 'description' => 'Compare different items or plans'],
        ];

        return view('functions.index', compact('functions'));
    }

    // Demo method to show notifications
    public function demoNotifications()
    {
        // Using the helper functions
        notify_success('This is a success notification!');
        notify_error('This is an error notification!');
        notify_warning('This is a warning notification!');
        notify_info('This is an info notification!');

        return redirect()->route('functions.index');
    }

    // Demo method to show validation notifications
    public function demoValidation(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|numeric'
        ]);

        notify_success('Form submitted successfully!');
        return redirect()->back();
    }
}
