@extends('layouts.app')

@section('title', 'Form Validation')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Form Validation Component</h1>
        <p class="text-gray-600">Client-side and server-side form validation with real-time feedback</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Demo</h2>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('functions.submit-form') }}"
              x-data="{
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
              }">
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
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                    @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                    @error('age')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                    @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                    @error('terms')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
@endsection
