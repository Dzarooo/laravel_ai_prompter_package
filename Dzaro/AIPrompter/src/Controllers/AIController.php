<?php
//Controller with functions returning AI responses to prompts.
//Probably use these functions only with ajax requests.

namespace Dzaro\AIPrompter\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class AIController extends Controller {
    public function generateText() {
        $response = Http::withToken(Config::get('aiprompter.openai_api_key'))
        ->baseUrl('https://api.openai.com/v1')
        ->post('chat/completions', [
            "model" => "gpt-4o-mini",
            "messages" => [
                [
                    "role" => "user",
                    "content" => "what is php?"
                ]
            ]
        ]);

    $data = $response->json();
    $message = $data['choices'][0]['message'];
    dd($message);
    }

    public function whyyoudothis() {
        echo "This is a test function for generating AI text.";
    }
}