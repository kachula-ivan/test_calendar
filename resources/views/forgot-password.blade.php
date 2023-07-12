@extends('layouts.head')
@section('title', 'Відновлення паролю')
@section('content')
    <div class="blob"></div>
    <div class="wrapper">
        @if(session('status'))
        <div class="succes__reset">
            <h3>{{ session('status') }}</h3>
        </div>
        @endif
        <form class="form" action="{{ route('password.request') }}" method="post">
            @csrf
            <h2 class="login-text">Відновити пароль</h2>
            <div class="input-box">
              <span>
                <svg class="icon mail-icon {{ $errors->has('email') ? 'icon-error':'icon'}}">
                  <use xlink:href="{{ asset('images/icons.svg#mail') }}"></use>
                </svg>
              </span>
                <input class="input" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus />
                <label class="label mail-text" for="email">Email</label>
            </div>
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror
            <button class="login-button reset__button" type="submit">Відновити</button>
{{--            <div class="register-link">--}}
{{--                <p>--}}
{{--                    <a class="register" href="{{ route('login') }}">Увійти</a>--}}
{{--                </p>--}}
{{--            </div>--}}
        </form>
    </div>
@endsection
