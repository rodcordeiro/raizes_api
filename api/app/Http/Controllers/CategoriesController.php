<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('categories.index', ['categories' => Categories::all()]);
    }
    public function list()
    {
        return Categories::all();
    }
}
