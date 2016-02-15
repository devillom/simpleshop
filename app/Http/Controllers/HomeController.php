<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Shop\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('fields')->take(4)->get();
        return view('frontend.home',compact('products'));
    }
}
