<script>
    $('#user_update').click(function() {
        $(this).attr('disabled','disabled');
    });
</script>

<div class="modal fade text-dark" id="user_update" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Привязать аккаунт vk.com к сайту</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <span class="close_modal" aria-hidden="true">&times;</span>
                </button>
            </div>

            <form enctype="multipart/form-data" name="user_update" action="{{ route('profile.update.data', $user, []) }}" role="form" method="post">
                @csrf
                <div class="modal-body">
                    <div class="field-set" style="background-size: cover;">
                        <label>Укажите свой id (только цифры)</label>
                        <input type="text" pattern="[0-9]{1,10}" name="vk_link" class="form-control"
                               placeholder="{{ $user->vk_link ?? '12345' }}" required="">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button name="user_update" id="user_update" type="submit" class="btn vs-btn">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
