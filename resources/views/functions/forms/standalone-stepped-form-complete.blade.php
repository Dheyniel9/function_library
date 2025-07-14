{{-- STANDALONE STEPPED FORM - COPY THIS ENTIRE FILE --}}
{{--
    This is a complete, self-contained stepped form that you can copy and paste into any Laravel project.
    It includes all HTML, CSS, and JavaScript needed to work independently.

    Requirements:
    - Laravel (for @csrf and form handling)
    - Alpine.js (included via CDN)
    - Tailwind CSS (included via CDN)

    To use:
    1. Copy this entire file
    2. Update the form action route
    3. Add your controller method
    4. Done!
--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stepped Registration Form</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js CDN --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- Custom Styles --}}
    <style>
        /* Custom animations and transitions */
        .step-indicator {
            transition: all 0.3s ease;
        }

        .form-input {
            transition: all 0.2s ease;
        }

        .form-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .step-active {
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .step-inactive {
            background: #E5E7EB;
            color: #6B7280;
        }

        .step-connector {
            transition: all 0.3s ease;
        }

        .step-connector.completed {
            background: #3B82F6;
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary {
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2563EB 0%, #1E40AF 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .btn-secondary {
            background: #F3F4F6;
            color: #374151;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: #E5E7EB;
            transform: translateY(-1px);
        }

        .review-card {
            background: linear-gradient(135deg, #F9FAFB 0%, #F3F4F6 100%);
            border: 1px solid #E5E7EB;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4">
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Your Account</h1>
            <p class="text-gray-600">Fill out the form below to get started</p>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg mb-6 fade-in">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif

        {{-- Error Messages --}}
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg mb-6 fade-in">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <p class="font-medium mb-1">Please correct the following errors:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        {{-- Main Form Container --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-8">
                {{-- Stepped Form --}}
                <div x-data="steppedForm()" class="fade-in">
                    {{-- Step Indicator --}}
                    <div class="mb-10">
                        <nav aria-label="Progress" class="step-indicator">
                            <ol class="flex items-center justify-between">
                                <li class="flex items-center flex-1">
                                    <div :class="currentStep >= 1 ? 'step-active text-white' : 'step-inactive'"
                                         class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-bold transition-all duration-300">
                                        <span x-show="currentStep > 1">✓</span>
                                        <span x-show="currentStep <= 1">1</span>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Personal Info</span>
                                </li>
                                <li class="flex items-center flex-1">
                                    <div :class="currentStep >= 2 ? 'bg-blue-500' : 'bg-gray-200'"
                                         class="flex-1 h-1 mx-4 rounded step-connector"></div>
                                    <div :class="currentStep >= 2 ? 'step-active text-white' : 'step-inactive'"
                                         class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-bold transition-all duration-300">
                                        <span x-show="currentStep > 2">✓</span>
                                        <span x-show="currentStep <= 2">2</span>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Account Details</span>
                                </li>
                                <li class="flex items-center flex-1">
                                    <div :class="currentStep >= 3 ? 'bg-blue-500' : 'bg-gray-200'"
                                         class="flex-1 h-1 mx-4 rounded step-connector"></div>
                                    <div :class="currentStep >= 3 ? 'step-active text-white' : 'step-inactive'"
                                         class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-bold transition-all duration-300">
                                        <span x-show="currentStep > 3">✓</span>
                                        <span x-show="currentStep <= 3">3</span>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Confirmation</span>
                                </li>
                            </ol>
                        </nav>
                    </div>

                    {{-- Form --}}
                    <form method="POST" action="{{ route('functions.submit-form') }}" x-data="formValidation()">
                        @csrf

                        {{-- Step 1: Personal Information --}}
                        <div x-show="currentStep === 1" x-transition:enter="fade-in" class="space-y-6">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Personal Information</h3>
                                <p class="text-gray-600">Tell us about yourself</p>
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           x-model="formData.name"
                                           @blur="validateField('name')"
                                           :class="{'border-red-400 bg-red-50': errors.name, 'border-green-400 bg-green-50': !errors.name && formData.name, 'border-gray-300': !errors.name && !formData.name}"
                                           class="form-input w-full border-2 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                           placeholder="Enter your full name"
                                           required>
                                    <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-sm mt-1"></p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                                        <input type="email"
                                               id="email"
                                               name="email"
                                               x-model="formData.email"
                                               @blur="validateField('email')"
                                               :class="{'border-red-400 bg-red-50': errors.email, 'border-green-400 bg-green-50': !errors.email && formData.email, 'border-gray-300': !errors.email && !formData.email}"
                                               class="form-input w-full border-2 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                               placeholder="your@email.com"
                                               required>
                                        <p x-show="errors.email" x-text="errors.email" class="text-red-500 text-sm mt-1"></p>
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number *</label>
                                        <input type="tel"
                                               id="phone"
                                               name="phone"
                                               x-model="formData.phone"
                                               @blur="validateField('phone')"
                                               :class="{'border-red-400 bg-red-50': errors.phone, 'border-green-400 bg-green-50': !errors.phone && formData.phone, 'border-gray-300': !errors.phone && !formData.phone}"
                                               class="form-input w-full border-2 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                               placeholder="1234567890"
                                               required>
                                        <p x-show="errors.phone" x-text="errors.phone" class="text-red-500 text-sm mt-1"></p>
                                    </div>
                                </div>

                                <div class="max-w-xs">
                                    <label for="age" class="block text-sm font-semibold text-gray-700 mb-2">Age *</label>
                                    <input type="number"
                                           id="age"
                                           name="age"
                                           x-model="formData.age"
                                           @blur="validateField('age')"
                                           :class="{'border-red-400 bg-red-50': errors.age, 'border-green-400 bg-green-50': !errors.age && formData.age, 'border-gray-300': !errors.age && !formData.age}"
                                           class="form-input w-full border-2 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                           placeholder="25"
                                           min="18"
                                           max="100"
                                           required>
                                    <p x-show="errors.age" x-text="errors.age" class="text-red-500 text-sm mt-1"></p>
                                </div>
                            </div>
                        </div>

                        {{-- Step 2: Account Details --}}
                        <div x-show="currentStep === 2" x-transition:enter="fade-in" class="space-y-6">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Account Security</h3>
                                <p class="text-gray-600">Create a secure password for your account</p>
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password *</label>
                                    <input type="password"
                                           id="password"
                                           name="password"
                                           x-model="formData.password"
                                           @blur="validateField('password')"
                                           :class="{'border-red-400 bg-red-50': errors.password, 'border-green-400 bg-green-50': !errors.password && formData.password, 'border-gray-300': !errors.password && !formData.password}"
                                           class="form-input w-full border-2 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                           placeholder="Enter a strong password"
                                           required>
                                    <p x-show="errors.password" x-text="errors.password" class="text-red-500 text-sm mt-1"></p>
                                    <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long</p>
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password *</label>
                                    <input type="password"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           x-model="formData.password_confirmation"
                                           @blur="validateField('password_confirmation')"
                                           :class="{'border-red-400 bg-red-50': errors.password_confirmation, 'border-green-400 bg-green-50': !errors.password_confirmation && formData.password_confirmation, 'border-gray-300': !errors.password_confirmation && !formData.password_confirmation}"
                                           class="form-input w-full border-2 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                           placeholder="Confirm your password"
                                           required>
                                    <p x-show="errors.password_confirmation" x-text="errors.password_confirmation" class="text-red-500 text-sm mt-1"></p>
                                </div>
                            </div>
                        </div>

                        {{-- Step 3: Confirmation --}}
                        <div x-show="currentStep === 3" x-transition:enter="fade-in" class="space-y-6">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Review & Confirm</h3>
                                <p class="text-gray-600">Please review your information before submitting</p>
                            </div>

                            <div class="review-card rounded-xl p-6 mb-6">
                                <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                    Your Information
                                </h4>
                                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                        <dd class="text-lg font-semibold text-gray-900" x-text="formData.name || 'Not provided'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                        <dd class="text-lg font-semibold text-gray-900" x-text="formData.email || 'Not provided'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                                        <dd class="text-lg font-semibold text-gray-900" x-text="formData.phone || 'Not provided'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Age</dt>
                                        <dd class="text-lg font-semibold text-gray-900" x-text="formData.age || 'Not provided'"></dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <input type="checkbox"
                                           id="terms"
                                           name="terms"
                                           x-model="formData.terms"
                                           @change="validateField('terms')"
                                           :class="{'border-red-400': errors.terms}"
                                           class="w-4 h-4 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 mr-3"
                                           required>
                                    <label for="terms" class="text-sm font-medium text-gray-700">
                                        I agree to the <a href="#" class="text-blue-600 hover:text-blue-800 underline">Terms of Service</a> and <a href="#" class="text-blue-600 hover:text-blue-800 underline">Privacy Policy</a>
                                    </label>
                                </div>
                                <p x-show="errors.terms" x-text="errors.terms" class="text-red-500 text-sm mt-2"></p>
                            </div>
                        </div>

                        {{-- Navigation Buttons --}}
                        <div class="mt-10 flex justify-between items-center">
                            <button type="button"
                                    @click="prevStep()"
                                    x-show="currentStep > 1"
                                    class="btn-secondary px-6 py-3 rounded-lg font-medium transition-all duration-200">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Previous
                            </button>
                            <div x-show="currentStep === 1" class="w-20"></div>

                            <button type="button"
                                    @click="nextStep()"
                                    x-show="currentStep < 3"
                                    class="btn-primary text-white px-6 py-3 rounded-lg font-medium transition-all duration-200">
                                Next
                                <svg class="w-5 h-5 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>

                            <button type="submit"
                                    x-show="currentStep === 3"
                                    :disabled="!isValid()"
                                    :class="{'btn-primary': isValid(), 'bg-gray-300 cursor-not-allowed': !isValid()}"
                                    class="text-white px-8 py-3 rounded-lg font-medium transition-all duration-200">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-center mt-8 text-gray-500 text-sm">
            <p>Already have an account? <a href="#" class="text-blue-600 hover:text-blue-800">Sign in here</a></p>
        </div>
    </div>

    {{-- JavaScript Functions --}}
    <script>
        // Form validation function
        function formValidation() {
            return {
                formData: {
                    name: '',
                    email: '',
                    phone: '',
                    age: '',
                    password: '',
                    password_confirmation: '',
                    terms: false
                },
                errors: {},

                validateField(field) {
                    switch(field) {
                        case 'name':
                            if (!this.formData.name.trim()) {
                                this.errors.name = 'Name is required';
                            } else if (this.formData.name.length < 2) {
                                this.errors.name = 'Name must be at least 2 characters';
                            } else if (this.formData.name.length > 255) {
                                this.errors.name = 'Name cannot exceed 255 characters';
                            } else {
                                delete this.errors.name;
                            }
                            break;

                        case 'email':
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!this.formData.email.trim()) {
                                this.errors.email = 'Email is required';
                            } else if (!emailRegex.test(this.formData.email)) {
                                this.errors.email = 'Please enter a valid email address';
                            } else {
                                delete this.errors.email;
                            }
                            break;

                        case 'phone':
                            const phoneRegex = /^[0-9]{10,15}$/;
                            const cleanPhone = this.formData.phone.replace(/\D/g, '');
                            if (!this.formData.phone.trim()) {
                                this.errors.phone = 'Phone number is required';
                            } else if (!phoneRegex.test(cleanPhone)) {
                                this.errors.phone = 'Please enter a valid phone number (10-15 digits)';
                            } else {
                                delete this.errors.phone;
                            }
                            break;

                        case 'age':
                            if (!this.formData.age) {
                                this.errors.age = 'Age is required';
                            } else if (this.formData.age < 18) {
                                this.errors.age = 'You must be at least 18 years old';
                            } else if (this.formData.age > 100) {
                                this.errors.age = 'Please enter a valid age';
                            } else {
                                delete this.errors.age;
                            }
                            break;

                        case 'password':
                            if (!this.formData.password) {
                                this.errors.password = 'Password is required';
                            } else if (this.formData.password.length < 8) {
                                this.errors.password = 'Password must be at least 8 characters';
                            } else {
                                delete this.errors.password;
                            }
                            break;

                        case 'password_confirmation':
                            if (this.formData.password !== this.formData.password_confirmation) {
                                this.errors.password_confirmation = 'Password confirmation does not match';
                            } else {
                                delete this.errors.password_confirmation;
                            }
                            break;

                        case 'terms':
                            if (!this.formData.terms) {
                                this.errors.terms = 'You must accept the terms and conditions';
                            } else {
                                delete this.errors.terms;
                            }
                            break;
                    }
                },

                isValid() {
                    return Object.keys(this.errors).length === 0 &&
                           this.formData.name &&
                           this.formData.email &&
                           this.formData.phone &&
                           this.formData.age &&
                           this.formData.password &&
                           this.formData.password_confirmation &&
                           this.formData.terms;
                }
            }
        }

        // Stepped form navigation
        function steppedForm() {
            return {
                currentStep: 1,

                nextStep() {
                    if (this.currentStep < 3) {
                        this.currentStep++;
                    }
                },

                prevStep() {
                    if (this.currentStep > 1) {
                        this.currentStep--;
                    }
                }
            }
        }
    </script>
</body>
</html>
