<?php

namespace App\Domain\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryQueries
{
    public function getParentCategories(): Collection
    {
        return Category::select(['id', 'name'])->whereNull('parent_category_id')->get();
    }
}
