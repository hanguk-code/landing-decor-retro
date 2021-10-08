<h1>Заказ № {{ $order['id'] }}</h1>
<p>Заказчик: {{ $order['name'] }}</p>
<p>Телефон:
    <a href="tel:{{ $order['phone'] }}">{{ $order['phone'] }}</a></p>
<p>Почта:
    <a href="mailto:{{ $order['email'] }}">{{ $order['email'] }}</a></p>
<p>Комментарий:
    {{ $order['comment'] }}
</p>
<table style="border: none; border-collapse: collapse;">
    <tbody>
    <tr>
        <th>№</th>
        <th>Изображение</th>
        <th>артикул</th>
        <th>Наименование товара</th>
        <th>Цена</th></tr>
    @php $inumb =0;@endphp
    @foreach($order['product_id'] as $product)
        @php $total += (int) str_replace(' ', '', $product['price']); $inumb ++; @endphp
        <tr>
            <td>{{ $inumb }}</td>
            <td><img src="https://decor-retro.ru/image/{{ $product['image'] }}" width="100"/></td>
            <td>{{ $product['product_id'] }}</td>
            <td><a href="https://decor-retro.ru">
                    {{ $product['name'] }}
                </a></td>
            <td>{{ $product['price'] }}</td>
        </tr>
    @endforeach
    <tr><td colspan="3"></td>
        <td style="text-align:right">ИТОГО общая сумма заказа:</td>
        <td>{{ number_format($total, 0, '.', ' ') }}</td></tr>
    </tbody>
</table>
<p>&nbsp;</p>
<p>С уважением, ДЕКОР-РЕТРО. +7(985)272-77-80</p>
<p><?php //echo $this->order->id;?></p>
<p><?php /*print_r($data);*/?></p>





