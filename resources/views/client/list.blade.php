@extends('app')

@section('title', $name)
@section('h1', $name)



@section('content')
    <div class="d-md-flex justify-content-md-end mb-3">
        <a href="{{ $url_add }}" class="btn btn-sm btn-primary">Добавить</a>
    </div>
    <ul class="list-group mb-2">
        @foreach ($clients as $client)
            <li class="list-group-item">
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="d-md-flex justify-content-md-end mb-3">
                        <div class="btn-group">
                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-success">Посмотреть</a>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-primary">Изменить</a>
                            <button type="submit" class="btn btn-sm btn-danger">
                                Удалить
                            </button>
                        </div>
                    </div>
                </form>
                <p>{{ $client->fio }}</p>
                <p>Почты:</p>
                <ul>
                    @foreach ($client->emails as $email)
                        <li>{{ $email->email_text }}</li>
                    @endforeach
                </ul>
                <p>Телефоны:</p>
                <ul>
                    @foreach ($client->phones as $phone)
                        <li>{{ $phone->phone_text }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>

    {{ $clients->links() }}
@endsection
