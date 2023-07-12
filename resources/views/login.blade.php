@extends('layouts.head')
@section('title', 'Авторизація')
@section('content')
    <div class="blob"></div>
    <div class="wrapper">
        @if(session('status'))
            <div class="succes__reset">
                <h3>{{ session('status') }}</h3>
            </div>
        @endif
        <form class="form" action="{{ route('login') }}" method="post">
            @csrf
            <h2 class="login-text">Вхід</h2>
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
            <div class="remember-forgot">
                <label class="checkbox-text" for="remember"
                ><input class="checkbox" type="checkbox" name="remember" id="remember" /> Запам'ятати мене</label
                >
                <a class="link forgot-link" href="{{ route('password.request') }}">Забули пароль?</a>
            </div>
            <button class="login-button" type="submit">Увійти</button>
            <div class="socialite">
                <a href="/auth/google/redirect" class="google-button google__github-button">
                    <svg class="mail-icon mail__google-icon">
                        <use xlink:href="{{ asset('images/icons.svg#google') }}"></use>
                    </svg>
                </a>
                <a href="/auth/github/redirect" class="github-button google__github-button">
                    <svg class="mail-icon">
                        <use xlink:href="{{ asset('images/icons.svg#github') }}"></use>
                    </svg>
                </a>
            </div>
            <div class="register-link">
                <p>
                    Не має акаунта?
                    <a class="register" href="{{ route('register') }}">Реєстрація</a>
                </p>
            </div>
        </form>
    </div>
@endsection
