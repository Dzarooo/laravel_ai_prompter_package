<?php
//Controller to manage views for creating text

namespace Dzaro\AIPrompter\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TextGeneratorController extends Controller {
    public function show() {
        return view('views::text_generator');
    }
}