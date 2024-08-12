<?php
//Controller to manage views for creating images

namespace Dzaro\AIPrompter\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageGeneratorController extends Controller {
    public function show() {
        return view('views::image_generator');
    }

    public function saveImages(Request $request) {
        $storagePath = $request->storagePath;
        $images = $request->images;
        $relativeStoragePath = explode('storage/app', $storagePath)[1];
        
        $data = $relativeStoragePath;
        if(Storage::disk('local')->exists($relativeStoragePath)) {
            foreach($images as $image) {
                $content = file_get_contents($image);
                Storage::disk('local')->put($relativeStoragePath.'/'.uniqid().'.png', $content);
            }
            return response()->json(['success' => "route: ".$data]);
        }
        else {
            return response()->json(['error' => 'Storage path not found: '.$relativeStoragePath]);
        }

    }
}