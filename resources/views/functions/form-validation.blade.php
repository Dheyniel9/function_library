@extends('layouts.app')

@section('title', 'Form Validation')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Form Validation Component</h1>
        <p class="text-gray-600">Client-side and server-side form validation with real-time feedback</p>
    </div>

    <!-- Design Style Selector -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Design Styles</h2>
        <div class="flex flex-wrap gap-2 mb-4">
            <button onclick="switchFormStyle('default')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" id="style-default">Default</button>
            <button onclick="switchFormStyle('minimalistic')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600" id="style-minimalistic">Minimalistic</button>
            <button onclick="switchFormStyle('modern')" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600" id="style-modern">Modern</button>
            <button onclick="switchFormStyle('clean')" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600" id="style-clean">Clean</button>
        </div>
    </div>

    <!-- Form Structure Tabs -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Form Structures</h2>
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-8">
                <button onclick="switchFormStructure('single')"
                        class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                        id="tab-single">
                    Single Column
                </button>
                <button onclick="switchFormStructure('two-column')"
                        class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                        id="tab-two-column">
                    Two Column
                </button>
                <button onclick="switchFormStructure('stepped')"
                        class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                        id="tab-stepped">
                    Stepped Form
                </button>
                <button onclick="switchFormStructure('grouped')"
                        class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                        id="tab-grouped">
                    Grouped Fields
                </button>
                <button onclick="switchFormStructure('inline')"
                        class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                        id="tab-inline">
                    Inline Form
                </button>
            </nav>
        </div>
    </div>

    <div id="form-container" class="bg-white rounded-lg shadow-md p-6 mb-8 form-default">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

    <div id="form-container" class="bg-white rounded-lg shadow-md p-6 mb-8 form-default">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Single Column Form -->
        <div id="form-single" class="form-structure">
            <form method="POST" action="{{ route('functions.submit-form') }}"
                  x-data="formValidation()">
                @csrf

                <div class="space-y-6">
                    <!-- Name Field -->
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

                    <!-- Email Field -->
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

                    <!-- Phone Field -->
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

                    <!-- Age Field -->
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

                    <!-- Password Field -->
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

                    <!-- Password Confirmation Field -->
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

                    <!-- Terms and Conditions -->
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

                <div class="mt-8">
                    <button type="submit"
                            :disabled="!isValid()"
                            :class="{'bg-blue-500 hover:bg-blue-600': isValid(), 'bg-gray-400 cursor-not-allowed': !isValid()}"
                            class="w-full text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                        Submit Form
                    </button>
                </div>
            </form>
        </div>

        <!-- Two Column Form -->
        <div id="form-two-column" class="form-structure hidden">
            <form method="POST" action="{{ route('functions.submit-form') }}"
                  x-data="formValidation()">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Name Field -->
                        <div>
                            <label for="name2" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text"
                                   id="name2"
                                   name="name"
                                   x-model="formData.name"
                                   @blur="validateField('name')"
                                   :class="{'border-red-500': errors.name, 'border-green-500': !errors.name && formData.name}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <!-- Phone Field -->
                        <div>
                            <label for="phone2" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel"
                                   id="phone2"
                                   name="phone"
                                   x-model="formData.phone"
                                   @blur="validateField('phone')"
                                   :class="{'border-red-500': errors.phone, 'border-green-500': !errors.phone && formData.phone}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.phone" x-text="errors.phone" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password2" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password"
                                   id="password2"
                                   name="password"
                                   x-model="formData.password"
                                   @blur="validateField('password')"
                                   :class="{'border-red-500': errors.password, 'border-green-500': !errors.password && formData.password}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.password" x-text="errors.password" class="text-red-500 text-sm mt-1"></p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Email Field -->
                        <div>
                            <label for="email2" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email"
                                   id="email2"
                                   name="email"
                                   x-model="formData.email"
                                   @blur="validateField('email')"
                                   :class="{'border-red-500': errors.email, 'border-green-500': !errors.email && formData.email}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.email" x-text="errors.email" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <!-- Age Field -->
                        <div>
                            <label for="age2" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                            <input type="number"
                                   id="age2"
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

                        <!-- Password Confirmation Field -->
                        <div>
                            <label for="password_confirmation2" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input type="password"
                                   id="password_confirmation2"
                                   name="password_confirmation"
                                   x-model="formData.password_confirmation"
                                   @blur="validateField('password_confirmation')"
                                   :class="{'border-red-500': errors.password_confirmation, 'border-green-500': !errors.password_confirmation && formData.password_confirmation}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.password_confirmation" x-text="errors.password_confirmation" class="text-red-500 text-sm mt-1"></p>
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="mt-6">
                    <div class="flex items-center">
                        <input type="checkbox"
                               id="terms2"
                               name="terms"
                               x-model="formData.terms"
                               @change="validateField('terms')"
                               :class="{'border-red-500': errors.terms}"
                               class="mr-2"
                               required>
                        <label for="terms2" class="text-sm text-gray-700">
                            I agree to the <a href="#" class="text-blue-600 hover:text-blue-800">Terms and Conditions</a>
                        </label>
                    </div>
                    <p x-show="errors.terms" x-text="errors.terms" class="text-red-500 text-sm mt-1"></p>
                </div>

                <div class="mt-8">
                    <button type="submit"
                            :disabled="!isValid()"
                            :class="{'bg-blue-500 hover:bg-blue-600': isValid(), 'bg-gray-400 cursor-not-allowed': !isValid()}"
                            class="w-full text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                        Submit Form
                    </button>
                </div>
            </form>
        </div>

        <!-- Stepped Form -->
        <div id="form-stepped" class="form-structure hidden">
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

                <form method="POST" action="{{ route('functions.submit-form') }}" x-data="formValidation()">
                    @csrf

                    <!-- Step 1: Personal Information -->
                    <div x-show="currentStep === 1" x-transition class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>

                        <div>
                            <label for="name3" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text"
                                   id="name3"
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
                                <label for="email3" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email"
                                       id="email3"
                                       name="email"
                                       x-model="formData.email"
                                       @blur="validateField('email')"
                                       :class="{'border-red-500': errors.email, 'border-green-500': !errors.email && formData.email}"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       required>
                                <p x-show="errors.email" x-text="errors.email" class="text-red-500 text-sm mt-1"></p>
                            </div>

                            <div>
                                <label for="phone3" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel"
                                       id="phone3"
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
                            <label for="age3" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                            <input type="number"
                                   id="age3"
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
                            <label for="password3" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password"
                                   id="password3"
                                   name="password"
                                   x-model="formData.password"
                                   @blur="validateField('password')"
                                   :class="{'border-red-500': errors.password, 'border-green-500': !errors.password && formData.password}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.password" x-text="errors.password" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div>
                            <label for="password_confirmation3" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input type="password"
                                   id="password_confirmation3"
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
                                       id="terms3"
                                       name="terms"
                                       x-model="formData.terms"
                                       @change="validateField('terms')"
                                       :class="{'border-red-500': errors.terms}"
                                       class="mr-2"
                                       required>
                                <label for="terms3" class="text-sm text-gray-700">
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

        <!-- Grouped Fields Form -->
        <div id="form-grouped" class="form-structure hidden">
            <form method="POST" action="{{ route('functions.submit-form') }}"
                  x-data="formValidation()">
                @csrf

                <!-- Personal Information Group -->
                <fieldset class="mb-8 p-6 border border-gray-200 rounded-lg">
                    <legend class="text-lg font-medium text-gray-900 px-2">Personal Information</legend>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="name4" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text"
                                   id="name4"
                                   name="name"
                                   x-model="formData.name"
                                   @blur="validateField('name')"
                                   :class="{'border-red-500': errors.name, 'border-green-500': !errors.name && formData.name}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div>
                            <label for="age4" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                            <input type="number"
                                   id="age4"
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
                </fieldset>

                <!-- Contact Information Group -->
                <fieldset class="mb-8 p-6 border border-gray-200 rounded-lg">
                    <legend class="text-lg font-medium text-gray-900 px-2">Contact Information</legend>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="email4" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email"
                                   id="email4"
                                   name="email"
                                   x-model="formData.email"
                                   @blur="validateField('email')"
                                   :class="{'border-red-500': errors.email, 'border-green-500': !errors.email && formData.email}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.email" x-text="errors.email" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div>
                            <label for="phone4" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel"
                                   id="phone4"
                                   name="phone"
                                   x-model="formData.phone"
                                   @blur="validateField('phone')"
                                   :class="{'border-red-500': errors.phone, 'border-green-500': !errors.phone && formData.phone}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.phone" x-text="errors.phone" class="text-red-500 text-sm mt-1"></p>
                        </div>
                    </div>
                </fieldset>

                <!-- Security Group -->
                <fieldset class="mb-8 p-6 border border-gray-200 rounded-lg">
                    <legend class="text-lg font-medium text-gray-900 px-2">Security</legend>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="password4" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password"
                                   id="password4"
                                   name="password"
                                   x-model="formData.password"
                                   @blur="validateField('password')"
                                   :class="{'border-red-500': errors.password, 'border-green-500': !errors.password && formData.password}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.password" x-text="errors.password" class="text-red-500 text-sm mt-1"></p>
                        </div>

                        <div>
                            <label for="password_confirmation4" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input type="password"
                                   id="password_confirmation4"
                                   name="password_confirmation"
                                   x-model="formData.password_confirmation"
                                   @blur="validateField('password_confirmation')"
                                   :class="{'border-red-500': errors.password_confirmation, 'border-green-500': !errors.password_confirmation && formData.password_confirmation}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.password_confirmation" x-text="errors.password_confirmation" class="text-red-500 text-sm mt-1"></p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="flex items-center">
                            <input type="checkbox"
                                   id="terms4"
                                   name="terms"
                                   x-model="formData.terms"
                                   @change="validateField('terms')"
                                   :class="{'border-red-500': errors.terms}"
                                   class="mr-2"
                                   required>
                            <label for="terms4" class="text-sm text-gray-700">
                                I agree to the <a href="#" class="text-blue-600 hover:text-blue-800">Terms and Conditions</a>
                            </label>
                        </div>
                        <p x-show="errors.terms" x-text="errors.terms" class="text-red-500 text-sm mt-1"></p>
                    </div>
                </fieldset>

                <div class="mt-8">
                    <button type="submit"
                            :disabled="!isValid()"
                            :class="{'bg-blue-500 hover:bg-blue-600': isValid(), 'bg-gray-400 cursor-not-allowed': !isValid()}"
                            class="w-full text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                        Submit Form
                    </button>
                </div>
            </form>
        </div>

        <!-- Inline Form -->
        <div id="form-inline" class="form-structure hidden">
            <form method="POST" action="{{ route('functions.submit-form') }}"
                  x-data="formValidation()">
                @csrf

                <div class="space-y-4">
                    <!-- Row 1 -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="name5" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text"
                                   id="name5"
                                   name="name"
                                   x-model="formData.name"
                                   @blur="validateField('name')"
                                   :class="{'border-red-500': errors.name, 'border-green-500': !errors.name && formData.name}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-xs mt-1"></p>
                        </div>

                        <div>
                            <label for="email5" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email"
                                   id="email5"
                                   name="email"
                                   x-model="formData.email"
                                   @blur="validateField('email')"
                                   :class="{'border-red-500': errors.email, 'border-green-500': !errors.email && formData.email}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.email" x-text="errors.email" class="text-red-500 text-xs mt-1"></p>
                        </div>

                        <div>
                            <label for="phone5" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel"
                                   id="phone5"
                                   name="phone"
                                   x-model="formData.phone"
                                   @blur="validateField('phone')"
                                   :class="{'border-red-500': errors.phone, 'border-green-500': !errors.phone && formData.phone}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.phone" x-text="errors.phone" class="text-red-500 text-xs mt-1"></p>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="age5" class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                            <input type="number"
                                   id="age5"
                                   name="age"
                                   x-model="formData.age"
                                   @blur="validateField('age')"
                                   :class="{'border-red-500': errors.age, 'border-green-500': !errors.age && formData.age}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   min="18"
                                   max="100"
                                   required>
                            <p x-show="errors.age" x-text="errors.age" class="text-red-500 text-xs mt-1"></p>
                        </div>

                        <div>
                            <label for="password5" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password"
                                   id="password5"
                                   name="password"
                                   x-model="formData.password"
                                   @blur="validateField('password')"
                                   :class="{'border-red-500': errors.password, 'border-green-500': !errors.password && formData.password}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.password" x-text="errors.password" class="text-red-500 text-xs mt-1"></p>
                        </div>

                        <div>
                            <label for="password_confirmation5" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input type="password"
                                   id="password_confirmation5"
                                   name="password_confirmation"
                                   x-model="formData.password_confirmation"
                                   @blur="validateField('password_confirmation')"
                                   :class="{'border-red-500': errors.password_confirmation, 'border-green-500': !errors.password_confirmation && formData.password_confirmation}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                            <p x-show="errors.password_confirmation" x-text="errors.password_confirmation" class="text-red-500 text-xs mt-1"></p>
                        </div>
                    </div>

                    <!-- Terms and Submit Row -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-center">
                            <input type="checkbox"
                                   id="terms5"
                                   name="terms"
                                   x-model="formData.terms"
                                   @change="validateField('terms')"
                                   :class="{'border-red-500': errors.terms}"
                                   class="mr-2"
                                   required>
                            <label for="terms5" class="text-sm text-gray-700">
                                I agree to the <a href="#" class="text-blue-600 hover:text-blue-800">Terms and Conditions</a>
                            </label>
                        </div>

                        <button type="submit"
                                :disabled="!isValid()"
                                :class="{'bg-blue-500 hover:bg-blue-600': isValid(), 'bg-gray-400 cursor-not-allowed': !isValid()}"
                                class="text-white font-medium py-2 px-6 rounded-md transition-colors duration-200">
                            Submit Form
                        </button>
                    </div>
                    <p x-show="errors.terms" x-text="errors.terms" class="text-red-500 text-xs mt-1"></p>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Code Example</h2>

        <div class="bg-gray-100 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-800"><code>// Controller Validation
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

