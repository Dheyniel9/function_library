<?php

// Form Validation Helper for Laravel Controllers
// Copy this code into your controller or create a separate helper class

class FormValidationHelper
{
    /**
     * Get validation rules for form fields
     */
    public static function getValidationRules()
    {
        return [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'age' => 'required|integer|min:18|max:100',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted',
        ];
    }

    /**
     * Get custom validation messages
     */
    public static function getValidationMessages()
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters',
            'name.max' => 'Name cannot exceed 255 characters',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'phone.required' => 'Phone number is required',
            'phone.regex' => 'Please enter a valid phone number (10-15 digits)',
            'age.required' => 'Age is required',
            'age.min' => 'You must be at least 18 years old',
            'age.max' => 'Please enter a valid age',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'terms.required' => 'You must accept the terms and conditions',
            'terms.accepted' => 'You must accept the terms and conditions',
        ];
    }

    /**
     * Process form submission
     */
    public static function processForm($request)
    {
        $validatedData = $request->validate(
            self::getValidationRules(),
            self::getValidationMessages()
        );

        // Remove password confirmation as it's not needed for storage
        unset($validatedData['password_confirmation']);
        unset($validatedData['terms']);

        // Hash the password
        $validatedData['password'] = bcrypt($validatedData['password']);

        return $validatedData;
    }
}

// Example usage in your controller:
/*
public function submitForm(Request $request)
{
    try {
        $validatedData = FormValidationHelper::processForm($request);

        // Save to database or process the data
        // User::create($validatedData);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->errors())->withInput();
    }
}
*/
