<?php

namespace App\Interfaces;

use Illuminate\Http\Request;


interface BookInterface
{
    public function delete(Request $request, $id);
    public function store(Request $request);
}

?>