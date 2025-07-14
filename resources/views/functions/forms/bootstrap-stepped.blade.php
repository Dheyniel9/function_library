{{-- Bootstrap 4 Stepped Form Structure for Laravel --}}
{{-- Self-contained reusable component with Bootstrap 4 and vanilla JavaScript --}}

<div id="bootstrap-stepped-form" class="bootstrap-form-container">
    <style>
        /* Self-contained Bootstrap 4 form styling */
        .bootstrap-form-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 700px;
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

        .bootstrap-form-container .step-progress {
            margin-bottom: 30px;
        }

        .bootstrap-form-container .step-progress .step {
            display: inline-block;
            width: 30px;
            height: 30px;
            background: #e9ecef;
            border-radius: 50%;
            line-height: 30px;
            text-align: center;
            color: #6c757d;
            font-weight: 600;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .bootstrap-form-container .step-progress .step.active {
            background: #007bff;
            color: white;
        }

        .bootstrap-form-container .step-progress .step.completed {
            background: #28a745;
            color: white;
        }

        .bootstrap-form-container .step-content {
            min-height: 300px;
            padding: 20px 0;
        }

        .bootstrap-form-container .step-section {
            display: none;
        }

        .bootstrap-form-container .step-section.active {
            display: block;
        }

        .bootstrap-form-container .step-buttons {
            margin-top: 20px;
            text-align: center;
        }

        .bootstrap-form-container .step-buttons .btn {
            margin: 0 5px;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .bootstrap-form-container .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
        }

        .bootstrap-form-container .btn-primary:hover:not(:disabled) {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .bootstrap-form-container .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            border: none;
        }

        .bootstrap-form-container .btn-success:hover:not(:disabled) {
            background: linear-gradient(135deg, #1e7e34 0%, #155724 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .bootstrap-form-container .btn:disabled {
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

        .bootstrap-form-container .confirmation-item {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 10px 15px;
            margin-bottom: 10px;
        }

        .bootstrap-form-container .confirmation-item strong {
            color: #495057;
        }

        @media (max-width: 768px) {
            .bootstrap-form-container {
                padding: 20px;
            }

            .bootstrap-form-container .step-buttons .btn {
                display: block;
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>

    <form method="POST" action="{{ route('functions.submit-form') }}" id="steppedForm" novalidate>
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

        <h4 class="mb-4 text-center">Multi-Step Form</h4>

        <!-- Step Progress Indicator -->
        <div class="step-progress text-center">
            <span class="step active" id="step-indicator-1">1</span>
            <span class="step" id="step-indicator-2">2</span>
            <span class="step" id="step-indicator-3">3</span>
        </div>

        <!-- Step 1: Personal Information -->
        <div id="step-1" class="step-section active">
            <h5 class="mb-4">Step 1: Personal Information</h5>

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

            <div class="step-buttons">
                <button type="button" class="btn btn-primary" id="next-step-1" disabled>Next</button>
            </div>
        </div>

        <!-- Step 2: Account Details -->
        <div id="step-2" class="step-section">
            <h5 class="mb-4">Step 2: Account Details</h5>

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

            <div class="step-buttons">
                <button type="button" class="btn btn-secondary" id="prev-step-2">Previous</button>
                <button type="button" class="btn btn-primary" id="next-step-2" disabled>Next</button>
            </div>
        </div>

        <!-- Step 3: Confirmation -->
        <div id="step-3" class="step-section">
            <h5 class="mb-4">Step 3: Confirmation</h5>

            <div class="confirmation-item">
                <strong>Full Name:</strong> <span id="confirm-name"></span>
            </div>

            <div class="confirmation-item">
                <strong>Email:</strong> <span id="confirm-email"></span>
            </div>

            <div class="confirmation-item">
                <strong>Phone:</strong> <span id="confirm-phone"></span>
            </div>

            <div class="confirmation-item">
                <strong>Age:</strong> <span id="confirm-age"></span>
            </div>

            <div class="form-group mt-4">
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

            <div class="step-buttons">
                <button type="button" class="btn btn-secondary" id="prev-step-3">Previous</button>
                <button type="submit" class="btn btn-success" id="submit-form" disabled>Submit Form</button>
            </div>
        </div>
    </form>

    <script>
        // Stepped Form Validator
        (function() {
            'use strict';

            class SteppedFormValidator {
                constructor() {
                    this.form = document.getElementById('steppedForm');
                    this.currentStep = 1;
                    this.errors = {};

                    if (this.form) {
                        this.init();
                    }
                }

                init() {
                    this.form.addEventListener('submit', (e) => this.handleSubmit(e));

                    // Step navigation buttons
                    document.getElementById('next-step-1').addEventListener('click', () => this.nextStep());
                    document.getElementById('next-step-2').addEventListener('click', () => this.nextStep());
                    document.getElementById('prev-step-2').addEventListener('click', () => this.prevStep());
                    document.getElementById('prev-step-3').addEventListener('click', () => this.prevStep());

                    // Form validation
                    const inputs = this.form.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.addEventListener('blur', () => this.validateField(input));
                        input.addEventListener('input', () => this.updateStepButton());
                        input.addEventListener('change', () => this.updateStepButton());
                    });

                    this.updateStepButton();
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

                    this.updateStepButton();
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
                    const label = field.parentNode.querySelector('label');
                    return label ? label.textContent.trim() : field.name;
                }

                isStepValid(step) {
                    let fields = [];

                    switch (step) {
                        case 1:
                            fields = ['name', 'email', 'phone'];
                            break;
                        case 2:
                            fields = ['age', 'password', 'password_confirmation'];
                            break;
                        case 3:
                            fields = ['terms'];
                            break;
                    }

                    for (let fieldName of fields) {
                        if (this.errors[fieldName]) {
                            return false;
                        }

                        const field = this.form.querySelector(`[name="${fieldName}"]`);
                        if (field) {
                            if (field.type === 'checkbox' && field.required && !field.checked) {
                                return false;
                            } else if (field.type !== 'checkbox' && field.required && !field.value.trim()) {
                                return false;
                            }
                        }
                    }

                    return true;
                }

                updateStepButton() {
                    const currentButton = document.getElementById(`next-step-${this.currentStep}`) ||
                                        document.getElementById('submit-form');

                    if (currentButton) {
                        if (this.isStepValid(this.currentStep)) {
                            currentButton.disabled = false;
                        } else {
                            currentButton.disabled = true;
                        }
                    }
                }

                nextStep() {
                    if (this.currentStep < 3) {
                        // Validate current step
                        const stepFields = document.querySelectorAll(`#step-${this.currentStep} input`);
                        stepFields.forEach(field => this.validateField(field));

                        if (this.isStepValid(this.currentStep)) {
                            this.currentStep++;
                            this.showStep(this.currentStep);

                            // Update confirmation values
                            if (this.currentStep === 3) {
                                document.getElementById('confirm-name').textContent = document.getElementById('name').value;
                                document.getElementById('confirm-email').textContent = document.getElementById('email').value;
                                document.getElementById('confirm-phone').textContent = document.getElementById('phone').value;
                                document.getElementById('confirm-age').textContent = document.getElementById('age').value;
                            }
                        }
                    }
                }

                prevStep() {
                    if (this.currentStep > 1) {
                        this.currentStep--;
                        this.showStep(this.currentStep);
                    }
                }

                showStep(step) {
                    // Hide all steps
                    document.querySelectorAll('.step-section').forEach(section => {
                        section.classList.remove('active');
                    });

                    // Show current step
                    document.getElementById(`step-${step}`).classList.add('active');

                    // Update step indicators
                    document.querySelectorAll('.step').forEach((indicator, index) => {
                        indicator.classList.remove('active', 'completed');
                        if (index + 1 === step) {
                            indicator.classList.add('active');
                        } else if (index + 1 < step) {
                            indicator.classList.add('completed');
                        }
                    });

                    this.updateStepButton();
                }

                handleSubmit(e) {
                    // Validate all fields
                    const inputs = this.form.querySelectorAll('input');
                    inputs.forEach(input => this.validateField(input));

                    if (!this.isStepValid(1) || !this.isStepValid(2) || !this.isStepValid(3)) {
                        e.preventDefault();
                        return false;
                    }

                    return true;
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                new SteppedFormValidator();
            });
        })();
    </script>
</div>
