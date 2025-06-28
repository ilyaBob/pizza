<?php

namespace Domain\Product\Tests\Feature;

use App\Tests\AdminAuthTestCase;
use Domain\Product\Product;
use Domain\User\Enum\RoleEnum;
use Domain\User\User;
use Illuminate\Support\Facades\Hash;

class ProductControllerTest extends AdminAuthTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->cleanModel(Product::class);
    }

    // ************************************** Index **************************************
    public function testCorrectIndex()
    {
        $response = $this->get(route('admin.products.index'));
        $response->assertStatus(200);
    }

    // ************************************** Store **************************************
    public function testCorrectStore()
    {
        $data = Product::factory()->raw();
        $response = $this->post(route('admin.products.store'), $data);
        $response->assertStatus(201);

        $product = Product::query()->first();
        $this->assertEquals($data['title'], $product->title);
    }

    public function testIncorrectStore()
    {
        $data = Product::factory()->raw();
        unset($data['price']);

        $response = $this->post(route('admin.products.store'), $data);
        $response->assertStatus(422);
    }

    // ************************************** Update **************************************
    public function testCorrectUpdate()
    {
        $product = Product::factory()->create();
        $data = $product->toArray();
        $data['title'] = 'Вжух';

        $response = $this->patch(route('admin.products.update', $product->id), $data);
        $response->assertStatus(200);

        $this->assertEquals('Вжух', $product->fresh()->title);
    }

    public function testIncorrectUpdate()
    {
        $product = Product::factory()->create();
        $data = $product->toArray();
        $data['price'] = 'Вжух2';

        $response = $this->patch(route('admin.products.update', $product->id), $data);
        $response->assertStatus(422);
    }

    // ************************************** Show **************************************
    public function testCorrectShow()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('admin.products.show', $product->id));
        $response->assertStatus(200);
    }

    public function testIncorrectShow()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('admin.products.show', 'asd' ));
        $response->assertStatus(404);
    }

    // ************************************** Destroy **************************************
    public function testCorrectDestroy()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('admin.products.destroy', $product->id));
        $response->assertStatus(204);
    }

}