// Client-side Validation with Alpine.js
&lt;form x-data="{
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
            // ... more validation cases
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
}"&gt;</code></pre>
        </div>
    </div>
</div>

<style>
/* Default Form Style */
.form-default input, .form-default textarea, .form-default select {
    @apply w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500;
}

.form-default label {
    @apply block text-sm font-medium text-gray-700 mb-2;
}

.form-default .error {
    @apply text-red-500 text-sm mt-1;
}

/* Minimalistic Form Style */
.form-minimalistic {
    @apply bg-gray-50 border-0 shadow-none p-8;
}

.form-minimalistic input, .form-minimalistic textarea, .form-minimalistic select {
    @apply w-full border-0 border-b-2 border-gray-200 bg-transparent px-0 py-3 focus:outline-none focus:ring-0 focus:border-black rounded-none;
}

.form-minimalistic label {
    @apply block text-xs uppercase tracking-wider text-gray-500 mb-1 font-normal;
}

.form-minimalistic .error {
    @apply text-red-400 text-xs mt-1 font-light;
}

.form-minimalistic button {
    @apply bg-black text-white border-0 px-8 py-3 uppercase tracking-wider text-sm font-light hover:bg-gray-800;
}

/* Modern Form Style */
.form-modern {
    @apply bg-gradient-to-br from-blue-50 to-purple-50 border-0 shadow-xl p-8;
}

