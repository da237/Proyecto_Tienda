<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Products::paginate(7);

        return view('productos.index', compact('products'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Products::distinct()->pluck('status');
        // dd($status);
        return view('', compact(''));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( $request)
    {
        $path = $request['image']->store('public/images');
        $newpath = str_replace("public/images", "", $path);
        Products::create([
            'title' => $request['title'],
            'image' => $newpath,
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'status' => $request['status'],
            'price' => $request['price'],
            'stock' => $request['stock']
        ]);
        return redirect()->back()->withSuccess('Producto creado ');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        $statuses = Products::distinct()->pluck('status');
        return view('admin.products.edit', compact('product', 'categories', 'statuses'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( $request, Products $product)
    {
        if ($request->hasFile('image') && ($request['image'] != $product->image)) {
            // dd($product->image);
            Storage::delete('public/images' . $product->image);
            $path = $request['image']->store('public/products');
            $newpath = str_replace("public/storage/products", "", $path);
            $product->update([
                'image' => $newpath,
                'title' => $request['title'],
                'description' => $request['description'],
                'status' => $request['status'],
                'stock' => $request['stock'],
                'valor' => $request['price']
            ]);
            return redirect()->route('productos.index')->withSuccess('Producto actualizado. ');
        }
        $product->update($request->validated());
        return redirect()->route('productos.index')->withSuccess('Producto actualizado ');
        // dd($request);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->back()->withSuccess('productos.delete');
        //
    }
}
