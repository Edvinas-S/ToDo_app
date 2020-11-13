@extends('layouts.app')

@section('content')
<div class="w-100 h-100">
    <a href="{{ URL::previous() }}" class="btn btn-dark btn-lg float-right mt-3 mr-3">Atgal</a>
    <div class="d-flex flex-column">
        <div class="font-weight-bold display-4">
            Vardas: {{ $user->name }}
        </div>
        @foreach ($todos as $todo)
            <div class="card w-50 mt-3 mx-auto">
                <div class="card-body">
                    <div class="float-left">
                        {{ $todo->title }}
                    </div>
                    <div class="btn-group float-right">
                        <label class="btn btn-outline-primary {{ ($todo->status=="ToDo")? "active" : "" }}">ToDo</label>
                        <label class="btn btn-outline-warning {{ ($todo->status=="InProgress")? "active" : "" }}">InProgress</label>
                        <label class="btn btn-outline-success {{ ($todo->status=="Done")? "active" : "" }}">Done</label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection