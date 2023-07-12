@extends('layouts.head-home')
@section('title', 'Головна')
@section('content')
    <header class="header">
        <div class="header__container">
            <div class="header__group">
                <div class="logo">
                    <a href="#" class="logo-link">
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
                @auth
                    <ul class="header__user">
                        <li class="header__username">
                            <span class="username">{{ Auth::user()->name }}</span>
                            <div class="profile_user">
                                <svg class="icon mail-icon calendar-icon">
                                    <use xlink:href="{{ asset('images/icons.svg#user') }}"></use>
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
                @endauth
                @guest
                    <ul class="menu">
                        <li class="menu-item menu__auth-item">
                            <a href="{{ route('login') }}" class="menu-link menu__auth-link">Увійти</a>
                        </li>
                        <li class="menu-item menu__auth-item">
                            <a href="{{ route('register') }}" class="menu-link menu__auth-link">Реєстрація</a>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="text-info">
                <h1 class="title">2023 Calendar & Planner</h1>
                <ul class="info-list">
                    <li class="info-item">
                        <p class="info-text">Зроблено за допомогою Figma і все в одному інструменті</p>
                    </li>
                    <li class="info-item">
                        <p class="info-text">Безкоштовне редагування та використання</p>
                    </li>
                    <li class="info-item">
                        <p class="info-text">Автоматичні шаблони компонування та універсальне використання за потреби</p>
                    </li>
                    <li class="info-item">
                        <p class="info-text">Налаштуйте будь-який розділ так, як вам подобається</p>
                    </li>
                    <li class="info-item">
                        <p class="info-text">Свята та важливі дні, позначені кольором</p>
                    </li>
                    <li class="info-item">
                        <p class="info-text">Ваш персональний планувальник у Calendar (щомісяця, щотижня та щодня)</p>
                    </li>
                    <li class="info-item">
                        <p class="info-text">Детальна версія та проста версія для використання</p>
                    </li>
                </ul>
            </div>
            <div class="image-info">
                <img src="{{ asset('images/info.png') }}" alt="Info" class="info-img">
            </div>
        </div>
    </main>
@endsection
