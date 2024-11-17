<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;
use JoeDixon\Translation\Drivers\Translation;
use Illuminate\Validation\Rule;

class BooksController extends Controller
{
    private $translation;

    public function __construct(Translation $translation)
    {
      $this->translation = $translation;
    }

    /**
     * Display a listing of the books.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $books = Book::paginate(25);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $languages = $this->translation->allLanguages();
        return view('books.create',compact('languages'));
    }

    /**
     * Store a new book in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        Book::create($data);

        return redirect()->route('books.book.index')
            ->with('success_message', 'Book was successfully added.');
    }

    /**
     * Display the specified book.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $languages = $this->translation->allLanguages();

        return view('books.edit', compact('book','languages'));
    }

    /**
     * Update the specified book in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $book = Book::findOrFail($id);
        $book->update($data);

        return redirect()->route('books.book.index')
            ->with('success_message', 'Book was successfully updated.');
    }

    /**
     * Remove the specified book from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();

            return redirect()->route('books.book.index')
                ->with('success_message', 'Book was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request, $id = null)
    {
      $rules = [
        'lang' => [
          'string',
          'min:1',
          'nullable',
          Rule::unique('books', 'lang')->ignore($id), // Ensure `lang` is unique in `books` table; ignore current record if updating
        ],
        'file' => ['file', 'mimes:pdf', 'max:51200', 'nullable'], // PDF only, max size 50 MB
      ];


        $data = $request->validate($rules);

        if ($request->has('custom_delete_file')) {
            $data['file'] = null;
        }
        if ($request->hasFile('file')) {
            $data['file'] = $this->moveFile($request->file('file'));
        }



        return $data;
    }

    /**
     * Moves the attached file to the server.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }

        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }

    public function download()
    {
      $lang = app()->getLocale();

      $book = Book::where('lang', $lang)->firstOrFail();

      $filePath = 'public/' . $book->file;
//      dd($filePath);
      // Check if the file exists
      if (!Storage::exists($filePath)) {
        abort(404, 'File not found.');
      }

      // Return the file as a downloadable response
      return Storage::download($filePath);
    }

}
