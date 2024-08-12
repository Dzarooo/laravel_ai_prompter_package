<?php

use Illuminate\Support\Facades\Route;
use Dzaro\AIPrompter\Controllers\ImageGeneratorController;
use Dzaro\AIPrompter\Controllers\TextGeneratorController;
use Dzaro\AIPrompter\Controllers\AIController;

Route::get('/image_generator', [ImageGeneratorController::class, 'show'])->name('AIPrompter_image_generator');

Route::post('/image_generator_save', [ImageGeneratorController::class, 'saveImages'])->name('AIPrompter_save_images');

Route::post('/image_generator', [AIController::class, 'generateImages'])->name('AIPrompter_generate_images');

Route::get('/text_generator', [TextGeneratorController::class, 'show'])->name('AIPrompter_text_generator');

Route::post('/text_generator', [AIController::class, 'generateText'])->name('AIPrompter_generate_text');