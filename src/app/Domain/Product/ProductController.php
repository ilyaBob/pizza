<?php

namespace Domain\Product;

use App\Http\Controllers\Controller;
use Domain\Product\Request\CreateProductRequest;
use Domain\Product\Request\UpdateProductRequest;
use Domain\Product\Resource\ProductResourceCollection;
use Domain\Product\Resource\ProductShowResource;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(): ProductResourceCollection
    {
        $products = Product::all();
        return new ProductResourceCollection($products);
    }

    public function store(CreateProductRequest $request): ProductShowResource
    {
        $data = $request->validated();
        $product = Product::query()->create($data);
        return new ProductShowResource($product);
    }

    public function show(Product $product): ProductShowResource
    {
        return new ProductShowResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product): ProductShowResource
    {
        $product->update($request->validated());
        return new ProductShowResource($product);
    }

    public function destroy(Product $product): Response
    {
        $product->delete();
        return response()->noContent();
    }
}
