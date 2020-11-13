<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user|administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $todos = Todo::where('belongsTo', $userId)->get();
        return view('user.index', compact('todos'));
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
        $id = $request->post('id');

        if ($request->has('ToDo')) {
            $todo = Todo::find($id);
            $todo->status = 'ToDo';

            $todo->save();            
            return redirect('/user')->with('success', 'Užduotis atnaujinta!');
        }
        if ($request->has('InProgress')) {
            $todo = Todo::find($id);
            $todo->status = 'InProgress';
            
            $todo->save(); 
            return redirect('/user')->with('success', 'Užduotis atnaujinta!');
        }
        if ($request->has('Done')) {
            $todo = Todo::find($id);
            $todo->status = 'Done';
            
            $todo->save(); 
            return redirect('/user')->with('success', 'Užduotis atnaujinta!');
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
        //
    }
}
