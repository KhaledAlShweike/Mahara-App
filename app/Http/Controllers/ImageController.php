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
        'Image' => 'required|Image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    $Image = $request->file('Image');
    $ImageName = time().'.'.$Image->extension();

    // Move the uploaded file to a directory (e.g., public/uploads)
    $Image->move(public_path('uploads'), $ImageName);

    // Save the Image path to the database
    $uploadedImage = Image::create([
        'title' => $request->input('title'),
        'Image_path' => 'uploads/'.$ImageName,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Image uploaded successfully',
        'data' => $uploadedImage,
    ]);
    }


    public function show($id)
{
    $Image = Image::findOrFail($id);

    return response()->file(public_path($Image->Image_path));
}

}
