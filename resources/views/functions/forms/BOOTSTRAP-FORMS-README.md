# Bootstrap 4 Laravel Form Components

This directory contains reusable Laravel Blade components that use Bootstrap 4 and vanilla JavaScript for form validation. All components are self-contained and can be easily copied into any Laravel project.

## Available Components

### 1. Single Column Form (`bootstrap-single-column.blade.php`)
- **Layout**: Vertical single column layout
- **Fields**: Name, Email, Phone, Age, Password, Password Confirmation, Terms
- **Features**: Real-time validation, Laravel integration, responsive design
- **Usage**:
  ```blade
  @include('functions.forms.bootstrap-single-column')
  ```

### 2. Two Column Form (`bootstrap-two-column.blade.php`)
- **Layout**: Two column responsive layout
- **Fields**: Split across left and right columns
- **Features**: Responsive design that stacks on mobile
- **Usage**:
  ```blade
  @include('functions.forms.bootstrap-two-column')
  ```

### 3. Grouped Form (`bootstrap-grouped.blade.php`)
- **Layout**: Fieldsets with grouped sections
- **Groups**: Personal Info, Contact Info, Security
- **Features**: Organized sections with legends
- **Usage**:
  ```blade
  @include('functions.forms.bootstrap-grouped')
  ```

### 4. Stepped Form (`bootstrap-stepped.blade.php`)
- **Layout**: Multi-step wizard interface
- **Steps**: Personal Info → Account Details → Confirmation
- **Features**: Progress indicators, step validation, navigation
- **Usage**:
  ```blade
  @include('functions.forms.bootstrap-stepped')
  ```

### 5. Inline Form (`bootstrap-inline-blade.blade.php`)
- **Layout**: Horizontal inline fields
- **Fields**: 3 columns per row on desktop
- **Features**: Compact layout, responsive design
- **Usage**:
  ```blade
  @include('functions.forms.bootstrap-inline-blade')
  ```

## Key Features

### 🎯 **Laravel Integration**
- **CSRF Protection**: All forms include `@csrf` tokens
- **Route Integration**: Uses `route('functions.submit-form')`
- **Validation**: Server-side validation with `@error` directives
- **Old Input**: Repopulates form data with `old()` helper
- **Flash Messages**: Displays success/error messages

### 🎨 **Bootstrap 4 Design**
- **Responsive Grid**: Uses Bootstrap's grid system
- **Form Controls**: Proper Bootstrap form styling
- **Validation Classes**: `is-valid` and `is-invalid` states
- **Custom Components**: Styled checkboxes and buttons
- **Professional UI**: Modern gradient buttons and styling

### ⚡ **Vanilla JavaScript Validation**
- **Real-time Validation**: Validates fields on blur
- **Client-side Rules**: Comprehensive validation patterns
- **Form State Management**: Enables/disables submit button
- **Error Display**: Shows validation messages inline
- **No Dependencies**: Pure JavaScript, no external libraries

## Validation Rules

### Field Validation
- **Name**: Required, min 2 characters, letters and spaces only
- **Email**: Required, valid email format
- **Phone**: Required, 10+ digits, international format supported
- **Age**: Required, between 18-100
- **Password**: Required, min 8 characters, must contain uppercase, lowercase, and number
- **Password Confirmation**: Must match password
- **Terms**: Required checkbox

### Form Validation
- **Client-side**: Immediate feedback on field blur
- **Server-side**: Laravel validation rules
- **Dual Protection**: Security through server validation, UX through client validation

## Installation & Setup

### 1. Copy Forms
Copy any of the form files to your Laravel project:
```bash
cp bootstrap-single-column.blade.php resources/views/your-path/
```

### 2. Update Routes
Add a route for form submission:
```php
Route::post('/submit-form', [YourController::class, 'submitForm'])->name('functions.submit-form');
```

### 3. Controller Method
Create a controller method to handle form submission:
```php
public function submitForm(Request $request)
{
    $request->validate([
        'name' => 'required|string|min:2|max:255',
        'email' => 'required|email|unique:users',
        'phone' => 'required|string|min:10',
        'age' => 'required|integer|min:18|max:100',
        'password' => 'required|string|min:8|confirmed',
        'terms' => 'required|accepted',
    ]);

    // Process form data
    // ...

    return redirect()->back()->with('success', 'Form submitted successfully!');
}
```

### 4. Include Bootstrap 4
Make sure Bootstrap 4 is included in your layout:
```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
```

## Customization

### Styling
Each form contains inline CSS that can be customized:
- **Colors**: Update gradient colors and theme colors
- **Spacing**: Modify padding and margins
- **Typography**: Change font weights and sizes
- **Responsive**: Adjust breakpoints and mobile styles

### Validation Rules
Modify the JavaScript validation in each form:
```javascript
case 'email':
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
        error = 'Please enter a valid email address.';
    }
    break;
```

### Fields
Add or remove fields by:
1. Adding HTML form elements
2. Adding validation rules in JavaScript
3. Updating Laravel validation rules

## Browser Support

- **Modern Browsers**: Chrome, Firefox, Safari, Edge
- **JavaScript**: ES6+ features used
- **CSS**: Modern CSS properties with fallbacks
- **Bootstrap 4**: Full compatibility

## Security Notes

- **CSRF Protection**: All forms include CSRF tokens
- **Server Validation**: Never rely solely on client-side validation
- **XSS Prevention**: Use Laravel's built-in XSS protection
- **Input Sanitization**: Validate and sanitize all inputs

## Performance

- **Lightweight**: No external JavaScript dependencies
- **Efficient**: Event delegation for better performance
- **Minimal**: Only necessary CSS and JavaScript included
- **Cached**: Styles and scripts are inline for better caching

## Troubleshooting

### Common Issues
1. **Form not submitting**: Check route name matches
2. **Validation not working**: Ensure JavaScript is loading
3. **Styling issues**: Verify Bootstrap 4 is included
4. **CSRF errors**: Ensure `@csrf` is present

### Debug Mode
Add console logging to JavaScript for debugging:
```javascript
console.log('Form validation:', this.errors);
```

## License

These components are provided as-is for educational and development purposes. Feel free to modify and use in your projects.

## Contributing

To contribute improvements:
1. Test thoroughly with different browsers
2. Maintain Laravel compatibility
3. Keep Bootstrap 4 standards
4. Document any changes

---

**Note**: These forms are designed to be self-contained and easy to copy-paste into any Laravel project. Each form includes all necessary CSS and JavaScript inline for maximum portability.
