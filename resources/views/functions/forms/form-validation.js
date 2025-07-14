// Form Validation JavaScript Functions
// Include this script in your blade template or layout

// Form validation function for Alpine.js
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

// Stepped form function for Alpine.js
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

// Form style switcher function
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

// Form structure switcher function
function switchFormStructure(structure) {
    document.querySelectorAll('.form-structure').forEach(form => {
        form.classList.add('hidden');
    });
    document.getElementById('form-' + structure).classList.remove('hidden');

    // Update tab styling
    document.querySelectorAll('.tab-button').forEach(tab => {
        tab.classList.remove('border-blue-500', 'text-blue-600');
        tab.classList.add('border-transparent', 'text-gray-500');
    });

    const activeTab = document.getElementById('tab-' + structure);
    if (activeTab) {
        activeTab.classList.remove('border-transparent', 'text-gray-500');
        activeTab.classList.add('border-blue-500', 'text-blue-600');
    }
}

// Initialize default settings
document.addEventListener('DOMContentLoaded', function() {
    // Set default form style
    switchFormStyle('default');

    // Set default form structure
    switchFormStructure('single');
});
