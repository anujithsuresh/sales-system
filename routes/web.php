<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Enquiry;
use Illuminate\Http\Request;

// User
// Route::get('/', [FrontendController::class, 'index']);
Route::get('/', function () {
    return redirect()->route('register');
});
Route::post('/enquiry', [FrontendController::class, 'store']);

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('enquiries', EnquiryController::class);
});


Route::get('/dashboard', function (Request $request) {

    $query = Enquiry::with('product');

    if ($request->from && $request->to) {
        $query->whereBetween('date', [$request->from, $request->to]);
    }

    return view('dashboard', [
        'categories' => Category::all(),
        'products' => Product::with('category')->get(),
        'enquiries' => $query->latest()->get(),
    ]);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

    // CATEGORY
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    // PRODUCT
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // PRODUCT LIST
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);



    // frontend
    Route::get('/enquiry/{id}', [FrontendController::class, 'enquiryForm'])->name('enquiry.form');
    Route::post('/enquiry', [FrontendController::class, 'storeEnquiry'])->name('enquiry.store');

    // admin
    Route::resource('enquiries', EnquiryController::class)->only(['index', 'update']);
    Route::get('/', [FrontendController::class, 'index']);
    // Route::get('/enquiries/pdf', [EnquiryController::class, 'exportPdf'])->name('enquiries.pdf');
    Route::resource('enquiries', EnquiryController::class)->only(['index', 'update', 'destroy']);

    Route::get('/admin/enquiries/pdf', [EnquiryController::class, 'exportPdf'])->name('enquiries.pdf');
});
require __DIR__ . '/auth.php';
