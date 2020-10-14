<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
</head>

<body>
    @include('includes.notifications')

    @include('includes.header')

    @yield('content')

    @include('includes.footer')

    @include('includes.pageJs')
</body>
</html>
