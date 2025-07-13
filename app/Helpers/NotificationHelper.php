<?php

namespace App\Helpers;

class NotificationHelper
{
    /**
     * Flash a success notification to the session
     */
    public static function success($message, $title = null)
    {
        session()->flash('notification', [
            'type' => 'success',
            'message' => $message,
            'title' => $title
        ]);
    }

    /**
     * Flash an error notification to the session
     */
    public static function error($message, $title = null)
    {
        session()->flash('notification', [
            'type' => 'error',
            'message' => $message,
            'title' => $title
        ]);
    }

    /**
     * Flash a warning notification to the session
     */
    public static function warning($message, $title = null)
    {
        session()->flash('notification', [
            'type' => 'warning',
            'message' => $message,
            'title' => $title
        ]);
    }

    /**
     * Flash an info notification to the session
     */
    public static function info($message, $title = null)
    {
        session()->flash('notification', [
            'type' => 'info',
            'message' => $message,
            'title' => $title
        ]);
    }

    /**
     * Flash validation errors as notifications
     */
    public static function validationErrors($errors)
    {
        $errorMessages = [];

        if (is_array($errors)) {
            foreach ($errors as $field => $messages) {
                if (is_array($messages)) {
                    $errorMessages = array_merge($errorMessages, $messages);
                } else {
                    $errorMessages[] = $messages;
                }
            }
        } else {
            $errorMessages[] = $errors;
        }

        session()->flash('notification', [
            'type' => 'error',
            'message' => implode('<br>', $errorMessages),
            'title' => 'Validation Errors'
        ]);
    }

    /**
     * Flash multiple notifications
     */
    public static function multiple($notifications)
    {
        session()->flash('notifications', $notifications);
    }
}

// Global helper functions
if (!function_exists('notify_success')) {
    function notify_success($message, $title = null) {
        NotificationHelper::success($message, $title);
    }
}

if (!function_exists('notify_error')) {
    function notify_error($message, $title = null) {
        NotificationHelper::error($message, $title);
    }
}

if (!function_exists('notify_warning')) {
    function notify_warning($message, $title = null) {
        NotificationHelper::warning($message, $title);
    }
}

if (!function_exists('notify_info')) {
    function notify_info($message, $title = null) {
        NotificationHelper::info($message, $title);
    }
}

if (!function_exists('notify_validation')) {
    function notify_validation($errors) {
        NotificationHelper::validationErrors($errors);
    }
}
