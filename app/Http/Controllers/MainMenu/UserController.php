<?php

namespace App\Http\Controllers\MainMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

    /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
    //    $this->middleware('auth:api');
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['UserType','UserStatus'])->orderBy('name', 'asc')->get();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [  
            'name' => 'required|string|max:255',
            'type' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make('Password'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
        ],201);

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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User removed successfully',
        ],201);
    }
}
