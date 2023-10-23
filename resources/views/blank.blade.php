@include('layouts.header', ['title'=> 'О нас'])
<style>
    .breadcumb-wrapper {
        display: none;
    }
</style>
<!--==============================
  Palyer Area
  ============================== -->
<section class="vs-palyers-wrapper position-relative bg-dark space-top space-extra-bottom">
    <div class="text-shape-2">Сайт на модернизации</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="row">
                    <div class="col-xl-11 mb-30 mb-lg-5">
                        <div class="player-img text-center">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="CDMgames" style="height: 32em;">
                        </div>
                    </div>
                </div>
                <div class="row about_content">
                    <h3 class="text-center">
                        Приносим извинения, в настоящий момент чат сайта находится на модернизации.
                        Для общения администрацией просим воспользоваться одной из ссылок ниже:
                    </h3>
                    <ul>
                        <li>
                            <a href="https://vk.com/reconnection95"
                               class="font-bold"
                               style="font-size: large;">
                                Владелец: Илья
                            </a>
                        </li>
                        <li>
                            <a href="https://vk.com/id70682727"
                               class="font-bold"
                               style="font-size: large;">
                                Владелец: Альберт
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
