<?php

namespace App\Http\Controllers\BookController;

use App\Http\Controllers\Controller;
use App\Interfaces\BookInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    protected $bookInterface;
    public function __construct(BookInterface $bookInterface)
    {
        $this->bookInterface = $bookInterface;
    }

    public function delete(Request $request, $id)
    {
        $data = $this->bookInterface->delete($request, $id);

        if ($data['code'] == 201) {
            Session::flash('message', $data['msg']);
        } else {
            Session::flash('Errors', "Book Not Deleted!");
        }

        return redirect()->back();
    }

    public function create(Request $request)
    {
        $data = $this->bookInterface->create($request);
        return view('book.createBook', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'release_date' => 'required',
            'isbn' => 'required',
            'format' => 'required',
            'number_of_pages' => 'required|numeric',
            'description' => 'required',
        ]);

        $data = $this->bookInterface->store($request);
        if ($data['code'] == 201) {
            Session::flash('message', $data['msg']);
        } else {
            Session::flash('Errors', "Book Not Created!");
        }
        return view('book.createBook', $data);
    }
}
