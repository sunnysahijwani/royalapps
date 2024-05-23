<?php

namespace App\Http\Controllers\AuthorController;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthorInterface;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // protected $AuthorInterface;
    protected $AuthorInterface;

    /**
     * Constructor for the class.
     *
     * @param AuthorInterface $AuthorInterface The AuthorInterface implementation.
     */
    public function __construct(AuthorInterface $AuthorInterface)
    {
        $this->AuthorInterface = $AuthorInterface;
    }

    /**
     * Retrieves a list of items based on the given request.
     *
     * @param Request $request The request object containing the parameters for the list.
     * @return mixed The list of items returned by the AuthorInterface implementation.
     */
    public function list(Request $request)
    {

        $data = $this->AuthorInterface->list($request);
        return view('author.authorList', $data);
    }

    public function view(Request $request, $id)
    {
        $data = $this->AuthorInterface->view($request, $id);
        return view('author.view', $data);
    }

    public function delete(Request $request, $id)
    {
        $data = $this->AuthorInterface->delete($request, $id);

        if ($data['code'] == 201) {
            return redirect()->route('list.author')->with('message', $data['msg']);
        }

        return redirect()->back()->with('Errors', $data['msg']);
    }

    public function search(Request $request)
    {
        return $this->AuthorInterface->search($request)['record'];
    }
    
}
