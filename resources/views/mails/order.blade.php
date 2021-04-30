<h1>Ваш заказ принят - ожидайте звонка, с вами обязательно свяжется наш менеджер!</h1>

<ul>
    @foreach($fields['cartData'] as $cart)
        @php $total += (int) str_replace(' ', '', $cart['price']); @endphp
        <li>
            <a href="https://decor-retro.ru{{ $cart['url'] }}">
                {{ $cart['name'] }}
            </a>
            <br>
            Артикул: {{ $cart['article'] }}
            <br>
            Цена: {{ $cart['price'] }}
        </li>
    @endforeach
</ul>
Общая стоимость: {{ number_format($total, 0, '.', ' ') }}

<div>Имя:{{ $fields['userForm']['name'] }}</div>
<div>Телефон:{{ $fields['userForm']['phone'] }}</div>
<div>Комментарий:
    {{ $fields['userForm']['comment'] }}
</div>
