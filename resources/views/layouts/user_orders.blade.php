<script>
    $('#user_orders').click(function() {
        $(this).attr('disabled','disabled');
    });
</script>

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
                                    <th>Цена</th>
                                    <th>Статус заказа</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user->orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->gameItem->title }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>{{ $statuses[$order->status] }}</td>
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
