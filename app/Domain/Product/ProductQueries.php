<?php


namespace App\Domain\Product;

use App\Models\Product;

class ProductQueries
{
    public function productPaginateList()
    {
        return Product::select('id', 'name', 'price')->paginate(10);
    }

    public function add(array $validatedData)
    {
        Product::create($validatedData);
    }
}
