<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SitemapController extends Controller
{
    public function index()
    {
        // Get all files from the sitemaps directory
        $files = Storage::disk('public')->files('sitemaps');

        return view('sitemap.index', ['files' => $files]);
    }
    // Display the upload form
    public function showUploadForm()
    {
        return view('sitemap.upload_sitemap');
    }

    // Handle the uploaded sitemap file
    public function upload(Request $request)
    {
        $request->validate([
            'sitemap' => 'required|file|mimes:xml|max:2048', // Restricting to XML files
        ]);

        // Store the sitemap in the public directory
        $path = $request->file('sitemap')->store('sitemaps', 'public');

        // You can return a response or redirect back with a message
        return redirect()->route('sitemap.index')->with('success', 'Sitemap uploaded successfully!')
            ->with('sitemapPath', $path); // Store path for download link
    }

    // Handle sitemap download
    public function download($fileName)
    {
        $filePath = public_path('storage/sitemaps/' . $fileName);

        if (!file_exists($filePath)) {
            abort(404); // Handle file not found
        }

        return response()->download($filePath);
    }

    public function delete($fileName)
    {
        $filePath = public_path('storage/sitemaps/' . $fileName);

        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file
            return redirect()->back()->with('success', 'Sitemap deleted successfully!');
        }

        return redirect()->back()->with('error', 'File not found!');
    }
}
