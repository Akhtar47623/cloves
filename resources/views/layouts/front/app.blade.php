<html lang="en">
<head>
    <title>{{ config('app.name') }} | @yield('title')</title>
        <!-- Required meta tags -->
  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name=" Description" content="ClovesRx Global is here to help independent pharmacies deliver prescriptions to patients safely and securely around Southern California.">
    <meta name=" Tags" content="prescription delivery, pharmacy delivery, medication pick up, excellent Rx delivery, door to door prescription delivery">
    @include('layouts.front.includes.links')
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset(getImage('favicon'))}}">
	@include('layouts.front.template.header')
    
</head>
<body>
    @yield('content')
</body>
@include('layouts.front.includes.scripts')
</html>