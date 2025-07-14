@extends('layouts.app')

@section('title', 'Multi-Step Form')

@section('content')
<!-- Custom Inline Styles for Multi-Step Form -->
<style>
    /* Main container styling */
    .multistep-container {
        max-width: 1000px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
    }

    /* Progress indicator styles */
    .progress-container {
        margin-bottom: 2rem;
    }

    .step-indicator {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .step-item {
        display: flex;
        align-items: center;
        flex: 1;
        min-width: 200px;
        margin-bottom: 1rem;
    }

    .step-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        margin-right: 0.5rem;
    }

    .step-circle.active {
        background-color: #007bff;
        color: white;
    }

    .step-circle.completed {
        background-color: #28a745;
        color: white;
    }

    .step-circle.inactive {
        background-color: #6c757d;
        color: white;
    }

    .step-label {
        font-size: 0.875rem;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .step-label.active {
        color: #495057;
    }

    .step-label.inactive {
        color: #6c757d;
    }

    .progress-line {
        flex: 1;
        height: 4px;
        background-color: #e9ecef;
        margin: 0 1rem;
        border-radius: 2px;
        overflow: hidden;
        position: relative;
    }

    .progress-line-fill {
        height: 100%;
        background-color: #28a745;
        transition: width 0.3s ease;
        width: 0%;
    }

    /* Form styling */
    .form-step {
        min-height: 400px;
        padding: 1rem 0;
    }

    .form-step.hidden {
        display: none;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.75rem;
        font-size: 0.875rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .error-message {
        color: #dc3545;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: none;
    }

    .error-message.show {
        display: block;
    }

    /* Navigation buttons */
    .form-navigation {
        border-top: 1px solid #e9ecef;
        padding-top: 1.5rem;
        margin-top: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-navigation {
        padding: 0.75rem 2rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-prev {
        background-color: #6c757d;
        color: white;
    }

    .btn-prev:hover {
        background-color: #5a6268;
    }

    .btn-next {
        background-color: #007bff;
        color: white;
    }

    .btn-next:hover {
        background-color: #0056b3;
    }

    .btn-submit {
        background-color: #28a745;
        color: white;
    }

    .btn-submit:hover {
        background-color: #218838;
    }

    /* Review section styling */
    .review-section {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.5rem;
    }

    .review-item {
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .review-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .review-title {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .review-content p {
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }

    /* Success message styling */
    .success-container {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        display: none;
    }

    .success-container.show {
        display: block;
    }

    .success-icon {
        width: 4rem;
        height: 4rem;
        margin: 0 auto 1rem;
        color: #155724;
    }

    /* Custom checkbox styling */
    .custom-checkbox {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .custom-checkbox input[type="checkbox"] {
        margin-right: 0.5rem;
        transform: scale(1.1);
    }

    /* Code example styling */
    .code-example {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .code-block {
        background-color: #2d3748;
        color: #68d391;
        padding: 1.5rem;
        border-radius: 0.5rem;
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
        font-size: 0.875rem;
        line-height: 1.5;
        overflow-x: auto;
        white-space: pre;
    }

    /* Additional form controls styling */
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Enhanced checkbox styling */
    .custom-checkbox input[type="checkbox"] {
        margin-right: 0.75rem;
        transform: scale(1.2);
        accent-color: #007bff;
    }

    .custom-checkbox label {
        font-size: 0.9rem;
        color: #495057;
        cursor: pointer;
        user-select: none;
    }

    /* Progress animations */
    .step-circle {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .progress-line-fill {
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Form step animations */
    .form-step {
        opacity: 1;
        transform: translateX(0);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .form-step.slide-out-left {
        opacity: 0;
        transform: translateX(-50px);
    }

    .form-step.slide-in-right {
        opacity: 0;
        transform: translateX(50px);
    }

    /* Button hover effects */
    .btn-navigation {
        position: relative;
        overflow: hidden;
    }

    .btn-navigation::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.2),
            transparent
        );
        transition: left 0.5s;
    }

    .btn-navigation:hover::before {
        left: 100%;
    }

    /* Terms link styling */
    .terms-link {
        color: #007bff;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .terms-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    /* Loading state for submit button */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin-top: -10px;
        margin-left: -10px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Enhanced validation styling */
    .form-control.is-valid {
        border-color: #28a745;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='m2.3 6.73.5-.5L7 1.99 6.5 1.5l-4.2 4.2L1 4.4l-.5.5 1.8 1.83z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .form-control.is-invalid {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    /* Success checkmark animation */
    @keyframes checkmark {
        0% {
            opacity: 0;
            transform: scale(0.5) rotate(-45deg);
        }
        50% {
            opacity: 1;
            transform: scale(1.2) rotate(-45deg);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(-45deg);
        }
    }

    .success-container.show .success-icon {
        animation: checkmark 0.6s ease-out;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .multistep-container {
            padding: 1rem;
            margin: 0.5rem;
        }

        .step-indicator {
            flex-direction: column;
            align-items: center;
        }

        .step-item {
            width: 100%;
            justify-content: center;
            margin-bottom: 1rem;
            max-width: 300px;
        }

        .progress-line {
            height: 2px;
            width: 80%;
            margin: 0.5rem 0;
        }

        .form-navigation {
            flex-direction: column;
            gap: 1rem;
            padding-top: 1rem;
        }

        .btn-navigation {
            width: 100%;
            padding: 1rem 2rem;
            font-size: 1rem;
        }

        .form-step {
            min-height: 300px;
            padding: 0.5rem 0;
        }

        .review-section {
            padding: 1rem;
        }

        .code-example {
            margin-top: 1rem;
            padding: 1rem;
        }

        .code-block {
            padding: 1rem;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .multistep-container {
            padding: 0.75rem;
        }

        .step-item {
            flex-direction: column;
            text-align: center;
        }

        .step-circle {
            margin-right: 0;
            margin-bottom: 0.25rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .review-item {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="multistep-container">
                <!-- Page Header -->
                <div class="mb-4">
                    <h1 class="h2 font-weight-bold text-dark mb-3">
                        <i class="fas fa-clipboard-list mr-2 text-primary"></i>
                        Multi-Step Form Wizard
                    </h1>
                    <p class="text-muted mb-0">
                        <i class="fas fa-info-circle mr-1"></i>
                        Complete the form step by step with validation and progress tracking
                    </p>
                </div>

                <!-- Progress Indicator -->
                <div class="progress-container">
                    <div class="step-indicator">
                        <div class="step-item">
                            <div id="step1-circle" class="step-circle active">1</div>
                            <span id="step1-label" class="step-label active">Personal Info</span>
                        </div>
                        <div class="progress-line">
                            <div id="progress1" class="progress-line-fill"></div>
                        </div>

                        <div class="step-item">
                            <div id="step2-circle" class="step-circle inactive">2</div>
                            <span id="step2-label" class="step-label inactive">Account Details</span>
                        </div>
                        <div class="progress-line">
                            <div id="progress2" class="progress-line-fill"></div>
                        </div>

                        <div class="step-item">
                            <div id="step3-circle" class="step-circle inactive">3</div>
                            <span id="step3-label" class="step-label inactive">Preferences</span>
                        </div>
                        <div class="progress-line">
                            <div id="progress3" class="progress-line-fill"></div>
                        </div>

                        <div class="step-item">
                            <div id="step4-circle" class="step-circle inactive">4</div>
                            <span id="step4-label" class="step-label inactive">Review</span>
                        </div>
                    </div>
                </div>

                <!-- Form Container -->
                <form id="multiStepForm">
                    <!-- Step 1: Personal Information -->
                    <div id="step1" class="form-step">
                        <h3 class="h4 font-weight-semibold text-dark mb-4">Personal Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">First Name *</label>
                                    <input type="text" id="firstName" name="firstName" class="form-control" required
                                           placeholder="Enter your first name">
                                    <div class="error-message"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name *</label>
                                    <input type="text" id="lastName" name="lastName" class="form-control" required
                                           placeholder="Enter your last name">
                                    <div class="error-message"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email Address *</label>
                                    <input type="email" id="email" name="email" class="form-control" required
                                           placeholder="your.email@example.com">
                                    <div class="error-message"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Phone Number *</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" required
                                           placeholder="+1 (555) 123-4567">
                                    <div class="error-message"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth *</label>
                                    <input type="date" id="dob" name="dob" class="form-control" required>
                                    <div class="error-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Account Details -->
                    <div id="step2" class="form-step hidden">
                        <h3 class="h4 font-weight-semibold text-dark mb-4">Account Details</h3>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Username *</label>
                                    <input type="text" id="username" name="username" class="form-control" required>
                                    <div class="error-message"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Password *</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    <div class="error-message"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Confirm Password *</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                                    <div class="error-message"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Account Type *</label>
                                    <select id="accountType" name="accountType" class="form-control" required>
                                        <option value="">Select Account Type</option>
                                        <option value="personal">Personal</option>
                                        <option value="business">Business</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                    <div class="error-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Preferences -->
                    <div id="step3" class="form-step hidden">
                        <h3 class="h4 font-weight-semibold text-dark mb-4">Preferences</h3>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Notification Preferences</label>
                                    <div class="mt-2">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="notifEmail" name="notifications[]" value="email">
                                            <label for="notifEmail">Email notifications</label>
                                        </div>
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="notifSms" name="notifications[]" value="sms">
                                            <label for="notifSms">SMS notifications</label>
                                        </div>
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="notifPush" name="notifications[]" value="push">
                                            <label for="notifPush">Push notifications</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Language</label>
                                    <select id="language" name="language" class="form-control">
                                        <option value="en">English</option>
                                        <option value="es">Spanish</option>
                                        <option value="fr">French</option>
                                        <option value="de">German</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Timezone</label>
                                    <select id="timezone" name="timezone" class="form-control">
                                        <option value="UTC">UTC</option>
                                        <option value="EST">Eastern Time</option>
                                        <option value="PST">Pacific Time</option>
                                        <option value="CET">Central European Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Bio</label>
                                    <textarea id="bio" name="bio" rows="4" class="form-control" placeholder="Tell us about yourself..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Review -->
                    <div id="step4" class="form-step hidden">
                        <h3 class="h4 font-weight-semibold text-dark mb-4">Review Your Information</h3>
                        <div class="review-section">
                            <div id="reviewContent">
                                <!-- Review content will be populated here -->
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="form-group">
                                <label for="agreeTerms" class="custom-checkbox">
                                    <input type="checkbox" id="agreeTerms" required>
                                    I agree to the <a href="#" class="terms-link">Terms of Service</a> and
                                    <a href="#" class="terms-link">Privacy Policy</a>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="form-navigation">
                        <button type="button" id="prevBtn" class="btn-navigation btn-prev" style="display: none;">
                            <i class="fas fa-arrow-left mr-2"></i>Previous
                        </button>
                        <div></div> <!-- Spacer for flex layout -->
                        <button type="button" id="nextBtn" class="btn-navigation btn-next">
                            Next<i class="fas fa-arrow-right ml-2"></i>
                        </button>
                        <button type="submit" id="submitBtn" class="btn-navigation btn-submit" style="display: none;">
                            <i class="fas fa-check mr-2"></i>Submit
                        </button>
                    </div>
                </form>

                <!-- Success Message -->
                <div id="successMessage" class="success-container">
                    <div class="success-icon">
                        <i class="fas fa-check-circle" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="h4 font-weight-semibold text-success mb-3">Registration Successful!</h3>
                    <p class="text-success">Your account has been created successfully. You will receive a confirmation email shortly.</p>
                </div>
            </div>

            <!-- Code Example -->
            <div class="code-example">
                <h4 class="h5 font-weight-semibold mb-3">
                    <i class="fas fa-code mr-2"></i>
                    JavaScript Code Example
                </h4>
                <div class="code-block">// Multi-Step Form Class
class MultiStepForm {
    constructor() {
        this.currentStep = 1;
        this.totalSteps = 4;
        this.formData = {};
        this.init();
    }

    init() {
        this.bindEvents();
        this.updateProgress();
    }

    bindEvents() {
        document.getElementById('nextBtn').addEventListener('click', () => this.nextStep());
        document.getElementById('prevBtn').addEventListener('click', () => this.prevStep());
        document.getElementById('multiStepForm').addEventListener('submit', (e) => this.submitForm(e));
    }

    validateStep(step) {
        const stepElement = document.getElementById(`step${step}`);
        const inputs = stepElement.querySelectorAll('input[required], select[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                this.showError(input, 'This field is required');
                isValid = false;
            } else {
                this.clearError(input);
                // Additional validation logic...
            }
        });

        return isValid;
    }

    nextStep() {
        if (this.validateStep(this.currentStep)) {
            this.saveStepData();
            if (this.currentStep < this.totalSteps) {
                this.currentStep++;
                this.showStep(this.currentStep);
                this.updateProgress();
            }
        }
    }
}

// Initialize the form
const multiStepForm = new MultiStepForm();</div>
            </div>
        </div>
    </div>
</div>

<!-- Vanilla JavaScript for Multi-Step Form -->
<script>
    class MultiStepForm {
        constructor() {
            this.currentStep = 1;
            this.totalSteps = 4;
            this.formData = {};
            this.init();
        }

        init() {
            this.bindEvents();
            this.updateProgress();
        }

        bindEvents() {
            // UPDATED: Event listeners for navigation
            document.getElementById('nextBtn').addEventListener('click', () => this.nextStep());
            document.getElementById('prevBtn').addEventListener('click', () => this.prevStep());
            document.getElementById('multiStepForm').addEventListener('submit', (e) => this.submitForm(e));
        }

        validateStep(step) {
            const stepElement = document.getElementById(`step${step}`);
            const inputs = stepElement.querySelectorAll('input[required], select[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    this.showError(input, 'This field is required');
                    isValid = false;
                } else {
                    this.clearError(input);

                    // UPDATED: Additional validation
                    if (input.type === 'email' && !this.isValidEmail(input.value)) {
                        this.showError(input, 'Please enter a valid email address');
                        isValid = false;
                    } else if (input.name === 'confirmPassword') {
                        const password = document.getElementById('password').value;
                        if (input.value !== password) {
                            this.showError(input, 'Passwords do not match');
                            isValid = false;
                        }
                    }
                }
            });

            return isValid;
        }

        showError(input, message) {
            // UPDATED: Bootstrap error styling with validation icons
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            const errorElement = input.nextElementSibling;
            errorElement.textContent = message;
            errorElement.classList.add('show');
        }

        clearError(input) {
            // UPDATED: Remove error styling and add valid styling
            input.classList.remove('is-invalid');
            if (input.value.trim()) {
                input.classList.add('is-valid');
            }
            const errorElement = input.nextElementSibling;
            errorElement.classList.remove('show');
        }

        isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        saveStepData() {
            const stepElement = document.getElementById(`step${this.currentStep}`);
            const inputs = stepElement.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                if (input.type === 'checkbox') {
                    if (!this.formData[input.name]) {
                        this.formData[input.name] = [];
                    }
                    if (input.checked) {
                        this.formData[input.name].push(input.value);
                    }
                } else {
                    this.formData[input.name] = input.value;
                }
            });
        }

        nextStep() {
            if (this.validateStep(this.currentStep)) {
                this.saveStepData();
                if (this.currentStep < this.totalSteps) {
                    this.currentStep++;
                    this.showStep(this.currentStep);
                    this.updateProgress();
                }
            }
        }

        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                this.showStep(this.currentStep);
                this.updateProgress();
            }
        }

        showStep(step) {
            // Hide all steps
            document.querySelectorAll('.form-step').forEach(s => s.classList.add('hidden'));
            // Show current step
            document.getElementById(`step${step}`).classList.remove('hidden');

            // UPDATED: Update button visibility
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');

            prevBtn.style.display = step === 1 ? 'none' : 'block';
            nextBtn.style.display = step === this.totalSteps ? 'none' : 'block';
            submitBtn.style.display = step === this.totalSteps ? 'block' : 'none';

            // Update review if on last step
            if (step === this.totalSteps) {
                this.updateReview();
            }
        }

        updateProgress() {
            for (let i = 1; i <= this.totalSteps; i++) {
                const circle = document.getElementById(`step${i}-circle`);
                const label = document.getElementById(`step${i}-label`);
                const progress = document.getElementById(`progress${i}`);

                if (i < this.currentStep) {
                    // UPDATED: Completed step styling
                    circle.className = 'step-circle completed';
                    circle.innerHTML = '<i class="fas fa-check"></i>';
                    label.className = 'step-label active';
                    if (progress) progress.style.width = '100%';
                } else if (i === this.currentStep) {
                    // UPDATED: Active step styling
                    circle.className = 'step-circle active';
                    circle.textContent = i;
                    label.className = 'step-label active';
                    if (progress) progress.style.width = '0%';
                } else {
                    // UPDATED: Inactive step styling
                    circle.className = 'step-circle inactive';
                    circle.textContent = i;
                    label.className = 'step-label inactive';
                    if (progress) progress.style.width = '0%';
                }
            }
        }

        updateReview() {
            const reviewContent = document.getElementById('reviewContent');
            // UPDATED: Bootstrap grid for review content
            reviewContent.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <div class="review-item">
                            <div class="review-title">Personal Information</div>
                            <div class="review-content">
                                <p><strong>Name:</strong> ${this.formData.firstName || ''} ${this.formData.lastName || ''}</p>
                                <p><strong>Email:</strong> ${this.formData.email || ''}</p>
                                <p><strong>Phone:</strong> ${this.formData.phone || ''}</p>
                                <p><strong>Date of Birth:</strong> ${this.formData.dob || ''}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="review-item">
                            <div class="review-title">Account Details</div>
                            <div class="review-content">
                                <p><strong>Username:</strong> ${this.formData.username || ''}</p>
                                <p><strong>Account Type:</strong> ${this.formData.accountType || ''}</p>
                                <p><strong>Language:</strong> ${this.formData.language || 'English'}</p>
                                <p><strong>Timezone:</strong> ${this.formData.timezone || 'UTC'}</p>
                            </div>
                        </div>
                    </div>
                </div>
                ${this.formData.bio ? `
                <div class="review-item">
                    <div class="review-title">Bio</div>
                    <div class="review-content">
                        <p>${this.formData.bio}</p>
                    </div>
                </div>
                ` : ''}
            `;
        }

        submitForm(e) {
            e.preventDefault();

            if (!document.getElementById('agreeTerms').checked) {
                // UPDATED: Use notification if available
                if (typeof showNotification === 'function') {
                    showNotification('Please agree to the terms and conditions', 'error');
                } else {
                    alert('Please agree to the terms and conditions');
                }
                return;
            }

            // UPDATED: Add loading state to submit button
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            // Simulate form submission delay
            setTimeout(() => {
                // UPDATED: Show success message and hide form
                document.getElementById('multiStepForm').style.display = 'none';
                document.querySelector('.form-navigation').style.display = 'none';
                document.getElementById('successMessage').classList.add('show');

                // UPDATED: Show success notification
                if (typeof showNotification === 'function') {
                    showNotification('Form submitted successfully!', 'success');
                }

                console.log('Form submitted:', this.formData);
            }, 2000); // 2 second delay to show loading effect
        }
    }

    // Initialize multi-step form when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        window.multiStepForm = new MultiStepForm();

        // UPDATED: Show loading notification
        setTimeout(() => {
            if (typeof showNotification === 'function') {
                showNotification('Multi-step form loaded! Complete each step to proceed.', 'info');
            }
        }, 1000);
    });
</script>
@endsection
