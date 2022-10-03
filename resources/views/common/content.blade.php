<div class="container">
    <h1>@yield('h1')</h1>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @yield('content')
</div>
