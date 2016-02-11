<?php

namespace App\Http\Controllers\Backend;

use App\Models\Shop\Field;
use App\Models\Shop\Product;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    public function index()
    {
        $userCount =  User::count();
        $productCount =  Product::count();
        $fieldCount =  Field::count();
        $lastUsers = User::take(5)->get();
        $lastProducts = Product::take(5)->get();
        $lastFields = Field::take(5)->get();
        return view('backend.index',compact('userCount','categoryCount','productCount','lastUsers','lastProducts','fieldCount','lastFields'));
    }
}
