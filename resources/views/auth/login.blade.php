@extends('layouts.app')

@section('content')
<h2>Вход в систему</h2>
    
    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <input type="text" name="login" placeholder="Логин" required autofocus>
        </div>
        <div>
            <input type="password" name="password" placeholder="Пароль" required>
        </div>
        <button type="submit">Войти</button>
    </form>
@endsection
