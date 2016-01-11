<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Category_Product;
use Auth;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function validator($params){
        $check = ['name'=>$params['name'],'description'=>$params['description'],'categories'=>$params['categories']];
        return Validator::make($check, [
                'name' => 'required|unique:products|min:3|max:255',
                'description' => 'required',
                'categories'=>'required'
        ]);
    }


    public function index(){
        $products = Product::all();
        return view('product.index')->with('products', $products);
    }

    public function create(){
        if(Auth::user()->role=='Customer' ){
            return redirect('/');
        }
        $categories = Category::all();
        return view('product.create')->with('categories', $categories);
    }

    public function store(Request $request){
        if(Auth::user()->role=='Customer' ){
            return redirect('/');
        }
        $validator=$this->validator($request);
        if(!$validator->fails()){
            $product = Product::create([
                'name'=>$request['name'],
                'description'=>$request['description']
            ]);
            foreach($request['categories'] as $catId){
                Category_Product::create([
                    'product_id'=>$product->id,
                    'category_id'=>$catId
                ]);
            }
            return redirect('/product');
        }else{
            return redirect('/product/create')
                        ->withErrors($validator)
                        ->withInput();
        }
    }


    public function show($id){
        $product = Product::find($id);
        //$categories = Category::where('product_id',$id)
        return view('product.show')->with('product', $product);

    }

    public function edit($id){
        if(Auth::user()->role=='Customer' ){
            return redirect('/');
        }
        $product = Product::find($id);
        $categories = Category::all();
        return view('product.edit')->with(['product'=> $product,'categories'=>$categories]);
        
    }

    public function update($id,Request $request){
        if(Auth::user()->role=='Customer' ){
            return redirect('/');
        }
        $validator=$this->validator($request);
        if(!$validator->fails()){
            $product = Product::where('id',$id)->update([
                'name'=>$request['name'],
                'description'=>$request['description']
            ]);
            Category_Product::where('product_id',$id)->delete();
            foreach($request['categories'] as $catId){
                Category_Product::create([
                    'product_id'=>$id,
                    'category_id'=>$catId
                ]);
            }
            return redirect('/product');
        }else{
            return redirect('/product/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
    }

    public function destroy($id){
        if(Auth::user()->role=='Customer' ){
            return redirect('/');
        }
        Category_Product::where('product_id',$id)->delete();
        $product = Product::find($id);
        $product->delete();
        return redirect('/product');
    }
}
