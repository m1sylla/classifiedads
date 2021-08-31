<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    
    @yield('title')

    <!----  favicon  --->
    <link rel="shortcut icon" type="image/png" href="/uploads/favicon-192.png">
    <link rel="shortcut icon" sizes="192x192" href="/uploads/favicon-192.png">
    <link rel="apple-touch-icon" href="/uploads/favicon-192.png">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/custom.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <script src="/js/app.js"> </script>
    <script src="/js/custom.js"> </script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


</head>

<body>

    <!-- header -->
    <header class="">
        @include('includes.navbar')
    </header>
    <!-- end header -->

    <main class="my-5 py-5">

        @yield('content')

    </main>

    <!-- footer -->
    <footer mb-0>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

</body>

</html>