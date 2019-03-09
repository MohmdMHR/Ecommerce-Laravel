<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Viewing all products on the site, paginated
    public function index()
    {
        return view('product.index', ['products'=>Product::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validating
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'image'=>'required|image',
        ]);

        // Storing the request data in a product variable
        $product=new Product;

        // Saving the image, with a proper name
        $product_image=$request->image;
        $product_image_new_name=time() . $product_image->getClientOriginalName();
        $product_image->move('uploads/product', $product_image_new_name);

        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->image='uploads/product/' . $product_image_new_name;

        $product->save();

        // Redirect to the products index
        return redirect()->route('product.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('product.edit', ['product'=>Product::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
        ]);

        $product = Product::find($id);

        if($request->hasFile('image')){
            $product_image=$request->image;
            $product_image_new_name=time() . $product_image->getClientOriginalName();
            $product_image->move('uploads/product', $product_image_new_name);

            $product->image='uploads/product/' . $product_image_new_name;

            $product->save();
        }

        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::find($id);

        // Deleting image using PHP unlink
        if(file_exists($product->image)){
          unlink($product->image);
        }

        // Deleti,g the product
        $product->delete();

        return redirect()->back();
    }
}
