<?php


namespace App\Domain\Product;

use App\Models\Product;

class ProductQueries
{
    public function productPaginateList()
    {
        return Product::select('id', 'name', 'price')->orderBy('created_at', 'desc')->paginate(10);
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
}
