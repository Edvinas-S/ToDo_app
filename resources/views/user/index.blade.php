@extends('layouts.app')

@section('content')
<?php $i = 1 ?>
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle btn btn-light float-right mb-3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Atsijungti') }}
                    </a>
                </div>
            </li>
        </ul>
        <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
            <div class="card-body">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <table class="table">
                    <tr>
                        <th>Nr.: </th>
                        <th>Užduotis: </th>
                        <th>Būsena: </th>
                    </tr>
                    @foreach ($todos as $todo)
                    <tr>
                        <td class="h3">{{ $i++ }}</td>
                        <td class="h3">{{ $todo->title }}</td>
                        <td class="h3">
                            <div class="btn-group float-right">
                                <label class="btn btn-outline-primary {{ ($todo->status=="ToDo")? "active" : "" }}">ToDo</label>
                                <label class="btn btn-outline-warning {{ ($todo->status=="InProgress")? "active" : "" }}">InProgress</label>
                                <label class="btn btn-outline-success {{ ($todo->status=="Done")? "active" : "" }}">Done</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Norite pakeisti būsena?</td>
                        <td>
                            <form method="POST" action="{{ route('user.store') }}">
                            @csrf 
                            @method("POST")
                                <input type="hidden" name="id" value="{{ $todo->id }}">
                                <input type="submit" name="ToDo" value="ToDo" class="btn btn-sm btn-outline-light">
                                <input type="submit" name="InProgress" value="InProgress" class="btn btn-sm btn-outline-light">
                                <input type="submit" name="Done" value="Done" class="btn btn-sm btn-outline-light">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection