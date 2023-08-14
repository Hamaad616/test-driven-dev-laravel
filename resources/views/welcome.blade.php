<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    </head>
    <body >

    @foreach($cartItems as $cartItem)
        <p>{{ $cartItem->code }} - {{ number_format($cartItem->price, 2) }}</p>
    @endforeach

    <p>Total: {{ number_format((new \App\Services\CheckoutService())->getTotal(), 2) }}</p>

    </body>
</html>
