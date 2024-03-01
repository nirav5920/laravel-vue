<?php

namespace App\Http\Controllers;

use App\Domain\Product\ProductQueries;
use App\Http\Requests\ProductRequest;
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

    public function create()
    {
        return Inertia::render('Products/form');
    }

    public function store(ProductRequest $request)
    {
        $this->productQueries->add($request->validated());
        return to_route('products-list')->with('success', 'Product added successfully.');
    }

    public function edit(int $productId)
    {
        return Inertia::render('Products/form', [
            'product' => $this->productQueries->getProductById($productId),
        ]);
    }

    public function update(ProductRequest $request, int $productId)
    {
        $this->productQueries->update($request->validated(), $productId);
        return to_route('products-list')->with('success', 'Product updated successfully.');
    }
}