.form-modern input, .form-modern textarea, .form-modern select {
    @apply w-full border-2 border-transparent bg-white rounded-lg px-4 py-3 focus:outline-none focus:ring-0 focus:border-blue-500 shadow-sm;
}

.form-modern label {
    @apply block text-sm font-semibold text-gray-700 mb-2;
}

.form-modern .error {
    @apply text-red-500 text-sm mt-1;
}

.form-modern button {
    @apply bg-gradient-to-r from-blue-500 to-purple-600 text-white border-0 px-6 py-3 rounded-lg font-medium hover:from-blue-600 hover:to-purple-700 shadow-lg;
}

/* Clean Form Style */
.form-clean {
    @apply bg-white border border-gray-100 shadow-sm p-8;
}

.form-clean input, .form-clean textarea, .form-clean select {
    @apply w-full border border-gray-200 bg-gray-50 rounded-sm px-4 py-3 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 focus:bg-white;
}

.form-clean label {
    @apply block text-sm text-gray-600 mb-2 font-medium;
}

.form-clean .error {
    @apply text-red-500 text-sm mt-1;
}

.form-clean button {
    @apply bg-green-500 text-white border-0 px-6 py-3 rounded-sm font-medium hover:bg-green-600;
}
</style>

<script>
function switchFormStyle(style) {
    const formContainer = document.getElementById('form-container');
    const buttons = document.querySelectorAll('[id^="style-"]');

    // Remove all form style classes
    formContainer.className = formContainer.className.replace(/form-\w+/g, '');

    // Add new style class
    formContainer.classList.add(`form-${style}`);

    // Update button states
    buttons.forEach(btn => {
        btn.classList.remove('bg-blue-600', 'bg-gray-600', 'bg-purple-600', 'bg-green-600');
        btn.classList.add('bg-blue-500', 'bg-gray-500', 'bg-purple-500', 'bg-green-500');
    });

    // Highlight active button
    const activeBtn = document.getElementById(`style-${style}`);
    if (activeBtn) {
        activeBtn.classList.remove('bg-blue-500', 'bg-gray-500', 'bg-purple-500', 'bg-green-500');
        activeBtn.classList.add(`bg-${style === 'default' ? 'blue' : style === 'minimalistic' ? 'gray' : style === 'modern' ? 'purple' : 'green'}-600`);
    }
}

function switchFormStructure(structure) {
    document.querySelectorAll('.form-structure').forEach(form => {
        form.classList.add('hidden');
    });
    document.getElementById('form-' + structure).classList.remove('hidden');

    // Update tab styling
    document.querySelectorAll('.structure-tab').forEach(tab => {
        tab.classList.remove('bg-blue-500', 'text-white');
        tab.classList.add('bg-gray-200', 'text-gray-700');
    });
    event.target.classList.add('bg-blue-500', 'text-white');
    event.target.classList.remove('bg-gray-200', 'text-gray-700');
}

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

// Stepped form function
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

// Initialize with default style
document.addEventListener('DOMContentLoaded', function() {
    switchFormStyle('default');
});
</script>

@endsection
