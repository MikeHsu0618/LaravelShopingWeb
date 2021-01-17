<html>

<head>
    <title>進度條 Laravel Controller 章節</title>
    @include('layouts.meta')
    @include('layouts.css')
</head>

<body>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('layouts.nav')
    @yield('content')
    @include('layouts.footer')
    @include('layouts.js')
    @section('inline_js')
    @show
</body>

</html>
