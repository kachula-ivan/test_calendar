@extends('layouts.head')
@section('title', 'Відновлення паролю')
@section('content')
    <div class="blob"></div>
    <div class="wrapper">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $request->token }}">
            <h2 class="login-text">Відновити пароль</h2>
            <div class="input-box">
              <span>
                <svg class="icon mail-icon {{ $errors->has('email') ? 'icon-error':'icon'}}">
                  <use xlink:href="{{ asset('images/icons.svg#mail') }}"></use>
                </svg>
              </span>
                <input class="input" type="email" name="email" id="email" value="{{ old('email', $request->email) }}" required autofocus />
                <label class="label mail-text" for="email">Email</label>
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
            <button class="login-button" type="submit">Відновити</button>
            {{--            <div class="register-link">--}}
            {{--                <p>--}}
            {{--                    <a class="register" href="{{ route('login') }}">Увійти</a>--}}
            {{--                </p>--}}
            {{--            </div>--}}
        </form>
    </div>
@endsection
