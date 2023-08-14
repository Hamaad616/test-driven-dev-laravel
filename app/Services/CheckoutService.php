<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Log;

class CheckoutService implements CartInterface
{
    private array $pricingPolicies;

    public $items = [];

    public $total = 0;


    function __construct()
    {

        $query = Cart::query()
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->selectRaw('SUM(cart.quantity) as quantity, products.price, products.code')
            ->groupBy('products.code', 'products.price')
            ->get();

        $this->setItems($query);

        // we can fetch the pricing policy later from the database

        // let's define what should be invoked if we add a certain product

        // i.e. There is a product PS3, it has a policy that whenever it
        // is bought we give a discount
        // of $5.00 on each item in cart
        // so the pricing policy shall be 'ProductCode' => 'method', 'param: discount'

        $this->pricingPolicies = [
            'PS3' => [
                'give_discount',
                5,
                1
            ]
        ];
    }

    /**
     * @return array
     */
    function getItems(): mixed
    {
        return $this->items;
    }

    /**
     * @return mixed
     */
    function getTotal(): float
    {
        foreach ($this->items as $item) {
            $rule = $this->pricingPolicies[$item->code] ?? NULL;
            if (!is_null($rule)) {
                $param1 = $rule[1];
                $param2 = $rule[2];
                $methodName = $rule[0];
                $subtotal = $this->{$methodName}($item, $param1, $param2);
                $this->setTotal($subtotal);
            }else{
                $this->setTotal($item->quantity * $item->price);
            }
        }
        return number_format($this->total, 2);
    }

    /**
     * @param $items
     */
    function setItems($items): void
    {
        $this->items = $items;
    }

    /**
     * @param $subtotal
     * @return void
     */
    function setTotal($subtotal): void
    {
        $this->total += $subtotal;
    }

    public function scan()
    {
        return $this->getTotal();
    }


    private function give_discount($product, $rule1, $rule2)
    {
        if($product->quantity >= $rule2){
            $discounted_price = $this->items->sum('quantity') * $rule1;
            $gross = $product->quantity * $product->price;
            $subtotal = $gross - $discounted_price;
            return $discounted_price > 0 ? $subtotal : number_format(0, 2);
        }
    }

    private function get_free()
    {

    }
}
