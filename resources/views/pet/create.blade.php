@extends('layouts.layout')

@section('content')
    <form method="post" action="{{route('pet.store')}}">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Имя</label>
            <input type="name" name="name" class="form-control" id="name" aria-describedby="emailHelp"
                   placeholder="Введите имя">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email:</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp"
                   placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Имя питомца</label>
            <input type="name" class="form-control" id="pet_name" name="pet_name" aria-describedby="petHelp"
                   placeholder="Введите имя питомца">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Имя питомца</label>
            <input type="name" class="form-control" id="test" name="test" aria-describedby="petHelp"
                   placeholder="Введите имя питомца">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Категория питомца</label>
            <select name="pat_category_id" id="pat_category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
