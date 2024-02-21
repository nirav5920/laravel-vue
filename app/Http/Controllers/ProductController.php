<?php

namespace App\Http\Controllers;

use App\Domain\Product\ProductQueries;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(protected ProductQueries $productQueries)
    {
    }

    public function index()
    {
        return Inertia::render('Products/list', [
            'products' => $this->productQueries->productPaginateList(),
        ]);
    }
}
