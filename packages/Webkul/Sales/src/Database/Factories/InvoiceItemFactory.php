<?php

namespace Webkul\Sales\Database\Factories;

<<<<<<< HEAD
use Webkul\Sales\Models\Invoice;
use Webkul\Sales\Models\InvoiceItem;
use Webkul\Sales\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;
=======
use Illuminate\Database\Eloquent\Factories\Factory;
use Webkul\Sales\Models\Invoice;
use Webkul\Sales\Models\InvoiceItem;
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61

class InvoiceItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceItem::class;

    /**
     * Define the model's default state.
<<<<<<< HEAD
     *
     * @return array
=======
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
     */
    public function definition(): array
    {
        $basePrice = $this->faker->randomFloat(2);

        $quantity = $this->faker->randomNumber();

<<<<<<< HEAD
        if (! isset($attributes['order_item_id'])) {
            $attributes['order_item_id'] = OrderItem::factory();
        }

        $orderItem = OrderItem::query()->find($attributes['order_item_id']);

=======
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
        return [
            'name'            => $this->faker->word,
            'sku'             => $this->faker->unique()->ean13,
            'qty'             => $quantity,
            'price'           => $basePrice,
            'base_price'      => $basePrice,
            'total'           => $quantity * $basePrice,
            'base_total'      => $quantity * $basePrice,
            'tax_amount'      => 0,
            'base_tax_amount' => 0,
<<<<<<< HEAD
            'product_id'      => $orderItem->product_id,
            'product_type'    => $orderItem->product_type,
            'order_item_id'   => $attributes['order_item_id'],
=======
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
            'invoice_id'      => Invoice::factory(),
        ];
    }
}
