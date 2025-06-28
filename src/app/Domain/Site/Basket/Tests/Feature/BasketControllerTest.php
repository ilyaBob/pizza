<?php

namespace Domain\Site\Basket\Tests\Feature;

use App\Tests\UserAuthTestCase;
use Domain\Product\Enum\ProductTypeEnum;
use Domain\Product\Product;
use Domain\Site\Basket\Basket;

class BasketControllerTest extends UserAuthTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->cleanModel(Basket::class);
    }

    // ************************************** Index **************************************
    public function testCorrectIndex()
    {
        $product = Product::factory()->create();
        Product::factory()->create();

        Basket::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $product->id,
        ]);

        $response = $this->get(route('basket.index'));
        $response->assertStatus(200);

        $this->assertEquals($response->json()[0]['product_id'], $product->id);
        $this->assertCount(1, $response->json());
    }

    // ************************************** Change **************************************

    // Проверка на добавление записи в корзину
    public function testCorrectChangeAdd()
    {
        $productPizza = Product::factory()->create([
            'type' => ProductTypeEnum::PIZZA->value
        ]);

        $amount = 1;

        $responseChange = $this->post(route('basket.change'), [
            'quantity' => $amount,
            'product_id' => $productPizza->id,
        ]);
        $responseChange->assertStatus(200);


        $response = $this->get(route('basket.index'));
        $response->assertStatus(200);

        $responseJson = $response->json()[0];

        $this->assertEquals($responseJson['product_id'], $productPizza->id);
        $this->assertEquals($responseJson['quantity'], $amount);
        $this->assertCount(1, $response->json());
    }

    // Проверка на обновление записи из корзины
    public function testCorrectChangeUpdate()
    {
        $productPizza = Product::factory()->create([
            'type' => ProductTypeEnum::PIZZA->value
        ]);

        Basket::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $productPizza->id,
            'quantity' => 1,
        ]);

        $amount = 4;

        $responseChange = $this->post(route('basket.change'), [
            'quantity' => $amount,
            'product_id' => $productPizza->id,
        ]);
        $responseChange->assertStatus(200);

        $response = $this->get(route('basket.index'));
        $response->assertStatus(200);

        $responseJson = $response->json()[0];

        $this->assertEquals($responseJson['product_id'], $productPizza->id);
        $this->assertEquals($responseJson['quantity'], $amount);
        $this->assertCount(1, $response->json());
    }

    public static function dataProviderProductAmount(): array
    {
        return [
            [1, 200], [4, 200], [8, 400], [11, 400],
        ];
    }

    // Проверка на валидации на 10 пиц и 20 напитков
    /**
     * @dataProvider dataProviderProductAmount
     */
    public function testCorrectChangeValidation($amount, $statusCode): void
    {
        $productPizza1 = Product::factory()->create([
            'type' => ProductTypeEnum::PIZZA->value
        ]);

        $productPizza2 = Product::factory()->create([
            'type' => ProductTypeEnum::PIZZA->value
        ]);
        $productDrink = Product::factory()->create([
            'type' => ProductTypeEnum::DRINK->value
        ]);

        Basket::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $productPizza1->id,
            'quantity' => 5,
        ]);

        Basket::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $productPizza2->id,
            'quantity' => 4,
        ]);

        Basket::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $productDrink->id,
            'quantity' => 15,
        ]);

        $responseChange = $this->post(route('basket.change'), [
            'quantity' => $amount,
            'product_id' => $productPizza1->id,
        ]);
        $responseChange->assertStatus($statusCode);
    }

    // ************************************** Change **************************************
    public function testCorrectChangeDelete()
    {
        $this->cleanModel(Basket::class);
        $productPizza = Product::factory()->create([
            'type' => ProductTypeEnum::PIZZA->value
        ]);

        $basket = Basket::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $productPizza->id,
            'quantity' => 1,
        ]);

        $responseChange = $this->post(route('basket.change'), [
            'quantity' => 4,
            'product_id' => $productPizza->id,
        ]);
        $responseChange->assertStatus(200);

        $this->assertCount(1, Basket::all());

        $response = $this->delete(route('basket.destroy', $basket));
        $response->assertStatus(200);

        $this->assertCount(0, Basket::all());
    }
}
