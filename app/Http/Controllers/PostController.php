<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->get('category_id');
        $category = Category::find($category_id);
        if ($category === null) {
            return Post::with('categories')->get();
        }

        $categories = Category::descendantOf($category)->get();
        return Post::whereHas('categories', function ($query) use($categories) {
            return $query->whereIn('category_id',$categories->pluck('id'));
        })->with('categories')->get();
    }
}
