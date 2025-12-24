@extends('layouts.page')

@section('head-title')
    Auth
@endsection

@section('content')

@if ( $errors->any() )
    <div class="err-block">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <header>
        <h1>Add User</h1>
    </header>
    <main>
        <div class="auth-section">
            <h2>Add User</h2>

            <form action="{{ route('authpage.post') }}" method="post">
                @csrf
                <input type="text" name="login" id="login" placeholder="YourLogin" value="{{ old('login') }}">
                <input type="password" name="passwd" id="passwd" placeholder="******">
                <input type="text" name="is_admin" id="is_admin" placeholder="1/0">
                <button type="submit">
                    Submit
                </button>
            </form>
        </div>

    </main>
@endsection

    
    

