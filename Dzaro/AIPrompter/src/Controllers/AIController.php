<?php
//Controller with functions returning AI responses to prompts.
//Probably use these functions only with ajax requests.

namespace Dzaro\AIPrompter\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class AIController extends Controller {
    public function generateText(Request $request) {
        $prompt = $request->prompt;
        $messages = $request->messages;

        $response = Http::withToken(Config::get('aiprompter.openai_api_key'))
        ->baseUrl('https://api.openai.com/v1')
        ->post('chat/completions', [
            "model" => "gpt-4o-mini",
            "messages" => $messages
        ]);

        $data = $response->json();
        $message = $data['choices'][0]['message'];
        return response()->json(['success'=>$message]);
    }


    public function generateImages(Request $request) {
        $prompt = $request->prompt;
        $imageSize = $request->imageSize;
        $imageSize = $imageSize."x".$imageSize;
        $imagesAmount = Intval($request->imagesAmount);


        $response = Http::withToken(Config::get('aiprompter.openai_api_key'))
        ->baseUrl('https://api.openai.com/v1')
        ->post('images/generations', [
            "prompt" => $prompt,
            "model" => "dall-e-2",
            "size" => $imageSize,
            "n" => $imagesAmount,
        ]);

        $data = $response->json();
        return response()->json(['success'=>$data]);

        //return response()->json(['success'=>compact('prompt','imageSize','imagesAmount')]);
    }
}