<style>
    .nav-item .nav-link, .sub_item.dropdown-item {
        font-weight: unset;
    }
</style>
<nav class="main-menu menu-style2 d-none d-lg-block">
    <ul>
        <li>
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
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <ul>
                        <li>
                            <a class="sub_item dropdown-item" href="{{ route('profile') }}">
                                {{ __('Профиль') }}
                            </a>
                        </li>
                        <li>
                            <a class="sub_item dropdown-item" href="{{ route('orders.index') }}">
                                {{ __('Заказы') }}
                            </a>
                        </li>
                        <li>
                            <a class="sub_item dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
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
        @endguest
    </ul>
</nav>
<button type="button" class="vs-menu-toggle d-inline-block d-lg-none"><i class="fas fa-bars"></i></button>
