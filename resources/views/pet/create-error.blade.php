@extends('layouts.layout')

@section('content')
    Ошибка добавления питомца !
    <a href="{{ route('pet.create')}}" class="btn btn-xs btn-info pull-right">Добавить питопца</a>
@endsection
