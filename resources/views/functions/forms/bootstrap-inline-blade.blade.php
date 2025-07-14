{{-- Bootstrap 4 Inline Form Structure for Laravel --}}
{{-- Self-contained reusable component with Bootstrap 4 and vanilla JavaScript --}}

<div id="form-inline" class="form-structure">
    <style>
        /* Inline styles for self-contained component */
        .bootstrap-inline-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .bootstrap-inline-form .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px 12px;
            font-size: 14px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .bootstrap-inline-form .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .bootstrap-inline-form .form-control.is-valid {
            border-color: #28a745;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='m2.3 6.73.5.64c.25.33.6.43.9.25l4.3-2.8c.3-.18.4-.5.2-.8-.18-.3-.5-.4-.8-.2l-3.9 2.6-1.9-2.1c-.25-.3-.6-.35-.9-.1-.3.25-.35.6-.1.9l.8 1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .bootstrap-inline-form .form-control.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .bootstrap-inline-form .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .bootstrap-inline-form .submit-btn {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.3s ease;
            color: white;
        }

        .bootstrap-inline-form .submit-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .bootstrap-inline-form .submit-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .bootstrap-inline-form .form-group label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 5px;
        }

        .bootstrap-inline-form .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #007bff;
            border-color: #007bff;
        }

        @media (max-width: 768px) {
            .bootstrap-inline-form .submit-btn {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>

    <div class="bootstrap-inline-form">
        <form method="POST" action="{{ route('functions.submit-form') }}" id="bootstrapInlineForm" novalidate>
            @csrf

            <!-- Display Laravel validation errors if any -->
            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display success message -->
            @if (session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Row 1: Basic Information -->
            <div class="form-row mb-3">
                <div class="form-group col-md-4">
                    <label for="name">Full Name</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="email">Email Address</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="phone">Phone Number</label>
                    <input type="tel"
                           class="form-control @error('phone') is-invalid @enderror"
                           id="phone"
                           name="phone"
                           value="{{ old('phone') }}"
                           required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @enderror
                </div>
            </div>

            <!-- Row 2: Additional Information -->
            <div class="form-row mb-3">
                <div class="form-group col-md-4">
                    <label for="age">Age</label>
                    <input type="number"
                           class="form-control @error('age') is-invalid @enderror"
                           id="age"
                           name="age"
                           value="{{ old('age') }}"
                           min="18"
                           max="100"
                           required>
                    @error('age')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="password">Password</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           id="password_confirmation"
                           name="password_confirmation"
                           required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @enderror
                </div>
            </div>

            <!-- Terms and Submit Row -->
            <div class="form-row align-items-center">
                <div class="form-group col-md-8">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                               class="custom-control-input @error('terms') is-invalid @enderror"
                               id="terms"
                               name="terms"
                               {{ old('terms') ? 'checked' : '' }}
                               required>
                        <label class="custom-control-label" for="terms">
                            I agree to the <a href="#" class="text-primary">Terms and Conditions</a>
                        </label>
                        @error('terms')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback"></div>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-4 text-right">
                    <button type="submit"
                            class="btn submit-btn"
                            id="submitBtn"
                            disabled>
                        Submit Form
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Vanilla JavaScript for Bootstrap Inline Form Validation
        (function() {
            'use strict';

            class BootstrapInlineFormValidator {
                constructor() {
                    this.form = document.getElementById('bootstrapInlineForm');
                    this.submitBtn = document.getElementById('submitBtn');
                    this.errors = {};
                    this.formData = {};

                    if (this.form) {
                        this.init();
                    }
                }

                init() {
                    // Add event listeners
                    this.form.addEventListener('submit', (e) => this.handleSubmit(e));

                    // Add blur and input event listeners for real-time validation
                    const inputs = this.form.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.addEventListener('blur', () => this.validateField(input));
                        input.addEventListener('input', () => this.updateFormData(input));
                        input.addEventListener('change', () => this.updateFormData(input));
                    });

                    // Initial form data setup
                    this.updateAllFormData();
                }

                validateField(field) {
                    const fieldName = field.name;
                    const value = field.value.trim();
                    let error = '';

                    // Clear previous error
                    delete this.errors[fieldName];

                    // Skip validation if field has server-side error
                    if (field.classList.contains('is-invalid') && field.parentNode.querySelector('.invalid-feedback').textContent.trim()) {
                        return;
                    }

                    // Required field validation
                    if (field.required && !value && field.type !== 'checkbox') {
                        error = `${this.getFieldLabel(field)} is required.`;
                    } else if (field.required && field.type === 'checkbox' && !field.checked) {
                        error = `You must agree to the terms and conditions.`;
                    }

                    // Specific field validations
                    if (value && !error) {
                        switch (fieldName) {
                            case 'name':
                                if (value.length < 2) {
                                    error = 'Full name must be at least 2 characters long.';
                                } else if (!/^[a-zA-Z\s]+$/.test(value)) {
                                    error = 'Full name can only contain letters and spaces.';
                                }
                                break;

                            case 'email':
                                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                if (!emailRegex.test(value)) {
                                    error = 'Please enter a valid email address.';
                                }
                                break;

                            case 'phone':
                                const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
                                if (!phoneRegex.test(value)) {
                                    error = 'Please enter a valid phone number.';
                                }
                                break;

                            case 'age':
                                const age = parseInt(value);
                                if (age < 18 || age > 100) {
                                    error = 'Age must be between 18 and 100.';
                                }
                                break;

                            case 'password':
                                if (value.length < 8) {
                                    error = 'Password must be at least 8 characters long.';
                                } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(value)) {
                                    error = 'Password must contain at least one uppercase letter, one lowercase letter, and one number.';
                                }
                                break;

                            case 'password_confirmation':
                                const password = this.form.querySelector('[name="password"]').value;
                                if (value !== password) {
                                    error = 'Passwords do not match.';
                                }
                                break;
                        }
                    }

                    // Update error state
                    if (error) {
                        this.errors[fieldName] = error;
                        this.showFieldError(field, error);
                    } else {
                        this.clearFieldError(field);
                    }

                    this.updateSubmitButton();
                }

                showFieldError(field, message) {
                    field.classList.remove('is-valid');
                    field.classList.add('is-invalid');
                    const feedback = field.parentNode.querySelector('.invalid-feedback');
                    if (feedback) {
                        feedback.textContent = message;
                    }
                }

                clearFieldError(field) {
                    field.classList.remove('is-invalid');
                    if (field.value.trim() || field.checked) {
                        field.classList.add('is-valid');
                    }
                    const feedback = field.parentNode.querySelector('.invalid-feedback');
                    if (feedback && !feedback.textContent.trim()) {
                        feedback.textContent = '';
                    }
                }

                getFieldLabel(field) {
                    const label = field.parentNode.querySelector('label') ||
                                 field.closest('.form-group').querySelector('label');
                    return label ? label.textContent.replace('*', '').trim() : field.name;
                }

                updateFormData(field) {
                    if (field.type === 'checkbox') {
                        this.formData[field.name] = field.checked;
                    } else {
                        this.formData[field.name] = field.value.trim();
                    }
                    this.updateSubmitButton();
                }

                updateAllFormData() {
                    const inputs = this.form.querySelectorAll('input');
                    inputs.forEach(input => this.updateFormData(input));
                }

                isFormValid() {
                    // Check if there are any client-side errors
                    if (Object.keys(this.errors).length > 0) {
                        return false;
                    }

                    // Check if all required fields are filled
                    const requiredFields = this.form.querySelectorAll('input[required]');
                    for (let field of requiredFields) {
                        if (field.type === 'checkbox' && !field.checked) {
                            return false;
                        } else if (field.type !== 'checkbox' && !field.value.trim()) {
                            return false;
                        }
                    }

                    return true;
                }

                updateSubmitButton() {
                    if (this.isFormValid()) {
                        this.submitBtn.disabled = false;
                        this.submitBtn.classList.remove('btn-secondary');
                        this.submitBtn.classList.add('btn-primary');
                    } else {
                        this.submitBtn.disabled = true;
                        this.submitBtn.classList.remove('btn-primary');
                        this.submitBtn.classList.add('btn-secondary');
                    }
                }

                handleSubmit(e) {
                    // Validate all fields before submission
                    const inputs = this.form.querySelectorAll('input');
                    inputs.forEach(input => this.validateField(input));

                    if (!this.isFormValid()) {
                        e.preventDefault();
                        this.showErrorMessage();
                        return false;
                    }

                    // Form is valid, let Laravel handle the submission
                    return true;
                }

                showErrorMessage() {
                    const alertHtml = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> Please fix the errors below and try again.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `;

                    // Remove existing alerts
                    const existingAlerts = this.form.querySelectorAll('.alert');
                    existingAlerts.forEach(alert => alert.remove());

                    this.form.insertAdjacentHTML('afterbegin', alertHtml);

                    // Scroll to top
                    this.form.scrollIntoView({ behavior: 'smooth' });
                }
            }

            // Initialize form validator when DOM is loaded
            document.addEventListener('DOMContentLoaded', function() {
                new BootstrapInlineFormValidator();
            });
        })();
    </script>
</div>
