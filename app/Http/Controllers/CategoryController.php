<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('left')->get();

        return $this->parseNode($categories, PHP_INT_MAX);
    }

    private function parseNode($categories, int $right): array
    {
        static $i = 0;
        $res = [];
        while ($i < count($categories)) {
            $category = $categories[$i];
            if ($category->right > $right) {
                break;
            }
            $i++;
            $node = [
                'id' => $category->id,
                'name' => $category->name,
            ];
            if (($category->right - $category->left) > 1) {
                $node['children'] = $this->parseNode($categories, $category->right);
            }
            $res[] = $node;
        }
        return $res;
    }
}
