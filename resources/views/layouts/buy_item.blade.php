<script>
    $('#buy_item').click(function() {
        $(this).attr('disabled','disabled');
    });
</script>

<div class="modal fade text-dark" id="buy_item" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Купить {{ $gameItem->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <span class="close_modal" aria-hidden="true">&times;</span>
                </button>
            </div>

            <form name="order_store"
                  action="{{ route('orders.store') }}"
                  method="post">
                @csrf
                <div class="modal-body">
                    <div class="field-set" style="background-size: cover;">
                        <label for="user_game_nickname" class="col-12 avatar_label bg-white }}">
                            <span class="d-inline-block">Укажите свой ник в игре</span>
                            <input type="text" class="" name="user_game_nickname" id="user_game_nickname" required>
                            <input type="hidden" name="game_item" value="{{ $gameItem->id }}">
                            <input type="hidden" name="price" value="{{ $gameItem->price }}">
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button
                        name="avatar_update"
                        id="avatar_update"
                        type="submit"
                        class="btn vs-btn">
                        Купить {{ $gameItem->title }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
