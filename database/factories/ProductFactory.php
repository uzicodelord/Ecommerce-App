<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'quantity' => $this->faker->numberBetween(10, 100),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $attributes = ProductAttribute::all();

            $product->attributes()->attach(
                $attributes->random(rand(1, $attributes->count()))->pluck('id')->toArray(),
                ['value' => $this->faker->word()]
            );

            $product->variations()->createMany(
                $attributes->map(function (ProductAttribute $attribute) {
                    return [
                        'attribute_id' => $attribute->id,
                        'value' => $this->faker->word(),
                    ];
                })->toArray()
            );
        });
    }
}
