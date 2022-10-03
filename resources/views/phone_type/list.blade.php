@extends('app')

@section('title', $name)
@section('h1', $name)



@section('content')
    <div class="d-md-flex justify-content-md-end mb-3">
        <a href="{{ $url_add }}" class="btn btn-sm btn-primary">Добавить</a>
    </div>
    <ul class="list-group mb-2">
        @foreach ($phone_types as $type)
            <li class="list-group-item">

                <div class="d-md-flex justify-content-md-end mb-3">
                    <div class="btn-group">
                        <a href="{{ route('phone-types.edit', $type->id) }}" class="btn btn-sm btn-primary">Изменить</a>

                    </div>
                </div>

                <p>{{ $type->name }}</p>
            </li>
        @endforeach
    </ul>

@endsection
