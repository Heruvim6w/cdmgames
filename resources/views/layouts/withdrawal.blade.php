<script>
    $('#withdrawal').click(function() {
        $(this).attr('disabled','disabled');
    });
</script>

<div class="modal fade text-dark" id="withdrawal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Вывод средств | Баланс: {{ $user->balance }} RUB.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <span class="close_modal" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="text-center justify-content-center">
                <div class="col-12 my-3">
                    <span class="look_div">
                        <a href="{{ route('user_requisites') }}">
                            <button class="look vs-btn">Привязать средство вывода</button>
                        </a>
                    </span>
                </div>
            </div>
            <form enctype="multipart/form-data" name="withdrawal" action="{{ route('withdrawal') }}" role="form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="field-set" style="background-size: cover; text-align:center">
                        <label>Укажите сумму для вывода</label>
                        <input type="text" pattern="[0-9]{1,5}" name="amount" class="form-control"
                               placeholder="Доступно: {{ $user->balance }}" required="">
                    </div>
                </div>
                <div class="modal-body text-center justify-content-center">
                    <div class="field-set" style="background-size: cover;">
                        <label>Укажите метод для вывода</label>
                        <select name="hash" class="form-control">

                            @if($user->requisites->isEmpty()){
                                <option>У вас не привязано ни одного реквизита</option>
                            @else
                                @foreach($user->requisites as $requisite)
                                    <option value="{{ $requisite->hash }}">{{ $requisite->withdrawalMethod->name }} ( {{ $requisite->value }} )</option>
                                @endforeach
                            @endif

                        </select>
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                    </div>
                </div>
                <div class="modal-body">
                    <code>
                        <small>
                            Обратите внимание!<br>
							На QIWI, карты и СБП - ручной вывод до суток.<br>
                            Пожалуйста, дожидайтесь вывода.
                        </small>
                    </code>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button name="withdrawal" id="withdrawal" type="submit" class="btn vs-btn">Создать заявку</button>
                </div>
            </form>
        </div>
    </div>
</div>
