<script>
    $('#user_orders').click(function() {
        $(this).attr('disabled','disabled');
    });

    function cancel_order(orderId) {
        let formData = new FormData();

        formData.append('_token', "{{ csrf_token() }}");
        formData.append('order', orderId);

        $.ajax({
            type:  $("#cancel_order").attr('method'),
            url: "{{ route('orders.cancel') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function () {
                encodeURIComponent( $("#cancel_order").val(''));
                location.reload();
            }
        });
    }

    function deliver_order(orderId) {
        let formData = new FormData();

        formData.append('_token', "{{ csrf_token() }}");
        formData.append('order', orderId);

        $.ajax({
            type: $("#deliver_order").attr('method'),
            url: "{{ route('orders.deliver') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function () {
                encodeURIComponent($("#deliver_order").val(''));
                location.reload();
            }
        });
    }
</script>

<style>
    table {
        text-align: center;
    }
</style>

<div class="modal fade text-dark" id="user_orders" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Заказы {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <span class="close_modal" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                        @if($user->orders->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                У {{ $user->name }} нет ни одного заказа
                            </div>
                        @else
                            @php
                            $statuses = [
                                App\Models\Order::NEW => 'Новый',
                                App\Models\Order::PAID => 'Оплачен',
                                App\Models\Order::COMPLETED => 'Завершён',
                                App\Models\Order::CANCELLED => 'Отменён',
                                App\Models\Order::ERROR => 'Ошибка',
                            ];
                            @endphp
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Номер заказа</th>
                                    <th>Товар</th>
                                    <th>Игра</th>
                                    <th>Ник в игре</th>
                                    <th>Цена</th>
                                    <th>Статус заказа</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user->orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->gameItem->title }}</td>
                                        <td>{{ $order->gameItem->gameForItem->title }}</td>
                                        <td>{{ $order->user_game_nickname }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>
                                            {{ $statuses[$order->status] }}
                                            @if($order->status === App\Models\Order::NEW || $order->status === App\Models\Order::ERROR)
                                                <form
                                                    action="javascript:cancel_order({{ $order->id }})"
                                                    id="cancel_order"
                                                    class="form-border"
                                                    enctype="multipart/form-data"
                                                    method="post"
                                                >
                                                    @csrf

                                                    <ul class="list-inline d-inline align-items-center m-b-0 col-6 pt-1">
                                                        <li class="list-inline-item">
                                                            <button name="cancel_order"
                                                                    type="submit"
                                                                    class="d-inline look vs-btn text-center"
                                                                    onclick="return confirm('Отменить этот заказ?')">
                                                                <span class="m-r-10">Отменить</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </form>
                                            @endif
                                            @if($order->status === App\Models\Order::PAID)
                                                <form
                                                    action="javascript:deliver_order({{ $order->id }})"
                                                    id="deliver_order"
                                                    class="form-border"
                                                    enctype="multipart/form-data"
                                                    method="post"
                                                >
                                                    @csrf

                                                    <ul class="list-inline d-inline align-items-center m-b-0 col-6 pt-1">
                                                        <li class="list-inline-item">
                                                            <button name="deliver_order"
                                                                    type="submit"
                                                                    class="d-inline look vs-btn text-center"
                                                                    onclick="confirm('Выдать этот заказ?')">
                                                                <span class="m-r-10">Выдать</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
