@extends('layouts.app')

@section('content')
    <div class="card-body">
        <table class="table">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->get('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <ul class="navbar-nav ml-auto">
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
            <tr>
                <th>Nr.: </th>
                <th>Vardas: </th>
                <th>Elektroninis paštas: </th>
                <th>Turi užduočių: </th>
                <th>Veiksmai: </th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $todos->where('belongsTo', $user->id)->count() }}</td>
                <td>
                    <form action={{ route('admin.destroy', $user->id) }} method="POST">
                        <a class="btn btn-info" href={{ route('admin.show', $user->id) }}>Peržiūrėti</a>
                        <a class="btn btn-success" href={{ route('admin.edit', $user->id) }}>Redaguoti</a>
                        @csrf 
                        @method('delete')
                        <input type="submit" class="btn btn-danger" value="Trinti"/>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            <a href="{{ route('admin.create') }}" class="btn btn-success">Pridėti naudotoją</a>
        </div>
    </div>
@endsection