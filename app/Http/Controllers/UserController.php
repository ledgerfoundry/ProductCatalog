<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Validator;
use Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if(Auth::user()->role=='Customer' ){
            exit;
        }
    }

    private function validator($params){
        $check = ['name'=>$params['name'],'role'=>$params['role'],'email'=>$params['email'],'password'=>$params['password']];
        return Validator::make($check, [
                'name' => 'required|min:3|max:255',
                'role' => 'required',
                'email'=>'required|unique:users,id,:id',
                'password'=>'required'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('user.index')->with('users', $users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator=$this->validator($request);
        if(!$validator->fails()){
            User::create([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'role'=>$request['role'],
                'password'=>bcrypt($request['password']),
            ]);
            return redirect('/user');
        }else{
            return redirect('/user/create')
                           ->withErrors($validator)
                           ->withInput();
        }
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
        $user = User::find($id);
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
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
        //
        $validator=$this->validator($request);
        if(!$validator->fails()){
            User::find($id)->update([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'role'=>$request['role'],
                'password'=>bcrypt($request['password']),
            ]);
            return redirect('/user');
        }else{
            return redirect('/user/'.$id.'/edit')
                           ->withErrors($validator)
                           ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }
}
