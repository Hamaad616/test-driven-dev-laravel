<?php

namespace App\Services;

interface CartInterface
{
    function getItems(): mixed;

    function getTotal(): mixed;

    function setItems($items): void;

    function setTotal($subtotal): void;
}
