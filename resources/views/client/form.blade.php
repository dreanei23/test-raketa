@extends('app')

@section('title', $name)
@section('h1', $name)



@section('content')
    <form method="POST" action="{{ $action }}">
        @csrf

        @if (isset($client->id) && $client->id)
            @method('PATCH')
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-3">
                    <label for="fio" class="form-label">ФИО</label>
                    <input id="fio" name="fio" type="text"
                        value="@if (old('fio')){{ old('fio') }}@elseif (isset($client->fio)){{ $client->fio }}@endif"
                        class="form-control @error('fio') is-invalid @enderror" placeholder="Иванов Иван Иванович">
                </div>
                @error('fio')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                @for ($count = 1; $count <= $count_emails; $count++)
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <input class="form-check-input" name="key_main_email" type="radio"
                                    value="{{ $count }}"
                                    @if (old('key_main_email') == $count || !empty($client->emails) &&
                                        !empty($client->emails->get($count - 1)) &&
                                        $client->emails->get($count - 1)['is_main']) checked @elseif ($count === 1) checked @endif
                                    id="is_main_email_{{ $count }}">
                            </span>
                            <span class="input-group-text">
                                Email {{ $count }}
                            </span>
                            <input id="email" name="emails[{{ $count }}][email]" type="email"
                                value="@if (old('emails.' . $count . '.email')){{ old('emails.' . $count . '.email') }}@elseif (!empty($client->emails) && !empty($client->emails->get($count - 1))){{ $client->emails->get($count - 1)['email'] }}@endif"
                                class="form-control" placeholder="user@site.ru">
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                @for ($count = 1; $count <= $count_phones; $count++)
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <input class="form-check-input" name="key_main_number" type="radio"
                                    value="{{ $count }}"
                                    @if (old('key_main_number') == $count || !empty($client->phones) &&
                                        !empty($client->phones->get($count - 1)) &&
                                        $client->phones->get($count - 1)['is_main']) checked @elseif ($count === 1) checked @endif
                                    id="is_main_phone_{{ $count }}">
                            </span>
                            <span class="input-group-text">
                                Телефон {{ $count }}
                            </span>
                            <input id="phone" name="phones[{{ $count }}][number]" type="phone"
                                value="@if (old('phones.' . $count . '.number')){{ old('phones.' . $count . '.number') }}@elseif (!empty($client->phones) && !empty($client->phones->get($count - 1))){{ $client->phones->get($count - 1)['number'] }}@endif"
                                class="form-control @error('phones.' . $count . '.number') is-invalid @enderror"
                                placeholder="1234567890">
                            <select class="form-select" name="phones[{{ $count }}][type_id]" id="phone_type">
                                @foreach ($phone_types as $type)
                                    <option value="{{ $type->id }}" @if (old('phones.' . $count . '.type_id') == $type->id || !empty($client->phones) &&
                                        !empty($client->phones->get($count - 1)) &&
                                        $client->phones->get($count - 1)['type_id'] === $type->id) selected @endif>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('phones.' . $count . '.number')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                @endfor
            </div>
        </div>

        <div class="d-md-flex justify-content-md-end mb-3">
            <button type="submit" class="btn btn-primary mb-3">
                {{ $name }}
            </button>
        </div>
    </form>
@endsection
