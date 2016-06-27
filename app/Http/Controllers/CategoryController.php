<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller{
    public function getCategoryIndex(){
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.blog.categories', ['categories' => $categories]);

    }
}