<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'create', 'show', 'delete', 'edit']);
    }

    public function index()
    {
        if(Auth::check()) {
            $products = Product::all();
            return view('index', compact('products'));
        } else {
            return redirect()->route('login.form')->with('error', 'Verileri görmek için giriş yapmalısınız.');
        }
    }
    
    public function create()
    {
        if (Auth::check()) {
            return view('create');
        } else {
            return redirect()->route('login.form')->with('error', 'Verileri görmek için giriş yapmalısınız.');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
            'description' => 'required|string',
        ], [
            'product_name.required' => 'Ürün ismi alanı gereklidir.',
            'product_price.required' => 'Ürün fiyatı alanı gereklidir.',
            'description.required' => 'Açıklama alanı gereklidir.', 
            'product_price.numeric' => 'Ürün fiyatı sayı olmalıdır.',
            'description.required' => 'Açıklama alanı gereklidir.',
        ]);

        $product = new Product([
            'product_name' => $request->input('product_name'),
            'product_price' => $request->input('product_price'),
            'description' => $request->input('description'),
        ]);

        Auth::user()->products()->save($product);

        return redirect()->route('products.index')->with('success', 'Ürün başarıyla eklendi.');
    }


    public function edit(Product $product)
    {
        if (Auth::check()) {
            return view('edit', compact('product'));
        } else {
            return redirect()->route('login.form')->with('error', 'Verileri görmek için giriş yapmalısınız.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
            'description' => 'required|string',
        ],[
            'product_name.required' => 'Ürün ismi alanı gereklidir.',
            'product_price.required' => 'Fiyat alanı gereklidir.',
            'description.required' => 'Açıklama alanı gereklidir.',
        ]);

        $product->update([
            'product_name' => $request->input('product_name'),
            'product_price' => $request->input('product_price'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('index')->with('success', 'Ürün başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
    $product->delete();

    return redirect()->route('index')->with('success', 'Ürün başarıyla silindi.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $product = Product::find($id);
            return view('show', compact('product'));
        } else {
            return redirect()->route('login.form')->with('error', 'Verileri görmek için giriş yapmalısınız.');
        }
    }
}