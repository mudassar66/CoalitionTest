<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function store(Request $req){
        $productData = Storage::disk('local')->exists('products.json')?json_decode(Storage::disk('local')->get('products.json'),true) :['data'=>[]];
        $newData = $req->only(['productName','quantity','price']);
        $newData['Datetime'] = Date('Y-m-d H:i:s');
        //array_push($productData,$newData);
        $productData['data'][]= $newData;
        Storage::disk('local')->put('products.json',json_encode($productData));
        //dd($newData);

        return redirect('/')->with('status','Product added successfully');
    }
}
