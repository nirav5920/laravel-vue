<?php

namespace App\Http\Controllers;

use App\Domain\Category\CategoryQueries;
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
        $categoryQueries = resolve(CategoryQueries::class);
        return Inertia::render('Products/form', [
            'parentCategories' => $categoryQueries->getParentCategories(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        $this->productQueries->add($request->validated());
        return to_route('products-list')->with('success', 'Product added successfully.');
    }

    public function edit(int $productId)
    {
        $categoryQueries = resolve(CategoryQueries::class);
        return Inertia::render('Products/form', [
            'product' => $this->productQueries->getProductById($productId),
            'parentCategories' => $categoryQueries->getParentCategories(),
        ]);
    }

    public function update(ProductRequest $request, int $productId)
    {
        $this->productQueries->update($request->validated(), $productId);
        return to_route('products-list')->with('success', 'Product updated successfully.');
    }

    public function delete(int $productId)
    {
        $this->productQueries->delete($productId);
        return to_route('products-list')->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(int $productId)
    {
        $this->productQueries->toggleStatus($productId);
        return to_route('products-list')->with('success', 'Product status updated');
    }
}
