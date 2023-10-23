<script>
    $('#withdrawal').click(function() {
        $(this).attr('disabled','disabled');
    });
</script>

<div class="modal fade text-dark" id="add_requisite" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создать метод вывода</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <span class="close_modal" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <code>Подтверждение будет направлено на почту: {{ $user->email }}</code>
            </div>
            <form enctype="multipart/form-data" name="withdrawal" action="{{ route('user_requisites') }}" role="form" method="post">
                @csrf
                <div class="modal-body text-center justify-content-center">
                    <div class="field-set" style="background-size: cover;">
                        <label>Укажите метод для вывода</label>
                        <select name="withdrawal_method" class="form-control">
                            @foreach($withdrawalMethods as $withdrawalMethod)
                                <option value="{{ $withdrawalMethod->id }}">{{ $withdrawalMethod->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="field-set" style="background-size: cover;">
                        <label>Укажите реквизиты для вывода (только цифры)</label>
                        <input type="number" name="value" class="form-control" placeholder="" required="">
                    </div>
                </div>
                <div class="modal-body">
                    <code>
                        <small>
                            Обратите внимание, что сайт cdmgames.com использует вашу информацию с целью обработки для вывода средств.
                        </small>
                    </code>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button name="withdrawal" id="withdrawal" type="submit" class="btn vs-btn">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>
