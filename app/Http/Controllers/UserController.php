<?php

namespace PaybeeTest\Http\Controllers;

use Illuminate\Http\Request;
use PaybeeTest\User;
use PaybeeTest\Http\Requests\UserRegisterFormRequest;
use Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('dashboardauth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('dashboard.users.index' , compact('users')); 
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterFormRequest $request)
    {
        
        $user = new User;
        $user->firstname    = ucwords(strtolower(preg_replace('/\s+/', ' ', $request->all()['firstname']))); 
        $user->lastname     = ucwords(strtolower(preg_replace('/\s+/', ' ', $request->all()['lastname']))); 
        $user->email        = $request->all()['email']; 
        $user->password     = Hash::make($request->all()['password']); 
        $user->save();
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    /**
     * Show the form for addings the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('dashboard.users.add'); 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.users.edit' , compact('user')); 
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
        $user = User::find($id);
        $user->firstname    = $request->all()['firstname']; 
        $user->lastname     = $request->all()['lastname']; 
        $user->email        = $request->all()['email']; 
        $user->save();
        return redirect('users');
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
    }
}
