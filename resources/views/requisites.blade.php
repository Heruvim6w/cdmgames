@include('layouts.header')
<section class="vs-team-wrapper bg-title space-top space-extra-bottom">
    <div class="container text-center">
        <h2 class="text-light">Платежные средства - {{ $user->name }}</h2>

        <div class="d-flex justify-content-center">
            <div class="col-md-3 col-xl-4">
                <span class="look_div">
                    <button type="button" class="btn vs-btn" data-bs-toggle="modal" data-bs-target="#add_requisite">
                        Привязать средство вывода
                    </button>
                </span>
            </div>
        </div>
    </div>

    <div class="container my-45">
        <h4 class="text-light text-center">Мои реквизиты</h4>
        <p class="text-muted text-center">Список реквизитов, которые были подтверждены и доступны для вывода</p>
        @if($user->requisites->isEmpty())
            <h5 class="text-light text-center">У вас не привязано ни одного реквизита</h5>
        @else
        @foreach($user->requisites as $requisite)
                <div class="box-custom">
                    <ul class="list s1">
                        <h4 class="{{ $requisite->confirm == 0 ? 'red' : 'text-light'}}">
                            Метод: {{ $requisite->withdrawalMethod->name }}<br>
                            Реквизит: {{ $requisite->value }}<br>
                            Дата создания: {{ $requisite->created_at }}
                            {!! $requisite->confirm == 0 ? '<br>Необходимо подтверждение. Проверьте свою почту' : '' !!}
                        </h4>
                        <br>
                        <br>
                    </ul>
                </div>
            @endforeach
        @endif
    </div>
</section>
@include('layouts.add_requisite')
@include('layouts.footer')

</body>

</html>
