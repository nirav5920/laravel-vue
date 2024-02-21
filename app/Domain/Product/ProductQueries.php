<?php


namespace App\Domain\Product;

use App\Models\Product;

class ProductQueries
{
    public function productPaginateList()
    {
        return Product::select('id', 'name', 'price')->get();
    }
}
