<?php

namespace App\Http\Controllers\MainMenu;

use App\Http\Controllers\Controller;
use App\Menu\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

        //Store
        $this -> validate($request, [
            'title' => 'required|string|unique:information',
            'description' => 'required|string',
        ]);

        Information::create([
            'title' => $request['title'],
            'description' => $request['description'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Information created successfully',
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
        $title = $id;//i.e About, Contact, Services

        $information = Information::where('title', $title)->first();
        return $information;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $information = Information::find($id);
        return $information;
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
         //Store
         $this -> validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        Information::where('id', $id)->update([
            'title' => $request['title'],
            'description' => $request['description'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Information updated successfully',
        ],201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $information = Information::find($id);
        $information->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Information removed successfully',
        ],201);
    }
}
