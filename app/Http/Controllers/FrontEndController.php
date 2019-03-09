<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    // Index page containing products paginated
    public function index(){
        return view('index', ['products'=>Product::paginate(3)]);
    }

    // Viewing a single product 
    public function singleProduct($id){
        return view('single', ['product'=>Product::find($id)]);
    }
}
