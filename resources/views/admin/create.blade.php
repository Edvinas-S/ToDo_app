@extends('layouts.app')

@section('content')
<div class="w-100 h-100">
<a href="{{ URL::route('admin.index') }}" class="btn btn-dark btn-lg float-right mt-3 mr-3">Atgal</a>
    <div class="d-flex flex-column mx-auto">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Naujas naudotojas:</div>
                    <div class="card-body">
                        <form action="{{ route('admin.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                <label>Vardas: </label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label>Elektroninis paštas: </label>
                                <input type="email" name="email" class="form-control" value="{{old('email')}}"> 
                            </div>
                            <div class="form-group">
                                <label>Slaptažodis: </label>
                                <input type="password" name="password" class="form-control" value="{{old('password')}}"> 
                            </div>
                            {{-- <div class="form-group">
                                <label>ToDo (užduotis): </label>
                                <textarea id="mce" name="todo" rows=10 cols=100 class="form-control">{{old('todo')}}</textarea>
                            </div> --}}
                            <button type="submit" class="btn btn-success">Sukurti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection