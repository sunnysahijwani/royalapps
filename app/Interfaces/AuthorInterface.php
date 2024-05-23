<?php

namespace App\Interfaces;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;


interface AuthorInterface
{
    public function list(Request $request);
    public function view(Request $request, $Id);
    public function search(Request $request);
    public function delete(Request $request, $id);

}

?>