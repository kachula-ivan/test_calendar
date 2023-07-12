@extends('layouts.head')
@section('title', 'Реєстрація')
@section('content')
    <div class="blob"></div>
    <div class="wrapper">
        <form class="form" action="{{ route('register') }}" method="post">
            @csrf
            <h2 class="login-text">Реєстрація</h2>
            <div class="input-box">
              <span>
                <svg class="icon mail-icon {{ $errors->has('name') ? 'icon-error':'icon'}}">
                  <use xlink:href="{{ asset('images/icons.svg#user') }}"></use>
                </svg>
              </span>
                <input class="input" type="text" name="name" id="name" value="{{ old('name') }}" required autofocus />
                <label class="label mail-text" for="name">Ім'я</label>
            </div>
            <div class="input-box">
              <span>
                <svg class="icon mail-icon {{ $errors->has('email') ? 'icon-error':'icon'}}">
                  <use xlink:href="{{ asset('images/icons.svg#mail') }}"></use>
                </svg>
              </span>
                <input class="input" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus />
                <label class="label mail-text" for="email">Електронна адреса</label>
            </div>
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror
            <div class="input-box">
          <span>
            <svg class="icon mail-icon {{ $errors->has('password') ? 'icon-error':'icon'}}">
              <use xlink:href="images/icons.svg#password"></use>
            </svg>
          </span>
                <input class="input" type="password" name="password" id="password" required />
                <label class="label" for="password">Пароль</label>
            </div>
            @error('password')
            <p class="error-message">{{ $message }}</p>
            @enderror
            <div class="input-box">
          <span>
            <svg class="icon mail-icon {{ $errors->has('') ? 'icon-error':'icon'}}">
              <use xlink:href="{{ asset('images/icons.svg#password') }}"></use>
            </svg>
          </span>
                <input class="input" type="password" name="password_confirmation" id="password_confirmation" required />
                <label class="label" for="password_confirmation">Повторіть пароль</label>
            </div>
            <div class="remember-forgot">
                <label class="checkbox-text" for="remember">
                    <input class="checkbox" type="checkbox" name="remember" id="remember" /> Запам'ятати мене
                </label>
                <a class="link forgot-link" href="{{ route('password.request') }}">Забули пароль?</a>
            </div>
            <button class="login-button" type="submit">Зареєструватися</button>
{{--            <div class="register-link">--}}
{{--                <p>Є акаунт? <a class="register" href="{{route('login')}}">Увійти</a></p>--}}
{{--            </div>--}}
        </form>
    </div>
@endsection
