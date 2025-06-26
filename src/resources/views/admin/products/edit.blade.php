@extends('admin.main')
@section('content')
    <main class="app-main">
        <div class="card card-primary card-outline mx-2 my-2">
            <div class="card-header">
                <div class="card-title">Создать продукт</div>
            </div>
            <form action="{{route("admin.products.update", $product->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <x-forms.input title="Название" name="title" value="{{$product->title}}"/>
                    <x-forms.input title="Описание" name="description" value="{{$product->description}}"/>
                    <x-forms.input title="Цена" name="price" value="{{$product->price}}"/>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Обновить</button>
                </div>
            </form>
        </div>
    </main>
@endsection
