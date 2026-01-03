<html lang="en">

<head>

    <title>{{ config('app.name') }} | @yield('title')</title>

        <!-- Required meta tags -->

  	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name=" Description" content="">

    <meta name=" Tags" content="">

    @include('layouts.front.includes.links')

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset(getImage('favicon'))}}">

</head>

<body>

  @include('layouts.front.template.header')

    @yield('content')

@include('layouts.front.template.footer')

@include('layouts.front.includes.scripts')

</body>

</html>