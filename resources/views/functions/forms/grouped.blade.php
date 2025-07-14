{{-- Grouped Fields Form Structure --}}
<div id="form-grouped" class="form-structure hidden">
    <form method="POST" action="{{ route('functions.submit-form') }}" x-data="formValidation()">
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
