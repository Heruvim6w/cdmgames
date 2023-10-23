@include('layouts.header')
<style>
    @media screen and (min-width: 992px) {
        .footer-wrapper.footer-layout1.bg-dark {
            margin-top: unset !important;
        }
    }
</style>
<section class="bg-dark">
    <div class="container">
        <div class="row text-light gx-5 gy-3 pb-5">
            <div class="col-12 col-md-6 pt-3">
                <div class="applications p-5">
                    <h4 class="text-light text-center">Выполненные</h4>
                    @if($replenishedApplications->isEmpty())
                        <p>Нет истории выплат</p>
                    @endif
                    @foreach($replenishedApplications as $replenishedApplication)
                        <p>Заявка #{{ $replenishedApplication->id }} | Выплачено: {{ $replenishedApplication->amount }} Руб.</p>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-6 pt-3">
                <div class="applications p-5">
                    <h4 class="text-light text-center">В процессе</h4>
                    @if($activeApplications->isEmpty())
                        <p>Нет активных заявок</p>
                    @endif
                    @foreach($activeApplications as $activeApplication)
                        <p>Заявка #{{ $activeApplication->id }} | Сумма: {{ $activeApplication->amount }} Руб. | Реквизит: {{ $activeApplication->requisite }} | Дата подачи: {{ $activeApplication->created_at }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')
