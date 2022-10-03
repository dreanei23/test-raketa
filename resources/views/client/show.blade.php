@extends('app')

@section('title', $name)
@section('h1', $name)



@section('content')

<form action="{{ route('clients.destroy', $client->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="d-md-flex justify-content-md-end mb-3">
        <div class="btn-group">
            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-primary">Изменить</a>
            <button type="submit" class="btn btn-sm btn-danger">
                Удалить
            </button>
        </div>
    </div>
</form>

@if (!empty($client->emails))
    <h2>Почты</h2>
    <ul>
        @foreach ($client->emails as $email)
            <li>{{ $email->email_text }}</li>
        @endforeach
    </ul>
@endif

@if (!empty($client->emails))
    <h2>Телефоны</h2>
    <ul>
        @foreach ($client->phones as $phone)
            <li>{{ $phone->phone_text }}</li>
        @endforeach
    </ul>
@endif

@endsection
