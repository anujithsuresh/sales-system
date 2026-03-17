<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EnquirySeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        foreach (range(1, 20) as $i) {

            $product = $products->random();

            Enquiry::create([
                'date' => Carbon::now()->subDays(rand(0, 10)),
                'product_id' => $product->id,
                'category_name' => $product->category->name,
                'amount' => $product->price,
                'name' => fake()->name(),
                'address' => fake()->address(),
                'quantity' => rand(1, 5),
                'mobile' => '9' . rand(100000000, 999999999),
                'contacted' => rand(0, 1),
                'remark' => fake()->sentence(),
            ]);
        }
    }
}
