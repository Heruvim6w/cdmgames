@include('layouts.header', ['title'=> 'Мои заказы'])

<style>
    table th {
        color: #fff;
        text-align: center;
    }

    table td {
        color: #a8a8a8;
        text-align: center;
    }
</style>
<section class="vs-palyers-wrapper bg-dark position-relative space-top space-extra-bottom">
    <div class="container">
        <div class="title-area text-center text-xl-start">
            <h2 class="sec-title text-white">Мои заказы</h2>
            <div class="sec-shape">
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                @if($orders->isEmpty())
                    <div class="alert alert-danger" role="alert">
                        У вас нет ни одного заказа
                    </div>
                @else
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
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->gameItem->isEmpty() ? "Товар удалён" : $order->gameItem->title }}</td>
                                <td>{{ $order->price }}</td>
                                <td>
                                    {{ $statuses[$order->status] }}
                                    @if($order->status === App\Models\Order::NEW || $order->status === App\Models\Order::ERROR)
                                        <a href="{{ route('orders.pay', [$order->id, auth()->user()->id]) }}"
                                           onclick="return confirm('Оплатить этот заказ?')">
                                            <span class="look vs-btn m-r-10">Оплатить</span>
                                        </a>
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
</section>

@include('layouts.footer')
