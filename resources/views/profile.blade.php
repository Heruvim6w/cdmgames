@include('layouts.header')
<!--==============================
    Team Area
    ==============================-->
<style>
    div.team-card_label {
        font-family: DejaVu Sans;
    }
</style>

@php
    if (!isset($user)) {
        $user = Auth::user();
    }

    if (!isset($profileVkInfo)) {
        $profileVkInfo = '<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">Для получения уведомлений (о новых сообщения от администрации, зачислении денежных средств на баланс сайта, получении выплат и т.д.) от нашего бота привяжите свой ВК к профилю.</span></span></p>

<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">ID ВКонтакте &mdash; это идентификатор пользователя или сообщества. Адрес профиля пользователя имеет вид https://vk.com/idXXXXXX, либо найти ID своей страницы вы можете во ВКонтакте в разделе Настройки &rarr; Адрес страницы.</span></span></p>

<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">Далее зайдите на страницу бота &ndash; <a href="https://vk.com/cdmgames_bot">ссылка</a>, и напишите ему любое сообщение.</span></span></p>

<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">Работоспособность бота необходимо проверить через кнопку &laquo;Тест бота&raquo;. Вы должны получить сообщение от него во Вконтакте &laquo;Спасибо за подписку на бота! Напишите -&gt; Начать, чтобы вызвать меню!&raquo; - бот работает.</span></span></p>';
    }

    if (!isset($profileMoneyInfo)) {
        $profileMoneyInfo = '<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">После получения оплаты за аккаунт на баланс сайта привяжите метод вывода средств и получите деньги на Вашу карту Сбербанка, Тинькофф, СБП или Qiwi.</span></span></p>

<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">Игрокам, проживающим не в РФ, оплачиваем через сервисы FunPay/g2g, Binance.</span></span></p>

<p style="text-align:justify"><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif">Вывод средств осуществляется в течении суток с момента подачи заявки.</span></span></p>';
    }
@endphp

@if(isset($message))
    <div class="alert alert-success m-auto">
        <span style="font-size: 2em">{{ $message }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        $('.alert .close').on('click', function(){
            $(this).closest('.alert').fadeOut('slow');
        });

        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
@endif

<section class="vs-team-wrapper bg-title space-top space-extra-bottom">
    <div class="container">
        <div class="title-area">
            <span class="sub-title">#CDMgames</span>
            <h2 class="sec-title text-white text-uppercase">личный кабинет</h2>
            <div class="sec-shape">
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
            </div>
        </div>
        <section class="vs-team-wrapper bg-title space">
            <div class="container">
                <div class="row z-index-common">
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="palyer-card">
                            <div class="palyer-card_img">
                                <img src="{{
                                    $user->avatar ?
                                    asset('storage/avatars/'.$user->avatar) :
                                    asset('assets/img/logo.png')
                                }}"
                                     alt="{{ $user->name }}" class="w-100">
                                <div>
                                    <span class="look_div">
                                        <button
                                            class="vs-btn profile_btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#avatar_update"
                                        >
                                            Сменить аватар
                                        </button>
                                    </span>
                                </div>
                                <div>
                                    <span class="look_div">
                                        <a href="{{ route('profile.update', $user->id) }}">
                                            <button
                                                class="vs-btn profile_vk_btn"
                                                style="width: 100%;  margin-top: 1em;"
                                            >
                                                Изменить профиль
                                            </button>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-xl-7">
                        <div class="row">
                            <div class="team-card">
                                <div class="team-card_content ml-30 text-start d-none d-lg-block">
                                    <div class="team-card_label mb-4">Имя: {{ $user->name }}</div>
                                    @if($user->vk_link)
                                        <div class="team-card_links team-card_label mb-4">
                                            Ссылка на ВК:
                                            <a href="https://vk.com/id{{ $user->vk_link }}">
                                                <i class="fab fa-vk"></i>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="team-card_label mb-4">Почта: {{ $user->email }}</div>
                                    <div class="team-card_label mb-4">Баланс: {{ $user->balance }}</div>
                                    <div class="team-card_label mb-4">Выведено: {{ $user->withdrawal }}</div>
                                    @if($user->is_ban)
                                        <div class="team-card_label mb-4">Причина бана: {{ $user->ban_reason }}</div>
                                    @endif
                                </div>

                                <div class="team-card_content text-start d-sm-block d-md-none">
                                    <div class="team-card_label mb-4">Имя: <br> {{ $user->name }}</div>
                                    @if($user->vk_link)
                                        <div class="team-card_links team-card_label mb-4">
                                            Ссылка на ВК: <br>
                                            <a href="https://vk.com/id{{ $user->vk_link }}">
                                                <i class="fab fa-vk"></i>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="team-card_label mb-4">Почта: <br> {{ $user->email }}</div>
                                    <div class="team-card_label mb-4">RUB: <br> {{ $user->balance }}</div>
                                    <div class="team-card_label mb-4">Выведено: <br> {{ $user->withdrawal }}</div>
                                    @if($user->is_ban)
                                        <div class="team-card_label mb-4">Причина бана: {{ $user->ban_reason }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="team-card col-12 col-sm-5">
                                <div class="team-card_content mx-30 text-start">
                                    {!! $profileVkInfo->content ?? $profileVkInfo !!}
                                    <div class="row text-center">
                                        <div class="col-md-7 ps-sm-0 mb-3 mb-sm-0">
                                            <span class="look_div">
                                                <button
                                                    class="vs-btn profile_vk_btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#user_update"
                                                >
                                                    Привязать ВК
                                                </button>
                                            </span>
                                        </div>
                                        @if($user->vk_link)
                                            <div class="col-md-5">
                                                <span class="look_div">
                                                    <a href="{{ route('test_bot') }}">
                                                        <button class="vs-btn profile_vk_btn">Тест бота</button>
                                                    </a>
                                                </span>
                                                @if($errors->any())
                                                    <ul>
                                                        @foreach($errors->all() as $error)
                                                            <li class="error">{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="team-card col-12 col-sm-5 offset-md-2">
                                <div class="team-card_content mx-30 text-start">
                                    {!! $profileMoneyInfo->content ?? $profileMoneyInfo !!}
                                    <div class="row text-center">
                                        @if($user->balance > 0)
                                            <div class="col-md-7 ps-sm-0 mb-3 mb-sm-0">
                                                <span class="look_div">
                                                    <button
                                                        type="button"
                                                        class="btn vs-btn profile_vk_btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#withdrawal"
                                                    >
                                                        Вывести
                                                    </button>
                                                </span>
                                            </div>
                                        @else
                                            <div class="col-md-7 ps-sm-0 mb-3 mb-sm-0">
                                                <span class="look_div">
                                                    <button type="button" class="btn vs-btn profile_vk_btn">
                                                        Ваш баланс 0 руб.
                                                    </button>
                                                </span>
                                            </div>
                                        @endif
                                        <div class="col">
                                            <a href="{{ route('profile.applications') }}">
                                                <button class="vs-btn profile_vk_btn">Заявки</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row z-index-common">
                    @if($user->role === 2)
                        <div class="col-md-3 col-xl-3">
                            <span class="look_div">
                                <a href="{{ route('dialogs.index') }}" target="blank">
                                    <button class="look vs-btn">Список чатов</button>
                                </a>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</section>
@include('layouts.withdrawal')
@include('layouts.user_update')
@include('layouts.avatar_update')
@include('layouts.footer')

</body>

</html>
