<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    $productData = Storage::disk('local')->exists('products.json')?json_decode(Storage::disk('local')->get('products.json'),true) :[];
    //dd($productData);
    $products = (isset($productData['data']) && count($productData['data'])>0) ? $productData['data'] :[];
    return view('product-form',['products'=> $products]);
});
Route::post('/store',[ProductController::class,'store']);
