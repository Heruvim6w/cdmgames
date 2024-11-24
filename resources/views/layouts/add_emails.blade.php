<script>
    $('#add_emails').click(function() {
        $(this).attr('disabled','disabled');
    });
</script>

<div class="modal fade text-dark" id="add_emails" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создать email'ы</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <span class="close_modal" aria-hidden="true">&times;</span>
                </button>
            </div>

            <form enctype="multipart/form-data"
                  name="add_emails"
                  action="{{ route('add.emails', []) }}"
                  role="form"
                  method="post">
                @csrf
                <div class="modal-body">
                    <div class="field-set" style="background-size: cover;">
                        <label for="emails_count" class="col-12 emails_label">
                            <span class="d-inline-block">Введите количество</span>
                            <input type="number" class="" name="emails_count" id="emails_count">
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button name="add_emails" id="add_emails" type="submit" class="btn vs-btn">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>
