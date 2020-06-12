<?php

namespace App\Http\Controllers;

use App\Product;
use App;
use Illuminate\Http\Request;
use JWTAuth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $user =  JWTAuth::user();
        $products = Product::all();
        return response()->json([
            'msg' => 'alll products',
            'products' => $products
          
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desc' => 'required',
            'location' => 'required',
            'price' => 'required',
            'user_id' => '',
            'img' => '' 
        ]);
        $product = new Product($validatedData);
        $product->save();
        return response()->json([
            'msg' => 'created' ,
            '$product ' => $product ,
          
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'msg' => 'product' ,
            '$product ' => $product ,
        ]);
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'desc' => 'required',
            'location' => 'required',
            'price' => 'required',
            'user_id' => '',
            'img' => '' 
        ]);
        $product = Product::findOrFail($id);
        $product->update($validatedData);
        return response()->json([
            'msg' => 'update' ,
            '$product ' => $product ,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'msg' => 'delete' ,
            '$product ' => $product ,
          
        ],200);
    }
}
