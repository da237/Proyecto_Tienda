<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{

    public function index()
    {
        return view('admin.products.index');
    }

    public function all(){
        return response()->json( Products::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request)
    {
        $imageName = " ";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/images'), $imageName);
        };
        Products::create([
            'title' => $request->get('title'),
            'image' => $imageName,
            // 'category_id' => $request['category_id'],
            'description' => $request->get('description'),
            'status' => $request->get('status'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock')
        ]);
        return redirect()->route('admin.productos.index')->withSuccess('Producto creado ');
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
        return view();

    }

    public function updateStatus (int $id,Request $request){
        Products::where('id',$id)->update([
            'status'=> $request->get('status')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( $request, Products $product)
    {
        if ($request->hasFile('image') && ($request['image'] != $product->image)) {
            // dd($product->image);
            // Storage::delete('public/images' . $product->image);
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
            return redirect()->route('admin.productos.index')->withSuccess('Producto actualizado. ');
        }
        $product->update($request->validated());
        return redirect()->route('admin.productos.index')->withSuccess('Producto actualizado ');
    }

    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->back()->withSuccess('productos.delete');
        //
    }
}
