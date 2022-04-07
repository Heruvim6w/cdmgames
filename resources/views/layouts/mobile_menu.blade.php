<!--==============================
Mobile Menu
============================== -->
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
            </ul>
        </div>
    </div>
</div>
