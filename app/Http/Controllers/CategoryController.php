<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests;
use Validator;
use Auth;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        if(Auth::user()->role=='Customer' ){
            exit;
        }
    }

    private function validator($params){
    	$check = ['name'=>$params['name'],'parent_id'=>$params['parent_id']];
    	return Validator::make($check, [
    	        'name' => 'required|unique:categories,id,:id|min:3|max:255',
    	        'parent_id' => 'required',
    	]);
    }


    public function index(){
    	$categories = Category::all();
        return view('category.index')->with('categories', $categories);
    }

    public function create(){
    	$categories = Category::all();
		return view('category.create')->with('categories', $categories);
    }

 	public function store(Request $request){
 		$validator=$this->validator($request);
    	if(!$validator->fails()){
    		$cat=Category::create([
    			'name'=>$request['name'],
    			'parent_id'=>$request['parent_id']
    		]);
            if($cat->parent_id == "0"){
                $cat->parent_id = $cat->id;
                $cat->save();
            }
            return redirect('/category');
    	}else{
    		return redirect('/category/create')
                        ->withErrors($validator)
                        ->withInput();
    	}
	}


	public function show($id){
		$category = Category::find($id);
        return view('category.show')->with('category', $category);

	}

	public function edit($id){
		$category = Category::find($id);
		$categories = Category::all();
	    return view('category.edit')->with(['category'=> $category,'categories'=>$categories]);
	    
	}

	public function update($id,Request $request){
		$validator=$this->validator($request);
	   	if(!$validator->fails()){
	   		Category::find($id)->update([
	   			'name'=>$request['name'],
	   			'parent_id'=>$request['parent_id']
	   		]);
            $cat=Category::find($id);
            if($cat->parent_id == 0){
                $cat->parent_id = $cat->id;
                $cat->save();
            }
	   		return redirect('/category/'.$id);
	   	}else{
	   		return redirect('/category/edit/'.$id)
               ->withErrors($validator)
               ->withInput();
	   	}
	}

	public function destroy($id){
		$category = Category::find($id);
		$category->delete();
        return redirect('/category');
	}
       
}

