@extends('app')

@section('title', $name)
@section('h1', $name)



@section('content')
<form method="POST" action="{{ $action }}">
    @csrf

    @if (isset($phone_type->id) && $phone_type->id)
        @method('PATCH')
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input id="name" name="name" type="text"
                    value="@if (old('name')){{ old('name') }}@elseif (isset($phone_type->name)){{ $phone_type->name }}@endif"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Мобильный">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-md-flex justify-content-md-end mb-3">
        <button type="submit" class="btn btn-primary mb-3">
            {{ $name }}
        </button>
    </div>
</form>
@endsection