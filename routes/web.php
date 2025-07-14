<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FunctionController;

Route::get('/', [FunctionController::class, 'index'])->name('functions.index');

// Function Routes
Route::get('/accordion', [FunctionController::class, 'accordion'])->name('functions.accordion');
Route::get('/data-table', [FunctionController::class, 'dataTable'])->name('functions.data-table');
Route::get('/advanced-filter', [FunctionController::class, 'advancedFilter'])->name('functions.advanced-filter');
Route::get('/modal', [FunctionController::class, 'modal'])->name('functions.modal');
Route::get('/form-validation', [FunctionController::class, 'formValidation'])->name('functions.form-validation');
Route::post('/form-validation', [FunctionController::class, 'submitForm'])->name('functions.submit-form');
Route::get('/pagination', [FunctionController::class, 'pagination'])->name('functions.pagination');
Route::get('/search', [FunctionController::class, 'search'])->name('functions.search');
Route::get('/tabs', [FunctionController::class, 'tabs'])->name('functions.tabs');
Route::get('/tooltip', [FunctionController::class, 'tooltip'])->name('functions.tooltip');
Route::get('/image-gallery', [FunctionController::class, 'imageGallery'])->name('functions.image-gallery');
Route::get('/dashboard', [FunctionController::class, 'dashboard'])->name('functions.dashboard');

// Additional 10 useful functions
Route::get('/file-upload', [FunctionController::class, 'fileUpload'])->name('functions.file-upload');
Route::get('/infinite-scroll', [FunctionController::class, 'infiniteScroll'])->name('functions.infinite-scroll');
Route::get('/drag-drop', [FunctionController::class, 'dragDrop'])->name('functions.drag-drop');
Route::get('/chart', [FunctionController::class, 'chart'])->name('functions.chart');
Route::get('/calendar', [FunctionController::class, 'calendar'])->name('functions.calendar');
Route::get('/notification', [FunctionController::class, 'notification'])->name('functions.notification');
Route::get('/export-data', [FunctionController::class, 'exportData'])->name('functions.export-data');
Route::get('/qr-code', [FunctionController::class, 'qrCode'])->name('functions.qr-code');
Route::get('/qr-generator', [FunctionController::class, 'qrGenerator'])->name('functions.qr-generator');
Route::get('/calculator', [FunctionController::class, 'calculator'])->name('functions.calculator');
Route::get('/color-picker', [FunctionController::class, 'colorPicker'])->name('functions.color-picker');
Route::get('/card-designs', [FunctionController::class, 'cardDesigns'])->name('functions.card-designs');

// Container utility routes
Route::get('/container-layouts', [FunctionController::class, 'containerLayouts'])->name('functions.container-layouts');
Route::get('/flexbox-container', [FunctionController::class, 'flexboxContainer'])->name('functions.flexbox-container');
Route::get('/grid-container', [FunctionController::class, 'gridContainer'])->name('functions.grid-container');
Route::get('/responsive-container', [FunctionController::class, 'responsiveContainer'])->name('functions.responsive-container');

// Table utility routes
Route::get('/advanced-table', [FunctionController::class, 'advancedTable'])->name('functions.advanced-table');
Route::get('/editable-table', [FunctionController::class, 'editableTable'])->name('functions.editable-table');
Route::get('/comparison-table', [FunctionController::class, 'comparisionTable'])->name('functions.comparison-table');
Route::get('/breadcrumb', [FunctionController::class, 'breadcrumb'])->name('functions.breadcrumb');
Route::get('/dark-mode', [FunctionController::class, 'darkMode'])->name('functions.dark-mode');

// Additional 5 more useful functions
Route::get('/multi-step-form', [FunctionController::class, 'multiStepForm'])->name('functions.multi-step-form');
Route::get('/real-time-chat', [FunctionController::class, 'realTimeChat'])->name('functions.real-time-chat');
Route::get('/image-editor', [FunctionController::class, 'imageEditor'])->name('functions.image-editor');
Route::get('/api-testing', [FunctionController::class, 'apiTesting'])->name('functions.api-testing');
Route::get('/progress-tracker', [FunctionController::class, 'progressTracker'])->name('functions.progress-tracker');
