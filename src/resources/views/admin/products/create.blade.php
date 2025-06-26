@extends('admin.main')
@section('content')
    <main class="app-main">
        <div class="card card-primary card-outline mx-2 my-2">
            <div class="card-header">
                <div class="card-title">Создать продукт</div>
            </div>
            <form action="{{route("admin.products.store")}}" method="POST">
                @csrf
                <div class="card-body">
                    <x-forms.input title="Название" name="title"/>
                    <x-forms.input title="Описание" name="description"/>
                    <x-forms.input title="Цена" name="price"/>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Создать</button>
                </div>
            </form>
        </div>
    </main>
@endsection
