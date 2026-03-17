<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->category, function ($q) use ($request) {
            $q->where('category_id', $request->category);
        })->get();

        return view('frontend.index', [
            'products' => Product::with('category')->get()
        ]);
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        Enquiry::create([
            'date' => now(),
            'product_id' => $product->id,
            'category_name' => $product->category->name,
            'amount' => $product->price,
            'name' => $request->name,
            'address' => $request->address,
            'quantity' => $request->quantity,
            'mobile' => $request->mobile
        ]);

        return back()->with('success', 'Enquiry Submitted');
    }
}
