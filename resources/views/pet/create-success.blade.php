@extends('layouts.layout')

@section('content')
    Питомец успешно добавлен!
    <a href="{{ route('pet.create')}}" class="btn btn-xs btn-info pull-right">Добавить еще питомца</a>
@endsection
