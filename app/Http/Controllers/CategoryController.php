<?php

namespace App\Http\Controllers;

use App\Domain\Category\CategoryQueries;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(protected CategoryQueries $categoryQueries)
    {
    }

    public function getParentCategories()
    {
        return $this->categoryQueries->getParentCategories();
    }
}
