<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.head')
</head>
<body>

    @yield('content')

    @include('components.footer')
    
    @yield('js')
</body>
</html>