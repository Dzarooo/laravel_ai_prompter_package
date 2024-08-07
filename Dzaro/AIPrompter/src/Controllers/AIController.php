<?php
//Controller with functions returning AI responses to prompts.
//Probably use these functions only with ajax requests.

use App\Http\Controllers\Controller;
use OpenAI\Laravel\Facades\OpenAI;

class AIController extends Controller {
    public function generateText() {
        return "WOWOOWW SIEMANO MORDO";
    }
}