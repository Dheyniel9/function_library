@extends('layouts.app')

@section('title', 'Multi-Step Form')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Multi-Step Form Wizard</h1>

        <!-- Progress Indicator -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div id="step1-indicator" class="flex items-center justify-center w-8 h-8 bg-blue-500 text-white rounded-full font-semibold">1</div>
                    <span class="ml-2 text-sm font-medium text-gray-700">Personal Info</span>
                </div>
                <div class="flex-1 h-1 bg-gray-200 mx-4">
                    <div id="progress1" class="h-full bg-blue-500 transition-all duration-300" style="width: 33.33%"></div>
                </div>
                <div class="flex items-center">
                    <div id="step2-indicator" class="flex items-center justify-center w-8 h-8 bg-gray-300 text-gray-600 rounded-full font-semibold">2</div>
                    <span class="ml-2 text-sm font-medium text-gray-500">Account Details</span>
                </div>
                <div class="flex-1 h-1 bg-gray-200 mx-4">
                    <div id="progress2" class="h-full bg-gray-300 transition-all duration-300" style="width: 0%"></div>
                </div>
                <div class="flex items-center">
                    <div id="step3-indicator" class="flex items-center justify-center w-8 h-8 bg-gray-300 text-gray-600 rounded-full font-semibold">3</div>
                    <span class="ml-2 text-sm font-medium text-gray-500">Preferences</span>
                </div>
                <div class="flex-1 h-1 bg-gray-200 mx-4">
                    <div id="progress3" class="h-full bg-gray-300 transition-all duration-300" style="width: 0%"></div>
                </div>
                <div class="flex items-center">
                    <div id="step4-indicator" class="flex items-center justify-center w-8 h-8 bg-gray-300 text-gray-600 rounded-full font-semibold">4</div>
                    <span class="ml-2 text-sm font-medium text-gray-500">Review</span>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <form id="multiStepForm" class="space-y-6">
            <!-- Step 1: Personal Information -->
            <div id="step1" class="form-step">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">First Name *</label>
                        <input type="text" id="firstName" name="firstName" required
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Last Name *</label>
                        <input type="text" id="lastName" name="lastName" required
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Date of Birth *</label>
                        <input type="date" id="dob" name="dob" required
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                </div>
            </div>

            <!-- Step 2: Account Details -->
            <div id="step2" class="form-step hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Account Details</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Username *</label>
                        <input type="text" id="username" name="username" required
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Password *</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password *</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Account Type</label>
                        <select id="accountType" name="accountType" required
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                            <option value="">Select Account Type</option>
                            <option value="personal">Personal</option>
                            <option value="business">Business</option>
                            <option value="premium">Premium</option>
                        </select>
                        <span class="error-message text-red-500 text-sm hidden"></span>
                    </div>
                </div>
            </div>

            <!-- Step 3: Preferences -->
            <div id="step3" class="form-step hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Preferences</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Notification Preferences</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="notifications[]" value="email" class="mr-2">
                                <span class="text-sm">Email notifications</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="notifications[]" value="sms" class="mr-2">
                                <span class="text-sm">SMS notifications</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="notifications[]" value="push" class="mr-2">
                                <span class="text-sm">Push notifications</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Language</label>
                        <select id="language" name="language"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                            <option value="en">English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Timezone</label>
                        <select id="timezone" name="timezone"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                            <option value="UTC">UTC</option>
                            <option value="EST">Eastern Time</option>
                            <option value="PST">Pacific Time</option>
                            <option value="CET">Central European Time</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Bio</label>
                        <textarea id="bio" name="bio" rows="4" placeholder="Tell us about yourself..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"></textarea>
                    </div>
                </div>
            </div>

            <!-- Step 4: Review -->
            <div id="step4" class="form-step hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Review Your Information</h2>
                <div class="bg-gray-50 rounded-lg p-6">
                    <div id="reviewContent" class="space-y-4">
                        <!-- Review content will be populated here -->
                    </div>
                </div>
                <div class="mt-6">
                    <label class="flex items-center">
                        <input type="checkbox" id="agreeTerms" required class="mr-2">
                        <span class="text-sm text-gray-700">I agree to the <a href="#" class="text-blue-600 hover:underline">Terms of Service</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a></span>
                    </label>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between pt-6">
                <button type="button" id="prevBtn" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded hidden">
                    Previous
                </button>
                <button type="button" id="nextBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded ml-auto">
                    Next
                </button>
                <button type="submit" id="submitBtn" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded ml-auto hidden">
                    Submit
                </button>
            </div>
        </form>

        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-50 border border-green-200 rounded-lg p-6 text-center">
            <div class="text-green-600 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-green-800 mb-2">Registration Successful!</h3>
            <p class="text-green-700">Your account has been created successfully. You will receive a confirmation email shortly.</p>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">JavaScript Code:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
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

        // Update buttons
        document.getElementById('prevBtn').classList.toggle('hidden', step === 1);
        document.getElementById('nextBtn').classList.toggle('hidden', step === this.totalSteps);
        document.getElementById('submitBtn').classList.toggle('hidden', step !== this.totalSteps);

        // Update review if on last step
        if (step === this.totalSteps) {
            this.updateReview();
        }
    }
}

