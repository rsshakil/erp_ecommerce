<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ImageController extends Controller
{
    //
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $image = $request->file;
            $name = $request->name.'.jpg';
            $path = 'public/images/products' . $name;

            $img = Image::make($image);

            Storage::disk('local')->put($path, $img->encode());

            $url = asset('storage/images/products/' . $name);

            return response()->json(['url' => $url,'name'=>$name]);
        }

        return response()->json(['error' => 'No file']);
    }
}
