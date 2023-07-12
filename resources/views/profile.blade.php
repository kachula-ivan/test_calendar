@extends('layouts.head-profile')
@section('title', 'Профіль')
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
                        <span class="username">{{ $name }}</span>
                        <div class="profile_user">
                            <svg class="icon">
                                <use xlink:href="images/icons.svg#user"></use>
                            </svg>
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
    <main class="main">
        <div class="blob"></div>
        <div class="wrapper">
            <form enctype="multipart/form-data" action="{{ route('profile.edit') }}" method="POST">
                @csrf
                <div class="profile-img">
                    <div class="avatar">
                        <img class="avatar-img" id="preview" src="{{ Auth::user()->avatar }}" alt=""/>
                        <!-- Незнаю як порівняти id користувача з його акаунтом -->
                        <!--@#if(Auth::user()->id === Auth::user()->id)
                            <a class="profile-link" href="">
                                <svg class="avatar-icon">
                                    <use xlink:href="images/icons.svg#camera"></use>
                                </svg>
                                <input id="avatar" type="file" name="avatar" class="file-input"
                                       onchange="previewImage(event)"/>
                            </a>-->

                    </div>
                    <span class="profile__fullname">{{ $name }}</span>
                </div>
                <ul class="information">
                    <li class="information-list">
                        <span class="span id">ID: {{ $id }}</span>
                    </li>
                    <li class="information-list">
                        <span class="span">EMAIL:</span>
                        <a class="text" href="{{ $email }}">
                            {{ $email }}</a
                        >
                    </li>
                    <li class="information-list edit__information-list">
                        <a href="{{ route('profile.edit') }}">Редагувати профіль</a>
                    </li>
                </ul>
            </form>
        </div>
    </main>
    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function () {
                var image = document.getElementById('preview');
                image.src = reader.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
