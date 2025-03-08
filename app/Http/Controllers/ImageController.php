<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function showWelcome()
    {
        $files = Image::all();
        return view('welcome', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        // Retrieve the first stored image
        $oldImage = Image::first();
        if ($oldImage) {
            $oldImagePath = public_path($oldImage->path);

            // Delete the file if it exists
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Remove the old record from the database
            $oldImage->delete();
        }

        // Upload new image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Save new image path in DB
        Image::create(['path' => 'images/' . $imageName]);

        return redirect()->route('dashboard')->with('success', 'Image uploaded successfully.');
    }
     public function download(Image $image)
    {
        $path = public_path($image->path);

        if (File::exists($path)) {
            return response()->download($path);
        }

        return redirect()->back()->with('error', 'File not found.');
    }
}
