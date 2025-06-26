@extends('admin.main')
@section('content')
    <main class="app-main">
        <div class="card mb-4">
            <div class="card-header row">
                <h3 class="card-title col-10">Продукт</h3>
                <a href="{{route('admin.products.create')}}" class="btn btn-success col-2">Добавить</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">id</th>
                        <th>Название</th>
                        <th style="width: 230px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="align-middle">
                            <td>{{$product->id}}</td>
                            <td>{{$product->title}}</td>
                            <td>
                                <a href="{{route('admin.products.edit', [$product->id])}}" class="btn m-1 btn-primary ">Изменить</a>
                                <form action="{{route("admin.products.destroy", $product->id)}}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ">Удалить</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
{{--            {{ $products->withQueryString()->links('admin.layouts.paginate') }}--}}
        </div>
    </main>
@endsection
