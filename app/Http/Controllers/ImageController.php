<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'client_id' => 'required|integer',
            'image_category_id' => 'required|integer',
            'image' => 'required|image|max:5000'
        ]);

        $manager = new ImageManager(new Driver());

        $file = $request->file('image');

        $uploadPath = public_path('uploads');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $filename = uniqid() . '.webp';

        // caminho físico no servidor
        $fullPath = $uploadPath . '/' . $filename;

        // caminho público
        $publicPath = '/uploads/' . $filename;

        $image = $manager->read($file);
        $image->toWebp(80)->save($fullPath);

        $imageDb = Image::create([
            'client_id' => $request->client_id,
            'image_category_id' => $request->image_category_id,
            'file_name' => $filename,
            'path' => $publicPath
        ]);

        return response()->json([
            'success' => true,
            'url' => asset($publicPath),
            'image_id' => $imageDb->id
        ]);
    }
}