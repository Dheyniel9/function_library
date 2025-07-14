{{-- Standalone Stepped Form - Copy this entire file --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stepped Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Registration Form</h1>

            {{-- Success Message --}}
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            {{-- Stepped Form --}}
            <div x-data="steppedForm()">
                <!-- Step Indicator -->
                <div class="mb-8">
                    <nav aria-label="Progress">
                        <ol class="flex items-center justify-between">
                            <li class="flex items-center">
                                <div :class="currentStep >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500'"
                                     class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium">
                                    1
                                </div>
                                <span class="ml-2 text-sm font-medium text-gray-900">Personal Info</span>
                            </li>
                            <li class="flex items-center">
                                <div class="flex-1 h-0.5 bg-gray-200 mx-4"></div>
                                <div :class="currentStep >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500'"
                                     class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium">
                                    2
                                </div>
                                <span class="ml-2 text-sm font-medium text-gray-900">Account Details</span>
                            </li>
                            <li class="flex items-center">
                                <div class="flex-1 h-0.5 bg-gray-200 mx-4"></div>
                                <div :class="currentStep >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500'"
                                     class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium">
                                    3
                                </div>
                                <span class="ml-2 text-sm font-medium text-gray-900">Confirmation</span>
                            </li>
                        </ol>
                    </nav>
                </div>

                <form method="POST" action="{{ route('submit-form') }}" x-data="formValidation()">
                    @csrf

                    <!-- Step 1: Personal Information -->
                    <div x-show="currentStep === 1" x-transition class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   x-model="formData.name"
                                   @blur="validateField('name')"
                                   :class="{'border-red-500': errors.name, 'border-green-500': !errors.name && formData.name}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       x-model="formData.email"
                                       @blur="validateField('email')"
                                       :class="{'border-red-500': errors.email, 'border-green-500': !errors.email && formData.email}"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       required>
                                <p x-show="errors.email" x-text="errors.email" class="text-red-500 text-sm mt-1"></p>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel"
                                       id="phone"
                                       name="phone"
                                       x-model="formData.phone"
                                       @blur="validateField('phone')"
                                       :class="{'border-red-500': errors.phone, 'border-green-500': !errors.phone && formData.phone}"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       required>
                                <p x-show="errors.phone" x-text="errors.phone" class="text-red-500 text-sm mt-1"></p>
                            </div>
                        </div>

                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                            <input type="number"
                                   id="age"
                                   name="age"
                                   x-model="formData.age"
                                   @blur="validateField('age')"
                                   :class="{'border-red-500': errors.age, 'border-green-500': !errors.age && formData.age}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   min="18"
                                   max="100"
                                   required>
                            <p x-show="errors.age" x-text="errors.age" class="text-red-500 text-sm mt-1"></p>
                        </div>
                    </div>

                    <!-- Step 2: Account Details -->
                    <div x-show="currentStep === 2" x-transition class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Account Details</h3>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   x-model="formData.password"
                                   @blur="validateField('password')"
                                   :class="{'border-red-500': errors.password, 'border-green-500': !errors.password && formData.password}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.password" x-text="errors.password" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   x-model="formData.password_confirmation"
                                   @blur="validateField('password_confirmation')"
                                   :class="{'border-red-500': errors.password_confirmation, 'border-green-500': !errors.password_confirmation && formData.password_confirmation}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.password_confirmation" x-text="errors.password_confirmation" class="text-red-500 text-sm mt-1"></p>
                        </div>
                    </div>

                    <!-- Step 3: Confirmation -->
                    <div x-show="currentStep === 3" x-transition class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Confirmation</h3>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-2">Review Your Information</h4>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">Name:</dt>
                                    <dd class="text-gray-900" x-text="formData.name"></dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">Email:</dt>
                                    <dd class="text-gray-900" x-text="formData.email"></dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">Phone:</dt>
                                    <dd class="text-gray-900" x-text="formData.phone"></dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-600">Age:</dt>
                                    <dd class="text-gray-900" x-text="formData.age"></dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <div class="flex items-center">
                                <input type="checkbox"
                                       id="terms"
                                       name="terms"
                                       x-model="formData.terms"
                                       @change="validateField('terms')"
                                       :class="{'border-red-500': errors.terms}"
                                       class="mr-2"
                                       required>
                                <label for="terms" class="text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-blue-600 hover:text-blue-800">Terms and Conditions</a>
                                </label>
                            </div>
                            <p x-show="errors.terms" x-text="errors.terms" class="text-red-500 text-sm mt-1"></p>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="mt-8 flex justify-between">
                        <button type="button"
                                @click="prevStep()"
                                x-show="currentStep > 1"
                                class="bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-md hover:bg-gray-400 transition-colors duration-200">
                            Previous
                        </button>
                        <div x-show="currentStep === 1"></div>

                        <button type="button"
                                @click="nextStep()"
                                x-show="currentStep < 3"
                                class="bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-200">
                            Next
                        </button>

                        <button type="submit"
                                x-show="currentStep === 3"
                                :disabled="!isValid()"
                                :class="{'bg-blue-500 hover:bg-blue-600': isValid(), 'bg-gray-400 cursor-not-allowed': !isValid()}"
                                class="text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                            Submit Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Alpine.js Functions - Include this JavaScript
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
                            if (!this.formData.phone.trim()) {
                                this.errors.phone = 'Phone number is required';
                            } else if (!phoneRegex.test(this.formData.phone)) {
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
