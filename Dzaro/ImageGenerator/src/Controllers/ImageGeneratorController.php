<?php

namespace Dzaro\ImageGenerator\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageGeneratorController extends Controller {
    public function show() {
        return view('views::image_generator');
    }
}