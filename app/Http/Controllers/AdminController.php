<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        $todos = Todo::all();

        return view('admin.index', compact('users'), compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password' => 'required'
        ]);

        $user = new User([
            'name'=> $request->get('name'),
            'email'=> $request->get('email'),
            'password' => Hash::make($request->get('password')), 
        ]);

        $user->save();
        $user->attachRole('user');

        return redirect('/admin')->with('success', 'Pridėtas naujas naudotojas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $todos = Todo::where('belongsTo', $id)->get();
        return view('admin.show', compact('user'), compact('todos'));

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
        $todos = Todo::where('belongsTo', $id)->get();
        return view('admin.edit', compact('user'), compact('todos'));
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
        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ]);

        $user = User::find($id);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if($request->get('password') != '') {
            $user->password = Hash::make($request->get('password')); 
        }

        $user->save();

        return redirect('/admin')->with('success', 'Naudotojo info atnaujinta!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todos = Todo::all();

        if(($todos->where('belongsTo', $id)->count()) > 0) {
            return redirect('/admin')->with('error', 'Negali būti ištrintas! Nes turi aktyvių užduočių!');
        }

        $user = User::find($id);
        $user->delete();

        return redirect('/admin')->with('success', 'Naudotojas ištrintas!');

    }

    /**
     * Other methods.
     *
     */
    public function methods(Request $request, $id)
    {

        if ($request->has('deleteTodo')) {
            $todos = Todo::find($id);
            $todos->delete();

            return redirect('/admin')->with('success', 'Naudotojo užduotis ištrinta!');
        }
        
        if ($request->has('todosChange')) {

            $request->validate([
                'title'=>'required',
            ]);

            $todo = Todo::find($id);
            $todo->title = $request->get('title');
            $todo->status = $request->get('status');

            $todo->save();
            return redirect('/admin')->with('success', 'Pakeista užduotis!');
        }

        if ($request->has('newTodo')) {
            $request->validate([
                'title'=>'required',
                'status'=>'required',
            ]);

            $todo = new Todo([
                'title'=> $request->get('title'),
                'status'=> $request->get('status'),
                'belongsTo' => $id, 
            ]);

            $todo->save();
            return redirect('/admin')->with('success', 'Nauja užduotis pridėta!');
        }

    }
    
}
