<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Uploader\Uploader;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::with('forums')
			->orderBy('order')
            ->get();

        return view('index', compact('categories'));
    }

    public function test(Request $request)
    {
		try {
			$uploadedFile = Uploader::getUploader($request->file('document'))
				->process();
			dd($uploadedFile);
		} catch (\Exception $exception) {
			dd($exception->getMessage());
		}

    }

    public function showForm()
    {
        return view('upload');
    }
}
