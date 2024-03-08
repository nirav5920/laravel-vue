<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'nirav@freshbits.in',
            'password' => Hash::make('password'),
        ]);

        Product::factory(15)->create();
        $categories = Category::factory(10)->create();
        foreach ($categories as $category) {
            Category::factory()->create([
                'parent_category_id' => $category->id
            ]);
        }
    }
}
