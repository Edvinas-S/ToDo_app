@extends('layouts.app')

@section('content')
    <a href="{{ URL::route('admin.index') }}" class="btn btn-dark btn-lg float-right mt-3 mr-3">Atgal</a>
    <div class="d-flex flex-column mx-auto">
        <div class="row justify-content-center" style="margin:0">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pakeisti naudotojo informacija: </div>
                    <div class="card-body">
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('admin.update', $user->id) }}">
                            @csrf 
                            @method("PUT")
                            <div class="form-group">
                                <label><b>Vardas:</b></label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label><b>Elektroninis paštas:</b></label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label><b>Slaptažodis:</b></label>
                                <input type="password" name="password" class="form-control" placeholder="jei norite įveskitę naują slaptažodį">
                            </div>
                            <button type="submit" class="btn btn-primary mb-3">Pakeisti naudotojo duomenis</button>
                        </form>
                        @foreach ($todos as $todo)
                        <form action={{ route('methods', $todo->id) }} method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="task"><b>Užduotis:</b></label>
                                <input type="text" name="title" class="form-control" value="{{ $todo->title }}">
                                <select class="form-control" id="task" name="status">
                                    <option selected disabled>Pasirinkite būsena</option>
                                    <option {{ ($todo->status=="ToDo")? "selected" : "" }}>ToDo</option>
                                    <option {{ ($todo->status=="InProgress")? "selected" : "" }}>InProgress</option>
                                    <option {{ ($todo->status=="Done")? "selected" : "" }}>Done</option>
                                </select>
                            </div>
                            {{-- <input type="hidden" name="thisId" value="{{$todo->belongsTo}}"> --}}
                            <input type="submit" name="todosChange" class="btn btn-primary mb-2" value="Atnaujinti užduotį"/>
                            <input type="submit" name="deleteTodo" class="btn btn-danger mb-2" value="Trinti užduotį"/>
                        </form>
                        @endforeach
                        <form action={{ route('methods', $user->id) }} method="POST">
                            @csrf 
                            <div class="form-group">
                                <label for="task"><b>Pridėti naują užduotį:<b></label>
                                <input type="text" name="title" class="form-control" placeholder="užduoties pavadinimas" value="{{old('title')}}">
                                <select class="form-control" id="task" name="status">
                                    <option selected disabled>Pasirinkite būsena</option>
                                    <option>ToDo</option>
                                    <option>InProgress</option>
                                    <option>Done</option>
                                </select>
                                <input type="submit" name="newTodo" class="btn btn-success mt-1" value="Naują užduots"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection