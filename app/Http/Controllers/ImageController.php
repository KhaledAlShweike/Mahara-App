<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ImageController extends Controller
{
    public function upload(Request $request)
    {$request->validate([
        'title' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    $image = $request->file('image');
    $imageName = time().'.'.$image->extension();

    // Move the uploaded file to a directory (e.g., public/uploads)
    $image->move(public_path('uploads'), $imageName);

    // Save the image path to the database
    $uploadedImage = Image::create([
        'title' => $request->input('title'),
        'image_path' => 'uploads/'.$imageName,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Image uploaded successfully',
        'data' => $uploadedImage,
    ]);
    }


    public function show($id)
{
    $image = Image::findOrFail($id);

    return response()->file(public_path($image->image_path));
}

}
