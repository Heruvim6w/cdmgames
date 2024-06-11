<!--==============================
Mobile Menu
============================== -->
<style>
    .vs-mobile-menu .dropdown-item, .vs-mobile-menu .dropdown-item {
        color: #1e2125;
        background-color: #f8f9fa;
    }
</style>
<div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
        <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            @include('layouts.logo')
        </div>
        <div class="vs-mobile-menu">
            <ul>
                <li class="menu-item-has-children">
                    <a href="/">Главная</a>
                </li>
                <li>
                    <a href="{{ route('posts.index') }}">Статьи</a>
                </li>
                <li>
                    <a href="{{ route('reviews') }}">Отзывы</a>
                </li>
                <li>
                    <a href="{{ route('about') }}">О нас</a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li>
                        <a class="snav-item" href="{{ route('profile') }}">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li>
                        <a class="sub_item dropdown-item" href="{{ route('orders.index') }}">
                            {{ __('Заказы') }}
                        </a>
                    </li>
                    @if(Auth::user()->role === 2)
                        <li>
                            <a href="{{ route('dialogs.index') }}">Чаты</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('profile.chat', 1) }}">Чат</a>
                        </li>
                    @endif
                    @if(Auth::user()->role === 2 || Auth::user()->role === 3)
                        <li>
                            <a href="{{ route('layouts') }}">Шаблоны</a>
                        </li>
                    @endif
                    <li>
                        <a class="nav-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</div>
