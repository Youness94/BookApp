<?php

namespace App\Http\Controllers;
use App\Author;
use Illuminate\Http\Request;

class AothorController extends Controller
{
    function getBooks($id)
    {

        return Author::find($id)->books;
        
    }
}