const multiStepForm = new MultiStepForm();
        </code></pre>
    </div>
</div>

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

                // Additional validation
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
        input.classList.add('border-red-500');
        const errorElement = input.nextElementSibling;
        errorElement.textContent = message;
        errorElement.classList.remove('hidden');
    }

    clearError(input) {
        input.classList.remove('border-red-500');
        const errorElement = input.nextElementSibling;
        errorElement.classList.add('hidden');
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

        // Update buttons
        document.getElementById('prevBtn').classList.toggle('hidden', step === 1);
        document.getElementById('nextBtn').classList.toggle('hidden', step === this.totalSteps);
        document.getElementById('submitBtn').classList.toggle('hidden', step !== this.totalSteps);

        // Update review if on last step
        if (step === this.totalSteps) {
            this.updateReview();
        }
    }

    updateProgress() {
        const progressPercentage = (this.currentStep / this.totalSteps) * 100;

        for (let i = 1; i <= this.totalSteps; i++) {
            const indicator = document.getElementById(`step${i}-indicator`);
            const progress = document.getElementById(`progress${i}`);

            if (i < this.currentStep) {
                indicator.className = 'flex items-center justify-center w-8 h-8 bg-green-500 text-white rounded-full font-semibold';
                indicator.innerHTML = '✓';
                if (progress) progress.style.width = '100%';
                if (progress) progress.className = 'h-full bg-green-500 transition-all duration-300';
            } else if (i === this.currentStep) {
                indicator.className = 'flex items-center justify-center w-8 h-8 bg-blue-500 text-white rounded-full font-semibold';
                indicator.textContent = i;
                if (progress) progress.style.width = '0%';
                if (progress) progress.className = 'h-full bg-blue-500 transition-all duration-300';
            } else {
                indicator.className = 'flex items-center justify-center w-8 h-8 bg-gray-300 text-gray-600 rounded-full font-semibold';
                indicator.textContent = i;
                if (progress) progress.style.width = '0%';
                if (progress) progress.className = 'h-full bg-gray-300 transition-all duration-300';
            }
        }
    }

    updateReview() {
        const reviewContent = document.getElementById('reviewContent');
        reviewContent.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Personal Information</h3>
                    <p><strong>Name:</strong> ${this.formData.firstName} ${this.formData.lastName}</p>
                    <p><strong>Email:</strong> ${this.formData.email}</p>
                    <p><strong>Phone:</strong> ${this.formData.phone}</p>
                    <p><strong>Date of Birth:</strong> ${this.formData.dob}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Account Details</h3>
                    <p><strong>Username:</strong> ${this.formData.username}</p>
                    <p><strong>Account Type:</strong> ${this.formData.accountType}</p>
                    <p><strong>Language:</strong> ${this.formData.language}</p>
                    <p><strong>Timezone:</strong> ${this.formData.timezone}</p>
                </div>
            </div>
        `;
    }

    submitForm(e) {
        e.preventDefault();

        if (!document.getElementById('agreeTerms').checked) {
            alert('Please agree to the terms and conditions');
            return;
        }

        // Simulate form submission
        document.getElementById('multiStepForm').classList.add('hidden');
        document.getElementById('successMessage').classList.remove('hidden');

        console.log('Form submitted:', this.formData);
    }
}

const multiStepForm = new MultiStepForm();
</script>
@endsection
