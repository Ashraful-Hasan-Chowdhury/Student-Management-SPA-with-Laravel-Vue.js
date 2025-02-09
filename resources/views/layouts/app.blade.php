<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="{{asset('public/js/jquery.min.js')}}" defer></script>
    <script src="{{asset('public/js/popper.js')}}" defer></script>
    <script src="{{asset('public/js/bootstrap.min.js')}}" defer></script>
    <script src="{{asset('public/js/main.js')}}" defer></script>
    <script src={{asset('public/js/sweetalert2.min.js')}}></script>
    <script src={{asset('public/js/toastr.min.js')}}></script>
    <script src={{asset('public/ckeditor/ckeditor.js')}}></script>

    <script>
      @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
      @endif
    </script>




    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href={{asset('public/css/toastr.min.css')}}>
    <link rel="stylesheet" href="{{asset('public/css/sweetalert2.min.css')}}">
</head>
<body>
    <div id="app">
        <div class="wrapper d-flex align-items-stretch">

            <sidebar></sidebar>
        <!-- Page Content  -->
        <main id="content" class="p-4 p-md-5 pt-5">
            @yield('content')
        </main>
        </div>


    </div>
</body>
</html>
