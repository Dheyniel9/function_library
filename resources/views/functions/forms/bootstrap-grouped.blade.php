{{-- Bootstrap 4 Grouped Form Structure for Laravel --}}
{{-- Self-contained reusable component with Bootstrap 4 and vanilla JavaScript --}}

<div id="bootstrap-grouped-form" class="bootstrap-form-container">
    <style>
        /* Self-contained Bootstrap 4 form styling */
        .bootstrap-form-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: 0 auto;
        }

        .bootstrap-form-container .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px 12px;
            font-size: 14px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .bootstrap-form-container .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .bootstrap-form-container .form-control.is-valid {
            border-color: #28a745;
        }

        .bootstrap-form-container .form-control.is-invalid {
            border-color: #dc3545;
        }

        .bootstrap-form-container .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .bootstrap-form-container .submit-btn {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.3s ease;
            color: white;
            width: 100%;
        }

        .bootstrap-form-container .submit-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .bootstrap-form-container .submit-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .bootstrap-form-container .form-group {
            margin-bottom: 20px;
        }

        .bootstrap-form-container .form-group label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
            display: block;
        }

        .bootstrap-form-container .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #007bff;
            border-color: #007bff;
        }

        .bootstrap-form-container fieldset {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .bootstrap-form-container legend {
            color: #495057;
            font-weight: 600;
            font-size: 1.1rem;
            width: auto;
            padding: 0 10px;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .bootstrap-form-container fieldset {
                padding: 15px;
            }
        }
    </style>

    <form method="POST" action="{{ route('functions.submit-form') }}" id="groupedForm" novalidate>
        @csrf

        <!-- Display Laravel validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h4 class="mb-4 text-center">Grouped Form</h4>

        <!-- Personal Information Group -->
        <fieldset>
            <legend>Personal Information</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
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
                </div>

                <div class="col-md-6">
                    <div class="form-group">
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
                </div>
            </div>
        </fieldset>

        <!-- Contact Information Group -->
        <fieldset>
            <legend>Contact Information</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
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
                </div>

                <div class="col-md-6">
                    <div class="form-group">
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
            </div>
        </fieldset>

        <!-- Security Group -->
        <fieldset>
            <legend>Security</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
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
                </div>

                <div class="col-md-6">
                    <div class="form-group">
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
            </div>

            <div class="form-group">
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
        </fieldset>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit"
                    class="btn submit-btn"
                    id="submitBtn"
                    disabled>
                Submit Form
            </button>
        </div>
    </form>

    <script>
        // Grouped Form Validator
        (function() {
            'use strict';

            class GroupedFormValidator {
                constructor() {
                    this.form = document.getElementById('groupedForm');
                    this.submitBtn = document.getElementById('submitBtn');
                    this.errors = {};

                    if (this.form) {
                        this.init();
                    }
                }

                init() {
                    this.form.addEventListener('submit', (e) => this.handleSubmit(e));

                    const inputs = this.form.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.addEventListener('blur', () => this.validateField(input));
                        input.addEventListener('input', () => this.updateSubmitButton());
                        input.addEventListener('change', () => this.updateSubmitButton());
                    });

                    this.updateSubmitButton();
                }

                validateField(field) {
                    const fieldName = field.name;
                    const value = field.value.trim();
                    let error = '';

                    delete this.errors[fieldName];

                    if (field.classList.contains('is-invalid') && field.parentNode.querySelector('.invalid-feedback').textContent.trim()) {
                        return;
                    }

                    if (field.required && !value && field.type !== 'checkbox') {
                        error = `${this.getFieldLabel(field)} is required.`;
                    } else if (field.required && field.type === 'checkbox' && !field.checked) {
                        error = `You must agree to the terms and conditions.`;
                    }

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
                                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                                    error = 'Please enter a valid email address.';
                                }
                                break;

                            case 'phone':
                                if (!/^[\+]?[0-9\s\-\(\)]{10,}$/.test(value)) {
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
                    const feedback = field.parentNode.querySelector('.invalid-feedback') ||
                                   field.closest('.form-group').querySelector('.invalid-feedback');
                    if (feedback) {
                        feedback.textContent = message;
                    }
                }

                clearFieldError(field) {
                    field.classList.remove('is-invalid');
                    if (field.value.trim() || field.checked) {
                        field.classList.add('is-valid');
                    }
                    const feedback = field.parentNode.querySelector('.invalid-feedback') ||
                                   field.closest('.form-group').querySelector('.invalid-feedback');
                    if (feedback && !feedback.textContent.trim()) {
                        feedback.textContent = '';
                    }
                }

                getFieldLabel(field) {
                    const label = field.parentNode.querySelector('label') ||
                                 field.closest('.form-group').querySelector('label');
                    return label ? label.textContent.trim() : field.name;
                }

                isFormValid() {
                    if (Object.keys(this.errors).length > 0) {
                        return false;
                    }

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
                    } else {
                        this.submitBtn.disabled = true;
                    }
                }

                handleSubmit(e) {
                    const inputs = this.form.querySelectorAll('input');
                    inputs.forEach(input => this.validateField(input));

                    if (!this.isFormValid()) {
                        e.preventDefault();
                        return false;
                    }

                    return true;
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                new GroupedFormValidator();
            });
        })();
    </script>
</div>
