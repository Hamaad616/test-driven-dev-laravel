<?php

namespace Tests\Unit;

use App\Services\CheckoutService;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_checkout1(): void
    {
        $checkoutService = new CheckoutService();
        $total = $checkoutService->scan();
        $this->assertEquals(10.00, $total);
    }
}
