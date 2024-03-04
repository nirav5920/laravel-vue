<?php


namespace App\Domain\Product;

use App\Models\Product;

class ProductQueries
{
    public function productPaginateList()
    {
        return Product::select('id', 'name', 'price', 'status')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function add(array $validatedData)
    {
        Product::create($validatedData);
    }

    public function getProductById(int $productId): Product
    {
        return Product::select('id', 'name', 'price', 'status')->findOrFail($productId);
    }

    public function update(array $validatedData, int $productId)
    {
        $product = Product::select('id')->findOrFail($productId);
        $product->update($validatedData);
    }

    public function delete(int $productId)
    {
        Product::findOrFail($productId)->delete();
    }

    public function toggleStatus(int $productId)
    {
        $product = Product::select('id', 'status')->findOrFail($productId);
        $product->update([
            'status' => !$product->status,
        ]);
    }
}
