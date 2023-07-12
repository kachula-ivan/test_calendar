@extends('layouts.head-profile')
@section('title', 'Редагування профілю')
@section('content')
    <header class="header">
        <div class="header__container">
            <div class="header__group">
                <div class="logo">
                    <a href="{{ route('home') }}" class="logo-link">
                        <img class="logo-img" src="{{ asset('images/logo.png') }}" alt="Лого"/>
                        <span class="logo-text">calendar</span>
                    </a>
                </div>
                <ul class="menu">
                    <li class="menu-item">
                        <a href="{{ route('calendar.index') }}" class="menu-link">календар</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">про нас</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">контакти</a>
                    </li>
                </ul>
                <ul class="header__user">
                    <li class="header__username">
                        <span class="username">{{ Auth::user()->name }}</span>
                        <div class="profile_user">
                            <span>
                                <svg class="icon {{ $errors->has('name') ? 'icon-error':'icon'}}">
                                  <use xlink:href="{{ asset('images/icons.svg#user') }}"></use>
                                </svg>
                              </span>
                            <ul class="profile-menu">
                                <li class="profile-item">
                                    <a href="{{ route('profile') }}" class="profile__window-link">Мій профіль</a>
                                </li>
                                <li class="profile-item">
                                    <a href="{{ route('profile.edit') }}" class="profile__window-link">Редагувати
                                        дані</a>
                                </li>
                                <li class="profile-item">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); this.closest('form').submit();"
                                           class="profile-item">Вийти</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="main">
        <div class="blob"></div>
        <div class="wrapper">
            <form enctype="multipart/form-data" action="{{ route('profile.edit') }}" method="POST">
                @csrf
                <h2 class="login-text">Редагування профілю</h2>
                <div class="input-box">
              <span>
                <svg class="icon mail-icon {{ $errors->has('name') ? 'icon-error':'icon'}}">
                  <use xlink:href="{{ asset('images/icons.svg#user') }}"></use>
                </svg>
              </span>
                    <input class="input" type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                           autofocus/>
                    <label class="label mail-text" for="name">Ім'я</label>
                </div>
                <div class="input-box">
                <span>
            <svg class="icon mail-icon {{ $errors->has('password') ? 'icon-error':'icon'}}">
              <use xlink:href="images/icons.svg#password"></use>
            </svg>
          </span>
                    <input class="input" type="password" name="password" id="password"/>
                    <label class="label" for="password">Пароль</label>
                </div>
                <div class="input-box input__avatar-box">
                    <input class="inputs" type="file" name="avatar" id="avatar" hidden="hidden"/>
                    <a id="upload-btn">Загрузити фото</a>
                    <span id="avatar__upload-text">Файл не завантажено</span>
                </div>
                <button class="login-button" type="submit">Зберегти зміни</button>
            </form>
        </div>
    </div>
    <script>
        window.onload = () => {
            const uploadFile = document.getElementById("avatar");
            const uploadBtn = document.getElementById("upload-btn");
            const uploadText = document.getElementById("avatar__upload-text");

            uploadBtn.addEventListener("click", function () {
                uploadFile.click();
            });

            uploadFile.addEventListener("change", function () {
                if (uploadFile.value) {
                    const filename = uploadFile.value.match(/[\/\\]([\w\d\s\.\-(\)]+)$/)[1];
                    if (filename.length >= 15) {
                        uploadText.innerText = filename.substring(0, 15) + '...';
                    } else {
                        uploadText.innerText = filename;
                    }
                } else {
                    uploadText.innerText = "Файл не завантажено";
                }
            });
        }
    </script>
@endsection
